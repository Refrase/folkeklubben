<template>
  <div class="backgroundVideoContainer" v-bind:style="{ backgroundColor: videoOverlayColor ? videoOverlayColor : null }">
    <video
      class="backgroundVideo"
      :class="{ fadeIn: backgroundVideo ? true : null }"
      :src="backgroundVideo ? backgroundVideo : null"
      :poster="backgroundImage ? backgroundImage : null"
      muted
      autoplay
      playsinline
      preload />
    <div class="backgroundVideoOverlay" v-bind:style="{ backgroundColor: videoOverlayColor ? videoOverlayColor : null }" />
  </div>
</template>

<script>
  export default {
    name: 'BackgroundVideo',
    props: {
      backgroundVideo: String,
      backgroundImage: String,
      videoOverlayColor: String
    }
  }
</script>

<style lang="scss" scoped>
  @import '~@/styles/helpers';

  .backgroundVideoContainer {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: -1;
  }

  .backgroundVideo {
    min-width: 100%;
    min-height: 100%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
  }

  .backgroundVideoOverlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0.9;
  }
</style>
