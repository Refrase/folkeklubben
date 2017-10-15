<template>
  <transition :name="transitionName">
    <div
      class="menu"
      :class="{ 'menu-frontpage': routeName == 'start' }"
      :key="routeName">
      <div class="top">
        <router-link :to="{ name: 'start' }" exact class="logo">Folkeklubben</router-link>
        <ul class="nav" v-if="routeName != 'start'">
          <li><router-link :to="{ name: 'nyheder' }">Nyheder</router-link></li>
          <li><a>Koncerter</a></li>
          <li><a>Musik</a></li>
          <li><a>Merch</a></li>
          <li><a>Om</a></li>
          <li><a>Kontakt</a></li>
        </ul>
      </div>
      <form class="newsletter" action="index.html" method="post">
        <input type="email" name="email" id="email" placeholder="Meld dig til nyhedsbrevet her..." />
        <input type="submit" value="Tilmeld" />
      </form>
    </div>
  </transition>
</template>

<script>
  export default {
    name: 'Menu',
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

  .menu {
    width: 381px;
    position: fixed;
    transform: translate3d(0,0,0);

    @include breakpoint( 'tablet' ) {
      width: 274px;
      top: 0;
    }

    @include breakpoint( 'mobile' ) {
      left: 50%;
      transform: translate3d(-50%, -200px, 0);
    }

    &-frontpage {
      left: 50%;
      transform: translate3d(-50%, 0, 0);
    }
  }

  .slideToSide-enter { transform: translate3d(-50%, 0, 0); }
  .slideToSide-enter-active { transition: all .6s ease-out; }
  .slideToSide-enter-to { transform: translate3d(0, 0, 0); }

  .slideToCenter-enter { transform: translate3d(0, 0, 0); }
  .slideToCenter-enter-active { transition: all .6s ease-out; }
  .slideToCenter-enter-to { transform: translate3d(-50%, 0, 0); }

  .top {
    background-color: $color-gold;
    padding: $scale-2-1 $scale-3-1;
  }

  .logo {
    display: block;
    font-family: $fontFamily-sansCondensed;
    text-transform: uppercase;
    width: 100%;
    text-align: center;
    line-height: 0.8;
    font-size: 61px;
    margin-bottom: $scale-1-2;
    margin-left: -2px;
    color: $color-darkblue;
    @include breakpoint( 'tablet' ) { font-size: 41.3px; }
  }

  .nav {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    list-style: none;
    white-space: nowrap;
    margin-top: $scale-1-2;

    opacity: 0;
    animation: fadeIn .6s .2s ease-out forwards;

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

    input[type="email"] {
      width: 68%;
      font-size: $fontSize-xsmall;
      padding: $scale $scale-3-1;
      padding-right: $scale-1-2;
      display: inline-block;
      float: left;
      background-color: rgba($color-gold, 0.8);
    }

    input[type="submit"] {
      min-width: 80px;
      width: 32%;
      float: left;
      display: inline-block;
      background-color: $color-gold;
    }
  }
</style>
