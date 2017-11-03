<template>
  <img src="../assets/images/folkeklubben-bike-darkblue.svg" width="200" class="loadingSpinner" alt="Loading..." />
</template>

<script>
  export default { name: 'Spinner' }
</script>

<style lang="scss" scoped>
  @import '~@/styles/vars';
  @import '~@/styles/animations';
  .loadingSpinner {
    display: block;
    margin: $scale-4-1 auto;
    opacity: 0.2;
    animation: rotate360 2s cubic-bezier(0.1, 0.95, 0.65, 1) infinite;
  }
</style>
