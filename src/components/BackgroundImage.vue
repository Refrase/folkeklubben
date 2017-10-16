<template>
  <div>
    <div v-if="backgroundColor" class="backgroundColor" v-bind:style="{ backgroundColor: backgroundColor }" />
    <div
      class="backgroundImage"
      :class="{ fadeIn: backgroundImage ? true : null }"
      v-bind:style="{ backgroundImage: backgroundImage ? 'url(' + backgroundImage + ')' : null }" />
  </div>
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

  .backgroundColor {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
  }

  .backgroundImage {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-repeat: no-repeat;
    background-position: bottom right;
    background-size: cover;
  }
  
</style>
