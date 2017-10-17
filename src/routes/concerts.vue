<template>

  <div class="concertsRoute">

    <background video pause :page="page" :color="videoOverlayColor" />

    <grid-block noPadding>
      <div class="span-12">
        <tabs-panel
          title="Vælg turné"
          :domRefs="this.$refs"
          :tabs="toursMeta" />
      </div>
    </grid-block>

    <grid-block noPadding>
      <div class="span-12 position-relative">
        <div class="tours">
          <tour
            v-for="tour in tours"
            :key="tour.meta.title"
            v-bind:ref="tour.meta.title"
            :title="tour.meta.title"
            :concerts="tour.concerts" />
        </div>
      </div>
    </grid-block>

  </div>

</template>

<script>
  import GridBlock from '@/components/GridBlock'
  import Background from '@/components/Background'
  import TabsPanel from '@/components/TabsPanel'
  import Tour from '@/components/Tour'
  import { routeColors } from '@/utils/colorVars'
  import { tours } from '@/data/tours'
  export default {
    name: 'ConcertsRoute',
    components: {
      'grid-block': GridBlock,
      'background': Background,
      'tabs-panel': TabsPanel,
      'tour': Tour
    },
    data() {
      return {
        page: null,
        videoOverlayColor: routeColors.koncerter.bg,
        tours: tours
      }
    },
    computed: {
      toursMeta() {
        let toursMeta = []
        this.tours.forEach( (tour) => { toursMeta.push(tour.meta) })
        return toursMeta
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
  @import '~@/styles/breakpoints';
  .concertsRoute { color: white; }
  .tours {
    position: absolute;
    top: 0;
    padding: 0 ($scale-2-1 - 2px);
    width: 100%;
    left: 2px;
    overflow-y: scroll;
    height: calc( 100vh - #{$routePaddingTop} - 118px - 16px ); // 118 = tabsPanel height

    @include breakpoint( 'tablet' ) { height: calc( 100vh - #{$routePaddingTopTablet} - 118px - 16px ); }
    @include breakpoint( 'mobile' ) { height: calc( 100vh - #{$routePaddingTopMobile} - 119px - 16px ); }

    &::-webkit-scrollbar { width: 4px; }
    &::-webkit-scrollbar-track { background-color: $color-lightred; }
    &::-webkit-scrollbar-thumb { background-color: $color-lightred-darker-2; }
  }
</style>
