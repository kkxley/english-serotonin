<template>
  <div class="welcome">
    <div class="welcome__title">
      Тренируйтесь легко
    </div>
    <div class="welcome__description">
      Маркетинговая коммуникация выражена наиболее полно. Как отмечает Майкл
    </div>
    <img
      class="welcome__img"
      src="/welcome.png"
      alt="Serotonin"
    >
  </div>
  <Greetings
    title="Header"
    description="Какой-то сопутствующий текст, объясняющий этот раздел"
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
import axios from "axios";

export default {
    name: "Index",
    components: {Greetings, ThemeSection},
    data() {
        return {
            themes: []
        };
    },
    async mounted() {
        axios({
            method: 'get',
            url: 'http://localhost:3005/api/themes'
        })
            .then(({data}) => {
                this.themes = data
            });
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
        font-size: 65px;
        position: relative;
        margin-bottom: 23px;
        width: 50%;
        font-family: 'Raleway', sans-serif;
    }

    &__description {
        font-weight: 400;
        font-size: 30px;
        position: relative;
        width: 50%;
        font-family: 'Raleway', sans-serif;
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