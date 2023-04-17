<template>
  <div class="greetings">
    <h1 class="greetings__title">
      {{ title }}
    </h1>
    <div class="greetings__description">
      {{ description }}
    </div>
  </div>
</template>

<script>
export default {
    name: "Greetings",
    props: {
        title: {
            type: String,
            required: true
        },
        description: {
            type: String,
            required: true
        }
    }
}
</script>

<style lang="scss" scoped>
.greetings {
    margin-bottom: 30px;

    &__title {
        font-weight: 700;
        font-size: 40px;
        margin-bottom: 8px;
    }

    &__description {
        font-weight: 400;
        font-size: 22px;
        white-space: break-spaces;
    }
}
</style>