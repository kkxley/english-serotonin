<template>
  <div class="header container">
    <div class="header__logo">
      <div class="header__logo__name">
        Serotonin
      </div>
      <div class="header__logo__sub">
        english practice
      </div>
    </div>
  </div>
</template>

<script>
export default {
    name: 'Header'
}
</script>

<style lang="scss" scoped>
.header {
    display: flex;
    align-items: center;
    padding-top: 25px;
    margin-bottom: 70px;
    box-sizing: border-box;

    &__logo {
        display: flex;
        align-items: center;
        flex-direction: column;
        font-family: 'Raleway', sans-serif;

        &__name {
            font-weight: 800;
            font-size: 30px;
            line-height: 35px;
        }

        &__sub {
            font-weight: 400;
            font-size: 19px;
            letter-spacing: 0.02em;
            line-height: 16px;
        }
    }
}
</style>