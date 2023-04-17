<template>
  <div
    class="constructor"
    @drop="onDrop($event, 'words')"
    @dragover.prevent
    @dragenter.prevent
  >
    <div class="constructor__sentence">
      {{ sentence }}
    </div>
    <div
      class="constructor__area"
      @drop.stop="onDrop($event, 'areaWords')"
      @dragover.prevent
      @dragenter.prevent
    >
      <div
        v-for="word in areaWords"
        :key="word"
        :draggable="true"
        class="constructor__word"
        :class="{'constructor__word_isMove': currentWord === word}"
        @dragstart="startDrag($event, word)"
        @dragend="endDrag($event)"
      >
        {{ word }}
      </div>
    </div>
    <div class="constructor__words">
      <div
        v-for="word in words"
        :key="word"
        :draggable="true"
        class="constructor__word"
        :class="{'constructor__word_isMove': currentWord === word}"
        @dragstart="startDrag($event, word)"
        @dragend="endDrag($event)"
      >
        {{ word }}
      </div>
    </div>
    <button
      v-if="areaWords.length"
      class="constructor__check-button"
      @click="onCheck"
    >
      Проверить
    </button>
  </div>
</template>

<script>
export default {
    name: "SentencesConstructor",
    props: {
        sentence: {
            type: String,
            required: true
        },
        initialWords: {
            type: Array,
            required: true
        }
    },
    emits: ['check'],
    data() {
        return {
            words: [],
            areaWords: [],
            currentWord: null
        }
    },
    watch: {
        initialWords: {
            handler() {
                this.words = [...this.initialWords]
                this.areaWords = []
                this.currentWord = null
            },
            deep: true
        },
    },
    mounted() {
        this.words = [...this.initialWords]
    },
    methods: {
        startDrag(e, word) {
            e.target.style.transform = 'translate(0, 0)'
            this.currentWord = word
        },
        onDrop(e, targetName) {
            let index = null
            if (e.target.classList.contains('constructor__word')) {
                const parent = e.target.parentElement
                index = Array.from(parent.querySelectorAll('.constructor__word')).indexOf(e.target)
            } else {
                index = this[targetName].length
            }

            this[targetName] = [
                ...this[targetName].slice(0, index).filter(word => word !== this.currentWord),
                this.currentWord,
                ...this[targetName].slice(index).filter(word => word !== this.currentWord),
            ]

            const deleteList = targetName === 'areaWords' && 'words' || 'areaWords'
            this[deleteList] = this[deleteList].filter(word => word !== this.currentWord)

            this.currentWord = null
        },
        endDrag() {
            this.currentWord = null
        },
        onCheck () {
            this.$emit('check', this.areaWords)
        }
    }
}
</script>

<style lang="scss" scoped>
.constructor {
    display: flex;
    flex-direction: column;
    background: #7DC6BB;
    padding: 15px;
    border-radius: 16px;
    row-gap: 15px;

    &__sentence {
        font-size: 18px;
    }

    &__area {
        background: #E5E5E5;
        padding: 5px;
        border-radius: 8px;
        min-height: 30px;

        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
    }

    &__words {
        display: flex;
        flex-direction: row;
        column-gap: 8px;
        row-gap: 8px;
        flex-wrap: wrap;
    }

    &__word {
        background: #E5E5E5;
        padding: 3px 10px;
        border-radius: 8px;
        cursor: pointer;
        border: 2px solid #E5E5E5;

        &:hover {
            border-color: #45b4ab;
        }

        &_isMove {
            opacity: .7;
        }
    }

    &__check-button {
        align-self: flex-end;
        background: #f587a4;
        border-radius: 20px;
        border: 1px solid #f587a4;
        padding: 14px 25px 13px;
        font-size: 18px;
        cursor: pointer;
        font-weight: 400;
        color: #fff;
        box-shadow: 0 8px 15px rgba(2,91,78,.25), 0 3px 0 #bc6a8b;
    }
}
</style>