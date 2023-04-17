<template>
  <div class="theme">
    <Breadcrumbs :routes="[{name: 'Главная', path: '/'}, {name: themeCaption}]" />
    <h1 class="theme__title">
      {{ themeCaption }}
    </h1>
    <SentencesFilter
      class="sentences-filter"
      :types="types"
      @update:filter="updateFilter"
    />
    <SentencesConstructor
      v-if="!error"
      :initial-words="words"
      :sentence="sentence"
      @check="handlerCheck"
    />
    <div v-else>
      Таких предложений у нас пока нет
    </div>
    <ThemeContent
      class="theme-content"
      :theme="theme"
    />
  </div>
</template>

<script>
import Breadcrumbs from "../../shared/Breadcrumbs.vue";
import SentencesConstructor from "./SentencesConstructor.vue";
import axios from "axios";
import SentencesFilter from "./SentencesFilter.vue";
import ThemeContent from "./ThemeContent.vue";
import api from "../../shared/api";

export default {
    name: 'Theme',
    components: {ThemeContent, SentencesFilter, Breadcrumbs, SentencesConstructor},

    data() {
        return {
            sentence: '',
            words: [],
            types: [],
            error: false,
            theme: {},
        };
    },
    computed: {
        typesId() {
            return this.types.filter(type => type.selected).map(type => type.id)
        },
        themeCaption () {
            return [this.theme?.parent?.title, this.theme.title].filter(title => title).join(' ')
        }
    },
    watch: {
        types() {
            this.fetchSentences()
        }
    },
    mounted() {
        this.fetchTypes()
        this.fetchTheme()
    },
    methods: {
        fetchSentences() {
            api.getSentence(this.$route.params.path, this.typesId)
                .then(({success, russian, words, csrf, token}) => {
                    if (success) {
                        this.sentence = russian
                        this.words = words
                        this.error = false
                        api.setCSRF(csrf, token)
                    } else {
                        this.error = true
                    }
                })
        },
        fetchTypes() {
            api.getSentencesTypes()
                .then(({types}) => {
                    this.types = types.map(type => ({...type, selected: true}))
                });
        },
        fetchTheme() {
            api.getTheme(this.$route.params.path)
                .then(({theme}) => this.theme = theme)
        },
        updateFilter(typeId, value) {
            this.types = this.types.reduce((list, type) => {
                list.push({
                    ...type,
                    selected: type.id === typeId ? value : type.selected
                })
                return list
            }, [])
        },
        handlerCheck(words) {
            api.checkSentence({words, sentence: this.sentence})
                .then(({isValid}) => {
                    if (isValid) {
                        this.fetchSentences()
                    }
                })
        }
    }
}
</script>

<style lang="scss" scoped>

.theme {
    .sentences-filter {
        margin-bottom: 15px;
    }

    .theme-content {
        margin-top: 15px;
    }
}
</style>