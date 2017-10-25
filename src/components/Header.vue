<template>
  <grid-block noPadding class="header" :class="{ 'header-frontpageFirstVisit': routeName == 'Velkommen' && firstVisit }">
    <div class="span-7" style="display: flex; align-items: flex-end;">
      <h1
        class="headline"
        v-if="routeName && routeName != 'Velkommen'"
        v-bind:style="{ color: routeColors[routeName.toLowerCase()] ? routeColors[routeName.toLowerCase()].text : null }">{{ routeName }}</h1>
    </div>
    <div class="span-5">
      <appMenu :routeChange="routeChange" />
    </div>
  </grid-block>
</template>

<script>
  import GridBlock from '@/components/GridBlock'
  import Menu from '@/components/Menu'
  import { routeColors } from '@/utils/colorVars'
  export default {
    name: 'Header',
    components: {
      'grid-block': GridBlock,
      'appMenu': Menu
    },
    props: { routeChange: Object },
    data() {
      return { routeColors: routeColors }
    },
    computed: {
      routeName() { return this.$route.name ? this.$route.name.replace( this.$route.name.charAt(0), this.$route.name.charAt(0).toUpperCase() ) : null },
      firstVisit() { return !this.routeChange.from && !this.routeChange.to }
    }
  }
</script>

<style lang="scss" scoped>

  @import '~@/styles/breakpoints';
  @import '~@/styles/animations';

  .header {
    position: relative;
    height: 153px;
    z-index: 101;

    @include breakpoint( 'mobile' ) { height: 135px; }

    &-frontpageFirstVisit {
      transform: translate3d(0, -100vh, 0);
      animation: slideDown 1.2s 1.5s cubic-bezier(0,.5,.0,1) forwards;
      @include breakpoint( 'tablet' ) { animation-delay: 0s !important; }
    }
  }

  .headline {
    margin-left: -6px;
    font-size: 100px;
    width: 100%;

    @include breakpoint( 'tablet' ) {
      margin-left: -4px;
      font-size: 60px !important;
    }

    @include breakpoint( 'mobile' ) {
      margin-left: 0px;
      font-size: 36px !important;
      margin-top: 180px;
      text-align: center;
    }
  }

</style>
