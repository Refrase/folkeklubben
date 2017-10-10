<template>
  <div class="appContainer">
    <div class="appBorders">
      <div class="top" />
      <div class="right" v-if="!isWebkit" /> <!-- TODO: Also show if no scrollbars on page -->
      <div class="bottom" />
      <div class="left" />
    </div>
    <app-header />
    <router-view class="route" />
    <app-footer />
  </div>
</template>

<script>
  import Header from '@/components/Header'
  import Footer from '@/components/Footer'
  export default {
    name: 'App',
    components: {
      'app-header': Header,
      'app-footer': Footer
    },
    computed: {
      isWebkit() {
        const isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
        const isSafari = /Safari/.test(navigator.userAgent) && /Apple Computer/.test(navigator.vendor);
        if ( isChrome || isSafari ) return true
      }
    }
  }
</script>

<style lang="scss">
  @import '~@/styles/main';

  .appContainer {
    width: 100%;
    min-height: 100%;
  }

  .appBorders { // Solution made to take into account that everything underneath should be clickable
    position: relative;
    z-index: 1;
    & * { position: fixed; background-color: $color-gold; }
    & .top,
    & .bottom { height: 16px; width: 100%; }
    & .right,
    & .left { width: 15px; height: 100%; } // Optically adjusted
    & .top { top: 0; left: 0; }
    & .right { top: 0; right: 0; }
    & .bottom { bottom: 0; left: 0; }
    & .left { top: 0; left: 0; }
  }

  .route {
    width: 100%;
    min-height: 100vh;
    margin-top: -180px;
    padding-top: 180px + $scale-8-1;
    padding-bottom: 180px;
  }

</style>
