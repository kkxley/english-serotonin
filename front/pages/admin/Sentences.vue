<template>
  <div class="sentences">
    <div class="sentences__header">
      <h1>Предложения</h1>
      <AddButton
        v-if="selectedTheme"
        @click="isShowAddForm = true"
      />
    </div>
    <div>
      <label>Тема:
        <select v-model="selectedTheme">
          <optgroup
            v-for="theme in themes"
            :key="theme.path"
            :label="theme.title"
          >
            <option
              v-for="subtheme in theme.child"
              :key="subtheme.title"
              :value="subtheme.path"
            >{{ theme.title }} {{ subtheme.title }}
            </option>
          </optgroup>
        </select>
      </label>
    </div>
    <div class="sentences__list">
      <p
        v-for="sentence in sentences"
        :key="sentence.sentence_id"
      >
        {{ sentence.russian }} / {{ sentence.english }}
      </p>
    </div>
    <SentencesAdd
      v-if="isShowAddForm"
      :theme="selectedTheme"
      @add="addSentences"
      @close="isShowAddForm=false"
    />
  </div>
</template>

<script>
import AddButton from "../../shared/AddButton.vue";
import {adminApi} from "../../shared/api";
import SentencesAdd from "./SentencesAdd.vue";

export default {
  name: "Sentences",
  components: {SentencesAdd, AddButton},
  data() {
    return {
      isShowAddForm: false,
      selectedTheme: "",
      themes: [],
      sentences: []
    };
  },
  watch: {
    selectedTheme() {
      this.fetchSentences()
    }
  },
  mounted() {
    adminApi.getThemes().then(themes => this.themes = themes);
    this.fetchSentences()
  },
  methods: {
    fetchSentences () {
      adminApi.getSentences(this.selectedTheme).then(sentences => this.sentences = sentences);
    },
    async addSentences({
                   type, russian, english
                 }) {
      await adminApi.addSentences(this.selectedTheme, type, russian, english)
      this.isShowAddForm = false;
      this.fetchSentences()
    }
  }
}
</script>


<style scoped lang="scss">
.sentences {
  flex: 1;

  &__header {
    display: flex;
    flex-direction: row;
    align-items: center;
    column-gap: 10px;
  }

  &__list {
    margin-top: 50px;
    display: flex;
    flex-direction: column;
    row-gap: 10px;
  }
}
</style>