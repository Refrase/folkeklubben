<template>
  <transition :name="transitionName">
    <div
      class="menu"
      :class="{ 'menu-frontpage': isVelkommen }"
      :key="routeName">
      <div class="top" :class="{ 'top-frontpage': isVelkommen }">
        <router-link :to="{ name: 'velkommen' }" exact class="logo">Folkeklubben</router-link>
        <icon-burger class="show-mobile" :active="showMobileNav" @click.native="showMobileNav = !showMobileNav" />
        <app-nav :active="showMobileNav" v-on:closeMobileNav="showMobileNav = false" />
      </div>
      <div :class="{ 'newsletterWrap-frontpage': isVelkommen }" id="mc_embed_signup">
        <form class="newsletter validate"
          @submit="runMailchimpSubscriptionFlow"
          action="https://folkeklubben.us6.list-manage.com/subscribe/post?u=f8cc3389c3d2cb830f3cd936d&amp;id=86364cbe93"
          method="post" id="mc-embedded-subscribe-form"
          name="mc-embedded-subscribe-form"
          target="_blank"
          novalidate
          autocomplete="off">
          <input type="email" name="EMAIL" id="mce-EMAIL" placeholder="Få nyhedsbrevet (indtast mail)" />
          <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups -->
          <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_f8cc3389c3d2cb830f3cd936d_86364cbe93" tabindex="-1" value=""></div>
          <!-- end bot signup wall -->
          <input type="submit" value="Tilmeld" name="subscribe" id="mc-embedded-subscribe" />
        </form>
        <div id="mce-responses" class="clear">
          <div class="response" id="mce-error-response" style="display:none" />
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
  import Nav from '@/components/Nav'
  import IconBurger from '@/components/IconBurger'
  import { mailchimpValidate } from '@/utils/mailchimpValidate'
  import { mailchimpConfig } from '@/utils/mailchimpConfig'
  export default {
    name: 'Menu',
    components: {
      'app-nav': Nav,
      'icon-burger': IconBurger
    },
    props: { routeChange: Object },
    mixins: [mailchimpValidate, mailchimpConfig],
    data() {
      return {
        showMobileNav: false
      }
    },
    computed: {
      routeName() { return this.$route.name },
      isVelkommen() { return this.$route.name == 'velkommen' },
      transitionName() {
        this.showMobileNav = false
        if (this.routeChange.from || this.routeChange.to) {
          return this.routeChange.from.path === '/' ? 'slideToSide' : this.routeChange.to.path === '/' ? 'slideToCenter' : null
        }
      }
    },
    methods: {
      runMailchimpSubscriptionFlow() {
        this.mailchimpValidate()
        this.mailchimpConfig()
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
      width: 383px;
      transform: translate3d(-108px, 0, 0);
      top: 0;
    }

    @include breakpoint( 'mobile' ) {
      left: 50%;
      transform: translate3d(-50%, 0, 0);
      width: calc( 100% - 28px );
    }

    @include breakpoint( 'custom', '1400px', true ) { width: 397px; transform: translate3d(108px, 0, 0); }

    &-frontpage {
      left: 50%;
      transform: translate3d(-50%, 0, 0);

      @include breakpoint( 'tablet' ) {
        left: 50%;
        transform: translate3d(-50%, 0, 0);
        width: 100%;
      }
    }
  }

  .slideToSide-enter { transform: translate3d(-50%, 0, 0); }
  .slideToSide-enter-active { transition: all .6s ease-out; }
  .slideToSide-enter-to {
    transform: translate3d(0, 0, 0);
    @include breakpoint( 'tablet' ) { transform: translate3d(-108px, 0, 0); }
    @include breakpoint( 'mobile' ) { transform: translate3d(-50%, 0, 0); }
    @include breakpoint( 'custom', '1400px', true ) { transform: translate3d(108px, 0, 0); }
  }

  .slideToCenter-enter {
    transform: translate3d(0, 0, 0);
    @include breakpoint( 'tablet' ) { transform: translate3d(-216px, 0, 0); }
    @include breakpoint( 'mobile' ) { transform: translate3d(-50%, 0, 0); }
  }
  .slideToCenter-enter-active { transition: all .6s ease-out; }
  .slideToCenter-enter-to { transform: translate3d(-50%, 0, 0); }

  .top {
    background-color: $color-gold;
    padding: $scale-2-1 $scale-4-1;

    &-frontpage {
      background-color: transparent;
      border: 16px solid $color-gold;
      border-width: 16px 15px;

      @include breakpoint( 'tablet' ) {
        border-bottom: 0;
        border-left: 0;
        border-right: 0;
      }

      .logo {
        color: white;
        text-shadow: 0px 0px 30px rgba(0,0,0,0.5);
        font-size: 55px !important;
        @include breakpoint( 'custom', '1400px' ) { font-size: 53px !important; }
        @include breakpoint( 'tablet' ) { font-size: 42px !important; }
        @include breakpoint( 'custom', '360px' ) { font-size: 32px !important; }
        &:hover { color: white; }
      }
    }
  }

  .logo {
    display: block;
    font-family: $fontFamily-sansCondensed;
    text-transform: uppercase;
    width: 100%;
    text-align: center;
    line-height: 0.8;
    font-size: 57.7px !important;
    margin-bottom: $scale;
    margin-left: -1px;
    color: $color-welcome;
    letter-spacing: 0;
    transition: color .2s ease-out;

    @include breakpoint( 'mobile' ) {
      font-size: 39px !important;
      text-align: left;
      margin-bottom: 0;
    }

    @include breakpoint( 'custom', '360px' ) { font-size: 32px !important; }

    &:hover { color: $color-darkblue; }
  }

  .newsletterWrap-frontpage {
    opacity: 0;
    animation: fadeIn .3s 3s ease-out forwards;
    @include breakpoint( 'tablet' ) {
      width: calc(100% - 60px); // App borders
      margin-top: $scale-4-1;
      margin-left: 30px;
      display: block;
    }
    @include breakpoint( 'mobile' ) { margin-top: 0; }
  }

  .newsletter {
    display: flex;

    @include breakpoint( 'tablet' ) { margin-top: 0px; }

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
      flex-basis: 100%;
      flex-grow: 1;
      font-size: $fontSize-small;
      font-weight: bold;
      line-height: 1.3;
      padding: $scale $scale-2-1;
      padding-right: $scale-1-2;
      display: inline-block;
      float: left;
      background-color: rgba($color-gold-lighter-2, 0.95);
      border-bottom-left-radius: $borderRadius;
    }

    input[type="submit"] {
      display: inline-block;
      min-width: 80px;
      float: left;
      font-size: 11px;
      background-color: $color-gold;
      color: $color-gold-darker-2;
      padding: $scale $scale-1-2;
      padding-top: $scale;
      padding-bottom: $scale + 2px;
      border-bottom-right-radius: $borderRadius;
      &:hover { color: $color-gold-darker-4; }
    }
  }
</style>
