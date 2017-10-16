<template>
  <div
    class="backgroundImage"
    :class="{ fadeIn: backgroundImage ? true : null }"
    v-bind:style="{
      backgroundColor: backgroundColor ? backgroundColor : null,
      backgroundImage: backgroundImage ? 'url(' + backgroundImage + ')' : null
    }" />
</template>

<script>
  export default {
    name: 'BackgroundImage',
    props: {
      backgroundColor: String,
      backgroundImage: String,
    }
  }
</script>

<style lang="scss" scoped>
  @import '~@/styles/helpers';
  .backgroundImage {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: white;
    background-repeat: no-repeat;
    background-position: bottom right;
    background-size: cover;
  }
</style>
