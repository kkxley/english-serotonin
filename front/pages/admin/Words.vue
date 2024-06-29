<template>
  <div class="words">
    <div class="words__header">
      <h1>Слова для запутывания</h1>
      <AddButton />
    </div>
  </div>
</template>

<script>
import AddButton from "../../shared/AddButton.vue";

export default {
  name: "Words",
  components: {AddButton}
}
</script>

<style scoped lang="scss">
.words {
  flex: 1;

  &__header {
    display: flex;
    flex-direction: row;
    align-items: center;
    column-gap: 10px;
  }
}
</style>