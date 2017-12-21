<template>
  <div class="burger" :class="{ 'burger-active': active, 'burger-frontPage': isVelkommen }">
    <span />
    <span />
    <span />
  </div>
</template>

<script>
  export default {
    name: 'IconBurger',
    props: { active: Boolean },
    computed: {
      isVelkommen() { return this.$route.name == 'velkommen' }
    }
  }
</script>

<style lang="scss" scoped>
  @import '~@/styles/vars';
  @import '~@/styles/breakpoints';

  .burger {
    cursor: pointer;
    position: fixed;
    height: 22px;
    width: 28px;
    right: $scale-4-1;
    top: 23px;
    @include breakpoint( 'custom', '360px' ) { top: 20px !important; }
    z-index: 2000;

    &-frontPage {
      right: $scale-4-1;
      top: $scale-5-1;
      @include breakpoint( 'custom', '360px' ) { top: 35px !important; }
      & span { background-color: white !important; }
    }

    & span {
      display: block;
      position: absolute;
      height: 3px;
      width: 28px;
      background-color: $color-gold-darker-2;
      opacity: 1;
      left: 0;
      transform: rotate(0deg);
      transition: .25s ease-in-out;

      &:nth-child(1) {
        top: 0px;
        transform-origin: left center;
      }

      &:nth-child(2) {
        top: 9px;
        transform-origin: left center;
      }

      &:nth-child(3) {
        top: 18px;
        transform-origin: left center;
      }
    }

    &:active,
    &-active {

      & span {

        &:nth-child(1) {
          transform: rotate(45deg);
          top: -1px;
          left: 4px;
        }

        &:nth-child(2) {
          width: 0%;
          opacity: 0;
        }

        &:nth-child(3) {
          transform: rotate(-45deg);
          top: 19px;
          left: 4px;
        }

      }
    }
  }

</style>
