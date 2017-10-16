<template>
  <ul class="nav" v-if="routeName != 'start'">
    <li><router-link :to="{ name: 'nyheder' }" class="navItem navItem-nyheder"
      :exact-active-class="routeName == 'nyheder' ? `active-${routeName}` : null">Nyheder</router-link></li>
    <li><router-link :to="{ name: 'koncerter' }" class="navItem navItem-koncerter"
      :exact-active-class="routeName == 'koncerter' ? `active-${routeName}` : null">Koncerter</router-link></li>
    <li><router-link :to="{ name: 'musik' }" class="navItem navItem-musik"
      :exact-active-class="routeName == 'musik' ? `active-${routeName}` : null">Musik</router-link></li>
    <li><router-link :to="{ name: 'merch' }" class="navItem navItem-merch"
      :exact-active-class="routeName == 'merch' ? `active-${routeName}` : null">Merch</router-link></li>
    <li><router-link :to="{ name: 'om' }" class="navItem navItem-om"
      :exact-active-class="routeName == 'om' ? `active-${routeName}` : null">Om</router-link></li>
    <li><router-link :to="{ name: 'kontakt' }" class="navItem navItem-kontakt"
      :exact-active-class="routeName == 'kontakt' ? `active-${routeName}` : null">Kontakt</router-link></li>
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

    .navItem {
      font-family: $fontFamily-sans;
      text-transform: uppercase;
      font-size: $fontSize-xsmall;
      opacity: 1;
      transition: color 0.25s ease-out;
      color: $color-gold-darker-2;

      &:hover { color: $color-gold-darker-4; }
      &-nyheder:hover { color: $color-news; }
      &-koncerter:hover { color: $color-concerts; }
      &-musik:hover { color: $color-music; }

      @include breakpoint( 'tablet' ) { margin-right: $scale; }
    }

    .active {
      // color: $color-start;
      &-nyheder { color: $color-news; }
      &-koncerter { color: $color-concerts; }
      &-musik { color: $color-music; }
    }
  }
</style>
