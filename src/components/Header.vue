<template>
  <grid-block noPadding class="header">
    <div class="span-7" style="display: flex; align-items: flex-end;">
      <h1 class="headline" v-bind:style="{ color: routeColors[routeName.toLowerCase()].text }">{{ routeName }}</h1>
    </div>
    <div class="span-5">
      <appMenu />
    </div>
  </grid-block>
</template>

<script>
  import GridBlock from '@/components/GridBlock'
  import Menu from '@/components/Menu'
  export default {
    name: 'Header',
    components: {
      'grid-block': GridBlock,
      'appMenu': Menu
    },
    data() {
      return {
        routeColors: {
          nyheder: {
            bg: 'transparent',
            text: '#2B2847'
          },
          koncerter: {
            bg: '#FB5B64',
            text: '#fff'
          },
          musik: {
            bg: '#2B2847',
            text: '#fff'
          }
        }
      }
    },
    computed: {
      routeName() { return this.$route.name }
    }
  }
</script>

<style lang="scss" scoped>

  @import '~@/styles/breakpoints';

  .header {
    position: relative;
    height: 240px;
    z-index: 100;
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
      font-size: 48px !important;
      margin-top: 180px;
      text-align: center;
    }
  }

</style>
