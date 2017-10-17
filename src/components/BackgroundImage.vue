<template>
  <div class="backgroundImageContainer">
    <div v-if="backgroundColor" class="backgroundColor" v-bind:style="{ backgroundColor: backgroundColor }" />
    <div
      class="backgroundImage"
      :class="{ fadeIn: backgroundImage ? true : null }"
      v-bind:style="{ backgroundImage: backgroundImage ? 'url(' + backgroundImage + ')' : null }" />
    <div class="backgroundImageOverlay" v-bind:style="{ backgroundColor: imageOverlayColor ? imageOverlayColor : null }" />
  </div>
</template>

<script>
  export default {
    name: 'BackgroundImage',
    props: {
      backgroundColor: String,
      backgroundImage: String,
      imageOverlayColor: String
    }
  }
</script>

<style lang="scss" scoped>
  @import '~@/styles/helpers';

  .backgroundImageContainer {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
  }

  .backgroundColor {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
  }

  .backgroundImage {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-repeat: no-repeat;
    background-position: bottom right;
    background-size: cover;
  }

  .backgroundImageOverlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0.9;
  }

</style>
