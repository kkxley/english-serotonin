<template>
  <div class="welcome">
    <div class="welcome__title">
      Тренируйтесь легко
    </div>
    <div class="welcome__description">
      {{
        `Наше обучающее приложение предоставляет возможность тренировать навыки составления предложений на английском языке.
        \nВы сможете улучшить свой словарный запас и научиться строить грамматически правильные предложения.`
      }}
    </div>
    <img
      class="welcome__img"
      src="/welcome.png"
      alt="Serotonin"
    >
  </div>
  <Greetings
    title="Выберите тему"
    :description="`Добро пожаловать в раздел выбора темы тренировки нашего обучающего приложения!\nЗдесь вы можете выбрать тему, которую хотите изучить, и улучшить свои знания на эту тему на английском языке.`"
  />
  <ThemeSection
    v-for="theme in themes"
    :key="theme.path"
    :title="theme.title"
    :themes="theme.child"
  />
</template>
<script>

import ThemeSection from "../shared/ThemeSection.vue";
import Greetings from "../shared/Greetings.vue";
import api from "../shared/api";

export default {
    name: "Index",
    components: {Greetings, ThemeSection},
    data() {
        return {
            themes: []
        };
    },
    mounted() {
        api.getThemes().then(themes => this.themes = themes);
    }
}
</script>
<style lang="scss" scoped>
.welcome {
    position: relative;
    color: #fff;
    padding: 60px 0 77px 0;
    margin-bottom: 50px;

    &::before {
        content: "";
        display: block;
        height: 100%;
        width: 200vw;
        background: #7DC6BB;
        position: absolute;
        left: -50vw;
        top: 0;
    }

    &__title {
        font-weight: 700;
        font-size: 46px;
        position: relative;
        margin-bottom: 23px;
        width: 50%;
        font-family: 'Raleway', sans-serif;
    }

    &__description {
        font-weight: 400;
        font-size: 22px;
        position: relative;
        width: 50%;
        font-family: 'Raleway', sans-serif;
        white-space: break-spaces;
    }

    &__img {
        position: absolute;
        right: 0;
        bottom: 0;
        width: 50%;
        height: auto;
        max-width: 570px;
    }
}
</style>