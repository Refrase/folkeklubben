<template>
  <div class="pageRoute">
    <grid-block>
      <h1>Page</h1>
      <div class="span-4">
        <router-view></router-view>
      </div>
    </grid-block>
  </div>
</template>

<script>
  import GridBlock from '@/components/GridBlock'
  export default {
    name: 'pageRoute',
    components: { 'grid-block': GridBlock }
  }
</script>

<style lang="scss" scoped></style>
