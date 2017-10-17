<template>
  <transition :name="transitionName">
    <div
      class="menu"
      :class="{ 'menu-frontpage': routeName == 'start' }"
      :key="routeName">
      <div class="top">
        <router-link :to="{ name: 'start' }" exact class="logo">Folkeklubben</router-link>
        <appNav />
      </div>
      <form class="newsletter" action="index.html" method="post">
        <input type="email" name="email" id="email" placeholder="Få vores nyhedsbrev..." />
        <input type="submit" value="Tilmeld" />
      </form>
    </div>
  </transition>
</template>

<script>
  import Nav from '@/components/Nav'
  export default {
    name: 'Menu',
    components: { appNav: Nav },
    props: { routeChange: Object },
    computed: {
      routeName() { return this.$route.name },
      transitionName() {
        if (this.routeChange.from || this.routeChange.to) {
          return this.routeChange.from.path === '/' ? 'slideToSide' : this.routeChange.to.path === '/' ? 'slideToCenter' : null
        }
      }
    }
  }
</script>

<style lang="scss" scoped>
  @import '~@/styles/vars';
  @import '~@/styles/breakpoints';

  .fade-enter-active, .fade-leave-active { transition: opacity 5s; }
  .fade-enter, .fade-leave-to { opacity: 0; }

  .menu {
    width: 381px;
    position: fixed;
    transform: translate3d(0,0,0);

    @include breakpoint( 'tablet' ) {
      width: 275px;
      top: 0;
    }

    @include breakpoint( 'mobile' ) {
      left: 50%;
      transform: translate3d(-50%, 0, 0);
      width: calc( 100% - 40px );
    }

    @include breakpoint( 'custom', '1400px', true ) { width: 505px; }

    &-frontpage {
      left: 50%;
      transform: translate3d(-50%, 0, 0);
    }
  }

  .slideToSide-enter { transform: translate3d(-50%, 0, 0); }
  .slideToSide-enter-active { transition: all .6s ease-out; }
  .slideToSide-enter-to {
    transform: translate3d(0, 0, 0);
    @include breakpoint( 'mobile' ) { transform: translate3d(-50%, 0, 0); }
  }

  .slideToCenter-enter {
    transform: translate3d(0, 0, 0);
    @include breakpoint( 'mobile' ) { transform: translate3d(-50%, 0, 0); }
  }
  .slideToCenter-enter-active { transition: all .6s ease-out; }
  .slideToCenter-enter-to { transform: translate3d(-50%, 0, 0); }

  .top {
    background-color: $color-gold;
    padding: $scale-2-1 $scale-4-1;
  }

  .logo {
    display: block;
    font-family: $fontFamily-sansCondensed;
    text-transform: uppercase;
    width: 100%;
    text-align: center;
    line-height: 0.8;
    font-size: 57.7px;
    margin-bottom: $scale;
    margin-left: -2px;
    color: $color-start;
    transition: color .2s ease-out;

    @include breakpoint( 'tablet' ) { font-size: 39px; }
    @include breakpoint( 'custom', '1400px', true ) { margin-bottom: $scale-2-1; }

    &:hover { color: $color-darkblue; }
  }

  .newsletter {
    margin-top: 1px;

    label {
      display: block;
      width: 100%;
      font-size: $fontSize-xsmall;
      text-transform: uppercase;
      padding: $scale $scale-2-1;
      color: white;
      text-align: center;
      background: $color-gold;
      letter-spacing: 0.8px;
    }

    input { border-radius: 0; }

    input[type="email"] {
      display: block;
      width: 70%;
      font-size: $fontSize-small;
      font-weight: bold;
      line-height: 1.3;
      padding: $scale $scale-4-1;
      padding-right: $scale-1-2;
      display: inline-block;
      float: left;
      background-color: rgba($color-gold-lighter-2, 0.95);
    }

    input[type="submit"] {
      display: inline-block;
      min-width: 64px;
      width: 30%;
      float: left;
      font-size: $fontSize-xsmall;
      background-color: $color-gold;
      color: $color-gold-darker-2;
      padding: $scale;
      &:hover { color: $color-gold-darker-4; }
    }
  }
</style>
