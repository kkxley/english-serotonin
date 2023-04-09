<template>
  <div class="filter">
    <CheckBox
      v-for="type in types"
      :key="type.id"
      :title="type.title"
      :value="type.selected"
      @update:value="$emit('update:filter', type.id, $event)"
    />
  </div>
</template>
<script>
import axios from "axios";
import CheckBox from "../../shared/CheckBox.vue";

export default {
    name: "SentencesFilter",
    components: {CheckBox},
    props: {
        types: {
            type: Array,
            default: () => []
        }
    },
    emits: ['update:filter']
}
</script>

<style lang="scss" scoped>
.filter {
    display: flex;
    flex-direction: row;
    column-gap: 8px;
    row-gap: 8px;
    flex-wrap: wrap;
}
</style>