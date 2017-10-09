<template>
  <div class="appContainer">
    <div class="appBorders"><div/><div/><div/><div/></div>
    <app-header />
    <router-view />
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
    }
  }
</script>

<style lang="scss">
  @import '~@/styles/main';
  .appContainer { width: 100%; min-height: 100%; }
  .appBorders { // Solution made to take into account that everything underneath should be clickable
    & * { position: fixed; background-color: $color-gold; }
    & div:nth-child(1),
    & div:nth-child(3) { height: 16px; width: 100%; }
    & div:nth-child(2),
    & div:nth-child(4) { width: 15px; height: 100%; } // Optically adjusted
    & div:nth-child(1) { top: 0; left: 0; }
    & div:nth-child(2) { top: 0; right: 0; }
    & div:nth-child(3) { bottom: 0; left: 0; }
    & div:nth-child(4) { top: 0; left: 0; }
  }
</style>
