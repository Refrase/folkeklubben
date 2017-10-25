<template>
  <div class="background">
    <background-video v-if="video" :backgroundVideo="backgroundVideo" :backgroundImage="backgroundImage" :videoOverlayColor="color" :pause="pause ? pause : false" />
    <background-image v-else :backgroundImage="backgroundImage" :imageOverlayColor="color" :backgroundColor="color" />
  </div>
</template>

<script>
  import BackgroundImage from '@/components/BackgroundImage'
  import BackgroundVideo from '@/components/BackgroundVideo'
  export default {
    name: 'Background',
    components: {
      'background-image': BackgroundImage,
      'background-video': BackgroundVideo
    },
    props: {
      video: Boolean,
      page: Object,
      color: String,
      pause: Boolean
    },
    data() {
      return {
        backgroundImage: null,
        backgroundVideo: null
      }
    },
    watch: { page: 'setImageOrVideo' },
    methods: {
      setImageOrVideo() {
        if (this.page) {
          if (this.video) this.setBackgroundVideo()
          else this.setBackgroundImage()
        }
      },
      setBackgroundImage() { this.backgroundImage = this.page && this.page.acf['background_image'] ? this.page.acf['background_image'] : null },
      setBackgroundVideo() { this.backgroundVideo = this.page && this.page.acf['background_video'] ? this.page.acf['background_video'] : null },
    }
  }
</script>

<style lang="scss" scoped></style>
