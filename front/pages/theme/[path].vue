<template>
  <div>
    <Breadcrumbs :routes="[{name: 'Главная'}, {name: 'Present Simple'}]" />
    <SentencesFilter
      class="sentences-filter"
      :types="types"
      @update:filter="updateFilter"
    />
    <SentencesConstructor
      v-if="!error"
      :initial-words="words"
      :sentence="sentence"
    />
    <div v-else>
      Таких предложений у нас пока нет
    </div>
  </div>
</template>

<script>
import Breadcrumbs from "../../shared/Breadcrumbs.vue";
import SentencesConstructor from "./SentencesConstructor.vue";
import axios from "axios";
import SentencesFilter from "./SentencesFilter.vue";

export default {
    name: 'Theme',
    components: {SentencesFilter, Breadcrumbs, SentencesConstructor},

    data() {
        return {
            sentence: '',
            words: [],
            types: [],
            error: false
        };
    },
    computed: {
        typesId() {
            return this.types.filter(type => type.selected).map(type => type.id)
        }
    },
    watch: {
        types() {
            this.fetchSentences()
        }
    },
    mounted() {
        this.fetchTypes()
    },
    methods: {
        fetchSentences() {
            axios({
                method: 'get',
                url: `http://localhost:3005/api/sentences/${this.$route.params.path}?types=${this.typesId.join(',')}`
            })
                .then(({data}) => {
                    if (data.success) {
                        this.sentence = data.russian
                        this.words = data.words
                        this.error = false
                    } else {
                        this.error = true
                    }
                })
        },
        fetchTypes() {
            axios({
                method: 'get',
                url: `http://localhost:3005/api/sentences/types`
            })
                .then(({data}) => {
                    this.types = data.types.map(type => ({...type, selected: true}))
                });
        },
        updateFilter(typeId, value) {
            this.types = this.types.reduce((list, type) => {
                list.push({
                    ...type,
                    selected: type.id === typeId ? value : type.selected
                })
                return list
            }, [])
        }
    }
}
</script>

<style lang="scss" scoped>
.sentences-filter {
    margin-bottom: 15px;
}
</style>