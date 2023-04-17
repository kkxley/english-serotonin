<template>
  <div class="breadcrumbs">
    <div
      v-for="route in routes"
      :key="route.name"
      class="breadcrumbs__item"
      @click="go(route.path)"
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
  },
    methods: {
        go(path) {
            if (path) {
                this.$router.push({path})
            }
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