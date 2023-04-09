<template>
  <div class="card">
    <h3 class="card__title">
      {{ title }}
    </h3>
    <div class="card__description">
      {{ description }}
    </div>
  </div>
</template>

<script>
export default {
    name: "Card",
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
.card {
    cursor: pointer;
    display: flex;
    flex-direction: column;
    padding: 20px 25px 25px;
    background: #FEFEFE;
    box-shadow: 0 8px 15px rgba(2, 91, 78, 0.15);
    border-radius: 7px;

    &__title {
        font-weight: 700;
        font-size: 26px;
    }

    &__description {
        font-weight: 400;
        font-size: 18px;
        margin-top: 10px;
    }
}
</style>