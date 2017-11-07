<template>
  <img src="../assets/images/folkeklubben-bike-darkblue.svg" width="200" class="loadingSpinner" alt="Loading..." />
</template>

<script>
  export default { name: 'Spinner' }
</script>

<style lang="scss" scoped>
  @import '~@/styles/vars';
  @keyframes bikePassBy {
    from { transform: rotate3d(0,1,0,180deg) translateX(calc(50vw - 200px)); }
    to   { transform: rotate3d(0,1,0,180deg) translateX(calc(-100vw + 200px)); }
  }
  .loadingSpinner {
    display: block;
    position: fixed;
    bottom: 5px;
    opacity: 0.3;
    transform: rotate3d(0,1,0,360deg);
    animation: bikePassBy 3s linear infinite;
  }
</style>
