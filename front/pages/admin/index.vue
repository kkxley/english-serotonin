<template>
  <div class="content">
    <Sentences />
    <Words />
  </div>
</template>

<script>
import Sentences from "./Sentences.vue";
import Words from "./Words.vue";

export default {
  name: 'Admin',
  components: {Words, Sentences},

}
</script>

<style scoped lang="scss">
.content {
  display: flex;
  flex-direction: row;
}
</style>