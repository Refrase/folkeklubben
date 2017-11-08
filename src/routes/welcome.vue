<template>
  <div class="welcomeRoute">
    <background :page="page ? page[0] : null" :color="backgroundColor" />
    <h1 v-if="1 === 2" class="welcome">Velkommen i <span>Folkeklubben</span></h1>
    <spinner v-if="loadingPage" v-bind:style="{ bottom: 'calc( 100vh - ' + (backgroundImageHeight - 7) + 'px )' }" />
    <ul class="links" v-bind:style="{ height: 'calc( 100vh - ' + backgroundImageHeight + 'px )' }">
      <li><router-link :to="{ name: 'nyheder' }"><span>Nyheder</span></router-link></li>
      <li><router-link :to="{ name: 'koncerter' }"><span>Koncerter</span></router-link></li>
      <li><router-link :to="{ name: 'musik' }"><span>Musik</span></router-link></li>
      <li><a :href="merchLink" target="_blank"><span>Merch</span></a></li>
    </ul>
  </div>
</template>

<script>
  import Background from '@/components/Background'
  import Spinner from '@/components/Spinner'
  import { routeColors } from '@/utils/colorVars'
  import { fetchData } from '@/utils/fetchData'
  export default {
    name: 'WelcomeRoute',
    components: {
      background: Background,
      spinner: Spinner
    },
    mixins: [fetchData],
    data() {
      return {
        backgroundColor: routeColors.velkommen.bg,
        loadingPage: true,
        page: null,
        merchLink: null
      }
    },
    computed: {
      backgroundImageHeight() { // For dynamically setting the height of the bottom links container, so that the same image format can be used across screensizes
        const actualImageHeight = window.innerWidth / 1.8 // Using the image width/height ratio to calculate height from window width as the image spans full width

        let menuHeight = 0
        if ( window.innerWidth < 768 ) menuHeight = 124
        else if ( window.innerWidth < 480 ) menuHeight = 157

        let backgroundImageHeight = null
        if ( actualImageHeight > window.innerHeight - 100 ) backgroundImageHeight = window.innerHeight - 100 + 15 + menuHeight
        else                                                backgroundImageHeight = window.innerWidth / 1.8 + 15 + menuHeight

        return backgroundImageHeight
      }
    },
    created() {
      this.fetchData( 'pages?slug=velkommen' ).then( res => {
        this.loadingPage = false
        this.page = res
      })
      this.fetchData( 'pages?slug=merch' ).then( res => { this.merchLink = res ? res[0].acf.external_link : null })
    }
  }
</script>

<style lang="scss">
  @import '~@/styles/breakpoints';
  .welcomeRoute {
    position: relative;
    height: 100%;
    overflow: hidden; // Avoiding scrollbars showing before everything has animated in
  }
  .welcomeRoute .backgroundImage {
    background-position: top center !important;
    background-size: contain !important;
    @include breakpoint( 'tablet' ) { animation-delay: .5s !important; }
    @include breakpoint( 'mobile' ) { background-position: center 124px !important; }
    @include breakpoint( 'custom', '480px') { background-position: center 142px !important; }
  }
</style>

<style lang="scss" scoped>
  @import '~@/styles/vars';
  @import '~@/styles/breakpoints';

  .welcome {
    color: white;
    width: 100%;
    text-align: center;
    text-shadow: 0px 0px 100px rgba(0,0,0,0.5);
    font-size: $fontSize-xxxlarge;
    position: relative;
    bottom: -40px;
    @include breakpoint( 'mobile' ) { bottom: 40px; }
    @include breakpoint( 'tablet' ) { font-size: $fontSize-base; }

    opacity: 0;
    animation: fadeIn .6s 0.5s ease-out forwards, slideUp .6s 2.5s ease-in forwards, fadeOut .6s 2.5s ease-out forwards;

    span {
      display: block;
      font-family: $fontFamily-sansCondensed;
      font-size: $fontSize-display;
      text-transform: uppercase;

      @include breakpoint( 'tablet' ) { font-size: 90px; }
      @include breakpoint( 'mobile' ) { font-size: 42px; }
    }
  }

  .links {
    display: flex;
    position: absolute;
    bottom: $scale-2-1;
    left: 15px;
    width: calc( 100% - 30px ); // Borders
    height: 100px;
    list-style: none;
    opacity: 0;
    animation: fadeIn 0.6s ease-out forwards;

    @include breakpoint( 'tablet' ) {
      animation-delay: 0s !important;
      flex-wrap: wrap;
    }

    li {
      width: 25%;
      height: 100%;

      @include breakpoint( 'tablet' ) { width: 50%; height: 50%; }
      @include breakpoint( 'custom', '480px' ) { width: 100%; height: 25%; }

      transition: background-color 0.15s ease-out;

      &:nth-child(1) {
        background-color: $color-news;
        a { color: $color-darkblue; }
        &:hover { background-color: mix(black, $color-news, 8%); }}

      &:nth-child(2) {
        background-color: $color-concerts;
        &:hover { background-color: mix(black, $color-concerts, 8%); }}

      &:nth-child(3) {
        background-color: $color-music;
        &:hover { background-color: mix(black, $color-music, 8%); }}

      &:nth-child(4) {
        background-color: $color-merch;
        &:hover { background-color: mix(black, $color-merch, 8%); }}
    }

    a {
      display: flex;
      align-items: center;
      width: 100%;
      height: 100%;
      font-family: $fontFamily-sansCondensed;
      text-transform: uppercase;
      color: white;
      font-size: $fontSize-xxxlarge;
      letter-spacing: 0;

      span {
        width: 100%;
        text-align: center;
      }
    }
  }
</style>
