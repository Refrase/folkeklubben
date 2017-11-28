<template>
  <div class="merchRoute">
    <background :page="page ? page[0] : null" :color="backgroundColor" />
    <grid-block>
      <div class="span-12">
        <h2>Merch</h2>
      </div>
    </grid-block>
  </div>
</template>

<script>
  import GridBlock from '@/components/GridBlock'
  import Background from '@/components/Background'
  import { routeColors } from '@/utils/colorVars'
  import { fetchData } from '@/utils/fetchData'
  export default {
    name: 'MerchRoute',
    components: {
      'grid-block': GridBlock,
      'background': Background
    },
    mixins: [fetchData],
    data() {
      return {
        page: [],
        backgroundColor: routeColors.merch.bg
      }
    },
    created() { this.fetchData( 'pages?slug=merch' ).then( res => this.page = res ) }
  }
</script>

<style lang="scss" scoped>
  @import '~@/styles/vars';
  .merchRoute { color: white; }
</style>
