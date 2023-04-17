<template>
  <div class="theme">
    <div class="theme__description">
      {{ theme.description }}
    </div>
    <div
      v-if="theme.formula_simple"
      class="theme__formula"
    >
      {{ theme.formula_simple }}
    </div>
    <div
      v-if="theme.formula_question"
      class="theme__formula"
    >
      {{ theme.formula_question }}
    </div>
    <div v-if="theme.examples?.length">
      <h3>Примеры:</h3>
      <ul class="theme__examples">
        <li
          v-for="(example, i) in theme.examples"
          :key="i"
        >
          {{ example }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
    name: "ThemeContent",
    props: {
        theme: {
            type: Object,
            default: () => ({})
        }
    },
}
</script>

<style lang="scss" scoped>
.theme {
    display: flex;
    flex-direction: column;
    row-gap: 15px;

    &__formula {
        border: 1px solid #000;
        padding: 15px;
    }

    &__examples {
        margin-top: 10px;
        display: flex;
        flex-direction: column;
        row-gap: 8px;
        margin-left: 15px;
    }
}
</style>