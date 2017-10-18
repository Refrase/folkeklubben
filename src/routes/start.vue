<template>
  <div class="startRoute">
    <background :page="page" :color="backgroundColor" />
    <h1 v-if="page" class="welcome">Velkommen i <span>Folkeklubben</span></h1>
    <ul class="links">
      <li><router-link :to="{ name: 'nyheder' }"><span>Nyheder</span></router-link></li>
      <li><router-link :to="{ name: 'koncerter' }"><span>Koncerter</span></router-link></li>
      <li><router-link :to="{ name: 'musik' }"><span>Musik</span></router-link></li>
      <li><router-link :to="{ name: 'merch' }"><span>Merch</span></router-link></li>
    </ul>
  </div>
</template>

<script>
  import Background from '@/components/Background'
  import { routeColors } from '@/utils/colorVars'
  import { fetchData } from '@/utils/fetchData'
  export default {
    name: 'StartRoute',
    components: { 'background': Background },
    mixins: [fetchData],
    data() {
      return {
        page: null,
        backgroundColor: routeColors.start.bg
      }
    },
    created() { this.fetchData( 'pages?slug=start' ).then( res => this.page = res ) }
  }
</script>

<style lang="scss" scoped>
  @import '~@/styles/vars';
  @import '~@/styles/breakpoints';

  .start {
    .backgroundImage {
      @include breakpoint( 'mobile' ) { background-position: -650px top; }
    }
  }

  .welcome {
    color: white;
    width: 100%;
    text-align: center;
    text-shadow: 0px 0px 100px rgba(0,0,0,0.5);
    font-size: $fontSize-xxxlarge;
    @include breakpoint( 'tablet' ) { font-size: $fontSize-base; }

    opacity: 0;
    animation: fadeIn .6s ease-out forwards, slideUp .6s 1.5s ease-in forwards, fadeOut .6s 1.5s ease-out forwards;

    span {
      display: block;
      font-family: $fontFamily-sansCondensed;
      font-size: $fontSize-display;
      text-transform: uppercase;

      @include breakpoint( 'tablet' ) { font-size: 100px; }
      @include breakpoint( 'mobile' ) { font-size: 48px; }
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

    @include breakpoint( 'tablet' ) { flex-wrap: wrap; height: 180px; }
    @include breakpoint( 'custom', '480px' ) { height: 320px; }

    li {
      width: 25%;
      height: 100%;
      opacity: 0;

      $animationDelay: 3;
      animation: fadeIn .6s #{$animationDelay}s ease-out forwards;

      @include breakpoint( 'tablet' ) { width: 50%; height: 50%; }
      @include breakpoint( 'custom', '480px' ) { width: 100%; height: 25%; }

      transition: background-color 0.15s ease-out;

      &:nth-child(1) {
        background-color: rgba(white, 0.9);
        a { color: $color-darkblue; }
        &:hover { background-color: white; }}

      &:nth-child(2) {
        background-color: rgba($color-lightred, 0.9);
        animation-delay: #{$animationDelay + 0.1}s;
        &:hover { background-color: $color-lightred; }}

      &:nth-child(3) {
        background-color: rgba($color-darkblue, 0.9);
        animation-delay: #{$animationDelay + 0.2}s;
        &:hover { background-color: $color-darkblue; }}

      &:nth-child(4) {
        background-color: rgba($color-gold, 0.9);
        animation-delay: #{$animationDelay + 0.3}s;
        &:hover { background-color: $color-gold; }}
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
