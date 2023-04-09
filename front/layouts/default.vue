<template>
  <div class="main">
    <Header />
    <div class="main__content container">
      <slot>
        <router-view />
      </slot>
    </div>
    <Footer />
  </div>
</template>
<script>
import Footer from "../shared/Footer.vue";
import Header from "../shared/Header.vue";

export default {
  components: {Header, Footer}

}
</script>
<style lang="scss" scoped>
.main {
  display: flex;
  flex-direction: column;
  overflow-x: hidden;
  height: 100vh;

  &__content {
    flex: 1;
  }
}
</style>