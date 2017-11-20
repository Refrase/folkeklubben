<template>
  <div class="bike">
    <img :src="frame" width="200" class="frame" />
    <img :src="wheelBack" class="wheelBack" />
    <img :src="wheelFront" width="200" class="wheelFront" />
  </div>
</template>

<script>
  import frame from '@/assets/images/stel.png'
  import frameWhite from '@/assets/images/stel-hvidt.png'
  import wheelFront from '@/assets/images/forhjul.png'
  import wheelFrontWhite from '@/assets/images/forhjul-hvidt.png'
  import wheelBack from '@/assets/images/baghjul.png'
  import wheelBackWhite from '@/assets/images/baghjul-hvidt.png'
  export default {
    name: 'Spinner',
    props: { dark: Boolean },
    data() {
      return {
        frame: this.dark ? frame : frameWhite,
        wheelFront: this.dark ? wheelFront : wheelFrontWhite,
        wheelBack: this.dark ? wheelBack : wheelBackWhite,
      }
    }
  }
</script>

<style lang="scss" scoped>
  @import '~@/styles/vars';
  @import '~@/styles/animations';
  @keyframes bikePassBy {
    from { transform: rotate3d(0,1,0,-180deg) translateX(200px); }
    to   { transform: rotate3d(0,1,0,-180deg) translateX(calc(-100vw - 200px)); }
  }
  .bike {
    display: block;
    position: fixed;
    width: 200px;
    bottom: 5px;
    left: 0;
    opacity: 1;
    animation: bikePassBy 3s linear infinite;
    z-index: 99;
  }
  .frame {
    position: absolute;
    bottom: 0;
  }
  .wheelFront {
    position: absolute;
    bottom: 9px;
    left: 8px;
    width: 55px;
    height: 55px;
    animation: rotate 0.3s linear infinite reverse;
  }
  .wheelBack {
    position: absolute;
    bottom: 9px;
    right: 0px;
    width: 68px;
    height: 68px;
    animation: rotate 0.3s linear infinite reverse;
  }
</style>
