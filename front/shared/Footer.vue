<template>
  <div class="footer">
    <div class="container">
      Сайт разработан командой <a href="https://serotonin.site">Serotonin</a>
    </div>
  </div>
</template>

<script>
export default {
    name: "Footer"
}
</script>

<style lang="scss" scoped>
.footer {
    margin-top: 100px;
    background: #7DC6BB;
    font-size: 18px;
    padding: 30px 0;
    color: #fff;

    a {
        color: inherit;
    }
}
</style>