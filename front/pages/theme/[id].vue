<template>
  <div>
    <Breadcrumbs :routes="[{name: 'Главная'}, {name: 'Present Simple'}]" />
    <Greetings
      title="Present Simple"
      description="Какой-то сопутствующий текст, объясняющий этот раздел"
    />
    <ThemeSection :themes="themes" />
  </div>
</template>

<script>
import Breadcrumbs from "../../shared/Breadcrumbs.vue";
import ThemeSection from "../../shared/ThemeSection.vue";
import Greetings from "../../shared/Greetings.vue";

export default {
  name: 'Theme',
  components: {Greetings, ThemeSection, Breadcrumbs},

  data() {
    return {
      themes: [
        {
          title: 'Present Simple',
          description: 'Описание тем, которые ждут внутри карточки'
        },
        {
          title: 'Present Perfect',
          description: 'Описание тем, которые ждут внутри карточки'
        },
        {
          title: 'Present Continuous',
          description: 'Описание тем, которые ждут внутри карточки'
        },
        {
          title: 'Present Simple',
          description: 'Описание тем, которые ждут внутри карточки'
        },
        {
          title: 'Present Perfect',
          description: 'Описание тем, которые ждут внутри карточки'
        },
        {
          title: 'Present Continuous',
          description: 'Описание тем, которые ждут внутри карточки'
        }
      ]
    };
  },
}
</script>

<style scoped>

</style>