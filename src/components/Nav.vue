<template>
  <ul class="nav" :class="{ 'nav-active': active }" :style="{ justifyContent: isWelcomeRoute ? 'center' : null }" @click="closeMobileNav">

    <li v-if="!isWelcomeRoute"><router-link :to="{ name: 'nyheder' }" class="navItem navItem-nyheder"
      :exact-active-class="routeName == 'nyheder' ? `active-${routeName}` : null">Nyheder</router-link></li>

    <li v-if="!isWelcomeRoute"><router-link :to="{ name: 'koncerter' }" class="navItem navItem-koncerter"
      :exact-active-class="routeName == 'koncerter' ? `active-${routeName}` : null">Koncerter</router-link></li>

    <li v-if="!isWelcomeRoute"><router-link :to="{ name: 'musik' }" class="navItem navItem-musik"
      :exact-active-class="routeName == 'musik' ? `active-${routeName}` : null">Musik</router-link></li>

    <li><a :href="merchLink ? merchLink : '#'" target="_blank" :class="{ 'navItem-frontPage': isWelcomeRoute }" class="navItem navItem-merch">Merch</a></li>

    <li :class="{ 'navItemWrap-frontpage': isWelcomeRoute }">
      <router-link :to="{ name: 'presse' }" :class="{ 'navItem-frontPage': isWelcomeRoute }" class="navItem navItem-presse"
      :exact-active-class="routeName == 'presse' ? `active-${routeName}` : null">Presse</router-link>
    </li>

    <li :class="{ 'navItemWrap-frontpage': isWelcomeRoute }">
      <router-link :to="{ name: 'kontakt' }" class="navItem navItem-kontakt" :class="{ 'navItem-frontPage': isWelcomeRoute }"
      :exact-active-class="routeName == 'kontakt' ? `active-${routeName}` : null">Kontakt</router-link>
    </li>

  </ul>
</template>

<script>
  import { routeColors } from '@/utils/colorVars'
  import { fetchData } from '@/utils/fetchData'
  export default {
    name: 'Nav',
    mixins: [fetchData],
    props: {
      active: Boolean
    },
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
    },
    methods: {
      closeMobileNav() { this.$emit( 'closeMobileNav' ) }
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

    li {
      @include breakpoint( 'tablet' ) {
        font-size: 12px !important;
        margin-right: $scale;
        &:last-child { margin-right: 0 !important; }
      }
      @include breakpoint( 'mobile' ) {
        margin-right: 0;
      }
    }

    @include breakpoint( 'tablet' ) { justify-content: center !important; }
    @include breakpoint( 'custom', '480px' ) { width: 220px; margin: 0 auto; }
    @include breakpoint( 'custom', '1400px', true ) { margin: 0 auto; width: 316px; }

    @include breakpoint( 'mobile' ) {
      background-color: rgba($color-gold, 0.98);
      position: absolute;
      top: 0;
      left: -15px;
      width: calc( 100% + 30px );
      height: 100vh;
      flex-direction: column;
      align-items: center;
      opacity: 0;
      z-index: -1;
      pointer-events: none;
      transition: opacity .3s ease-in;

      &-active {
        opacity: 1;
        z-index: 1000;
        pointer-events: all;
      }
    }

    .navItemWrap {
      &-frontpage {
        position: absolute;
        margin-right: 8px;
        text-shadow: 0px 0px 10px rgba(0,0,0,0.5);
        z-index: 0;

        opacity: 0;
        transform: translate3d( 0, -48px, 0 );
        animation: fadeIn 0.6s 3.6s ease-out forwards, slideDownFrontpageNavItems .6s 3.6s ease-out forwards;

        @include breakpoint( 'tablet' ) { opacity: 1; animation: none; transform: translate3d(0,0,0); }
        @include breakpoint( 'mobile' ) {
          position: relative;
          margin-right: 0;
          text-shadow: 0px 0px 0px rgba(0,0,0,0);
        }

        & .navItem-presse {
          transform: translate3d(32px,80px,0);
          @include breakpoint( 'tablet' ) { transform: translate3d(32px,4px,0); }
          @include breakpoint( 'mobile' ) { transform: translate3d(0,0,0); }
        }
        & .navItem-kontakt {
          transform: translate3d(-32px,80px,0);
          @include breakpoint( 'tablet' ) { transform: translate3d(-32px,4px,0); }
          @include breakpoint( 'mobile' ) { transform: translate3d(0,0,0); }
        }
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
      letter-spacing: 0.5px;

      @include breakpoint( 'tablet' ) { padding: $scale-1-2 0 0; }
      @include breakpoint( 'mobile' ) { font-size: 36px !important; }

      &-frontPage {
        color: white;
        &:hover { color: white !important; }
        @include breakpoint( 'mobile' ) {
          color: $color-gold-darker-2;
          &:hover { color: $color-gold-darker-4 !important; }
        }
        &.navItem-merch {
          display: none;
          @include breakpoint( 'mobile' ) { display: block; }
        }
      }

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
