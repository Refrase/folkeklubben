<template>
  <div class="concerts">
    <background video :page="page" :color="videoOverlayColor" />
    <grid-block>
      <div class="span-12">
        <h2 class="label">Vælg turné</h2>
      </div>
    </grid-block>
  </div>
</template>

<script>
  import GridBlock from '@/components/GridBlock'
  import Background from '@/components/Background'
  import { routeColors } from '@/utils/colorVars'
  export default {
    name: 'ConcertsRoute',
    components: {
      'grid-block': GridBlock,
      'background': Background
    },
    data() {
      return {
        page: null,
        videoOverlayColor: routeColors.koncerter.bg
      }
    },
    created() {
      this.getPage()
    },
    methods: {
      getPage() {
        this.$http.get(wp.rest_root + '/wp/v2/pages?slug=koncerter').then( (response) => {
          this.page = response.data
        }, (error) => {
          this.page = null
          console.log('Could not load page');
        });
      }
    }
  }
</script>

<style lang="scss" scoped>
  @import '~@/styles/vars';

  .concerts * { color: white; }

  .label {
    color: $color-lightred-darker-2;
    text-transform: uppercase;
  }
</style>