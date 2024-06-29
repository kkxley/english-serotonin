<template>
  <div
    class="sentences-add"
    @click="$emit('close')"
  >
    <div
      class="sentences-add__content"
      @click.stop
    >
      <label>Тип предложения <select v-model="type">
        <option
          v-for="item in types"
          :key="item.title"
          :value="item.id"
        >{{ item.title }}</option>
      </select>
      </label>
      <label>На русском <input v-model="russian"></label>
      <label>На английском <input v-model="english"></label>
      <button
        v-if="type && russian && english"
        @click="add"
      >
        Добавить
      </button>
    </div>
  </div>
</template>

<script>
import {adminApi} from "../../shared/api";

export default {
  name: "SentencesAdd",
  props: {
    theme: {
      type: String,
      required: true
    }
  },
  emits: ['close', 'add'],
  data() {
    return {
      type: "",
      russian: "",
      english: "",
      types: []
    }
  },
  mounted() {
    adminApi.getSentencesTypes()
        .then(({types}) => {
          this.types = types
        });
  },
  methods: {
    add () {
      this.$emit('add', {
        type: this.type,
        russian: this.russian,
        english: this.english,
      })
    }
  }
}
</script>

<style scoped lang="scss">
.sentences-add {
  background: rgba(0, 0, 0, 0.5);
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  display: flex;
  align-items: center;
  justify-content: center;

  &__content {
    border-radius: 10px;
    padding: 10px;
    background: #7DC6BB;
    display: flex;
    flex-direction: column;
    row-gap: 10px;

    label {
      input {
        width: 100%;
      }
    }
  }
}
</style>