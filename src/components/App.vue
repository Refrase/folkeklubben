<template>
  <div class="appContainer">
    <div class="appBorders">
      <div class="top" />
      <div class="right" />
      <div class="bottom" />
      <div class="left" />
    </div>
    <app-header :routeChange="routeChange" />
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
    props: {
      routeChange: Object
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
    z-index: 100;
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
    margin-top: -$headerHeight;
    padding-top: $routePaddingTop;
    padding-bottom: $headerHeight;

    @include breakpoint( 'tablet' ) {
      padding-top: $routePaddingTopTablet;
    }

    @include breakpoint( 'mobile' ) {
      margin-top: -$headerHeightMobile;
      padding-top: $routePaddingTopMobile;
      padding-bottom: $headerHeightMobile;
    }
  }

</style>
