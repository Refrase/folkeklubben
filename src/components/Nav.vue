<template>
  <ul class="nav" :style="{ justifyContent: isWelcomeRoute ? 'center' : null }">
    <li v-if="!isWelcomeRoute"><router-link :to="{ name: 'nyheder' }" class="navItem navItem-nyheder"
      :exact-active-class="routeName == 'nyheder' ? `active-${routeName}` : null">Nyheder</router-link></li>
    <li v-if="!isWelcomeRoute"><router-link :to="{ name: 'koncerter' }" class="navItem navItem-koncerter"
      :exact-active-class="routeName == 'koncerter' ? `active-${routeName}` : null">Koncerter</router-link></li>
    <li v-if="!isWelcomeRoute"><router-link :to="{ name: 'musik' }" class="navItem navItem-musik"
      :exact-active-class="routeName == 'musik' ? `active-${routeName}` : null">Musik</router-link></li>
    <li v-if="!isWelcomeRoute"><a :href="merchLink ? merchLink : '#'" target="_blank" class="navItem navItem-merch">Merch</a></li>
    <li :style="{ marginRight: isWelcomeRoute ? '8px' : null }"><router-link :to="{ name: 'presse' }" class="navItem navItem-presse"
      :exact-active-class="routeName == 'presse' ? `active-${routeName}` : null">Presse</router-link></li>
    <li><router-link :to="{ name: 'kontakt' }" class="navItem navItem-kontakt"
      :exact-active-class="routeName == 'kontakt' ? `active-${routeName}` : null">Kontakt</router-link></li>
  </ul>
</template>

<script>
  import { routeColors } from '@/utils/colorVars'
  import { fetchData } from '@/utils/fetchData'
  export default {
    name: 'Nav',
    mixins: [fetchData],
    data() {
      return {
        merchLink: null
      }
    },
    computed: {
      routeName() { return this.$route.name },
      isWelcomeRoute() { return this.$route.name == 'velkommen' }
    },
    created() {
      this.fetchData( 'pages?slug=merch' ).then( res => { this.merchLink = res ? res[0].acf.external_link : null })
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

    @include breakpoint( 'tablet' ) { justify-content: center !important; }
    @include breakpoint( 'custom', '480px' ) { width: 220px; margin: 0 auto; }
    @include breakpoint( 'custom', '1400px', true ) { margin: 0 auto; width: 316px; }

    li {
      @include breakpoint( 'tablet' ) {
        font-size: 12px !important;
        margin-right: $scale;
        &:last-child { margin-right: 0 !important; }
      }
    }

    .navItem {
      display: block;
      font-family: $fontFamily-sans;
      text-transform: uppercase;
      font-size: 11px !important;
      opacity: 1;
      transition: color 0.25s ease-out;
      color: $color-gold-darker-2;
      line-height: 1.5;
      letter-spacing: 0;

      &:hover { color: $color-gold-darker-4; }
    }

    .active {
      &-nyheder,
      &-nyheder:hover { color: $color-news; }
      &-koncerter,
      &-koncerter:hover { color: $color-concerts; }
      &-musik,
      &-musik:hover { color: $color-music; }
      &-presse,
      &-presse:hover,
      &-kontakt,
      &-kontakt:hover { color: $color-gold-darker-4; }
    }
  }
</style>
