<template>
  <div>
    <label>
      <input
        :checked="value"
        type="checkbox"
        @change="$emit('update:value', !value)"
      >
      {{ title }}
    </label>
  </div>
</template>

<script>
export default {
    name: "CheckBox",
    props: {
        value: {
            type: Boolean,
            default: false
        },
        title: {
            type: String,
            required: true
        }
    },
    emits: ['update:value']
}
</script>

<style scoped>

</style>