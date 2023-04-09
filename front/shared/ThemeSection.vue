<template>
  <div class="section">
    <h2
      v-if="title"
      class="section__title"
    >
      {{ title }}
    </h2>
    <div class="section__cards">
      <Card
        v-for="theme in themes"
        :key="theme.path"
        :path="theme.path"
        :title="theme.title"
        :description="theme.description"
      />
    </div>
  </div>
</template>

<script>
import Card from "./Card.vue";

export default {
  name: "ThemeSection",
  components: {Card},
  props: {
    title: {
      type: String,
      default: null
    },
    themes: {
      type: Array,
      default: () => []
    }
  }
}
</script>

<style lang="scss" scoped>
.section {
  & + & {
    margin-top: 35px;
  }

  &__title {
    font-weight: 700;
    font-size: 26px;
    margin-bottom: 20px;
  }

  &__cards {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
  }
}
</style>