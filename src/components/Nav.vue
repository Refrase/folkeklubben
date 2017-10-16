<template>
  <ul class="nav" v-if="routeName != 'start'">
    <li><router-link :to="{ name: 'nyheder' }">Nyheder</router-link></li>
    <li><router-link :to="{ name: 'koncerter' }">Koncerter</router-link></li>
    <li><a>Musik</a></li>
    <li><a>Merch</a></li>
    <li><a>Om</a></li>
    <li><a>Kontakt</a></li>
  </ul>
</template>

<script>
  export default {
    name: 'Nav',
    computed: {
      routeName() { return this.$route.name }
    }
  }
</script>

<style lang="scss" scoped>
  @import '~@/styles/vars';
  @import '~@/styles/breakpoints';

  .nav {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    list-style: none;
    white-space: nowrap;
    margin-top: $scale-1-2;

    @include breakpoint( 'tablet' ) {
      justify-content: center !important;
      margin-top: $scale + $scale-1-2;
    }

    a {
      font-family: $fontFamily-sans;
      text-transform: uppercase;
      font-size: $fontSize-xsmall;
      opacity: 1;
      transition: opacity 0.15s ease-out;

      &:hover { opacity: 0.7; }

      @include breakpoint( 'tablet' ) { margin-right: $scale; }
    }

    .active { color: white; }
  }
</style>
