<template>
  <div class="breadcrumbs">
    <div
      v-for="route in routes"
      class="breadcrumbs__item"
    >
      {{ route.name }}
    </div>
  </div>
</template>

<script>
export default {
  name: "Breadcrumbs",
  props: {
    routes: {
      type: Array,
      required: true
    }
  }
}
</script>

<style lang="scss" scoped>
.breadcrumbs {
  display: flex;
  margin-bottom: 40px;

  &__item {
    font-weight: 400;
    font-size: 16px;
    cursor: pointer;

    & + & {
      &::before {
        cursor: initial;
        content: '/';
        padding: 0 8px;
        color: #B7B7B7;
        font-weight: 400;
        font-size: 16px;
      }
    }
  }
}
</style>