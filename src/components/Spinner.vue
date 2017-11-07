<template>
  <div class="bike">
    <img src="../assets/images/stel.png" width="200" class="frame" />
    <img src="../assets/images/baghjul.png" class="wheelBack" />
    <img src="../assets/images/forhjul.png" width="200" class="wheelFront" />
  </div>
</template>

<script>
  export default { name: 'Spinner' }
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
    opacity: 0.3;
    animation: bikePassBy 3s linear infinite;
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
