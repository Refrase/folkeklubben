<template>
  <div class="aboutRoute">
    <background :page="page" :color="backgroundColor" />
    <grid-block>
      <div class="span-12">
        <h2>Om</h2>
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
    name: 'AboutRoute',
    components: {
      'grid-block': GridBlock,
      'background': Background
    },
    mixins: [fetchData],
    data() {
      return {
        page: [],
        backgroundColor: routeColors.om.bg
      }
    },
    created() { this.fetchData( 'pages?slug=om' ).then( res => this.page = res ) }
  }
</script>

<style lang="scss" scoped>
  @import '~@/styles/vars';
  .aboutRoute { color: white; }
</style>
