<template>

  <div class="concertsRoute">

    <background video pause :page="page ? page[0] : null" :color="videoOverlayColor" />

    <grid-block noPadding v-if="tours">
      <div class="span-12">
        <tabs-panel
          v-if="tours"
          title="Vælg turné"
          :domRefs="this.$refs"
          :tabs="toursNotDone" />
      </div>
    </grid-block>

    <grid-block noPadding>
      <div class="span-12" v-if="!tours">
        <spinner />
      </div>
      <div class="span-12 position-relative" v-else>
        <div class="tours">
          <tour
            v-for="(tour, index) in tours"
            v-if="!tour.acf.done"
            :key="index"
            v-bind:ref="tour.title.rendered"
            :tour="tour"
            :concerts="tour.acf.concerts" />
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
  import Spinner from '@/components/Spinner'
  import { fetchData } from '@/utils/fetchData'
  import { decideRouteBackgroundColor } from '@/utils/decideRouteBackgroundColor'
  export default {
    name: 'ConcertsRoute',
    components: {
      'grid-block': GridBlock,
      'background': Background,
      'tabs-panel': TabsPanel,
      'tour': Tour,
      'spinner': Spinner
    },
    mixins: [fetchData, decideRouteBackgroundColor],
    data() {
      return {
        page: [],
        tours: null
      }
    },
    computed: {
      videoOverlayColor() { return this.decideRouteBackgroundColor( 'Concerts page', 'koncerter' ) },
      toursNotDone() {
        let toursNotDone = []
        for ( let tour of this.tours ) {
          if ( !tour.acf.done ) toursNotDone.push(tour)
        }
        return toursNotDone
      }
    },
    created() {
      this.fetchData( 'pages?slug=koncerter' ).then( res => this.page = res )
      this.fetchData( 'tours' ).then( res => this.tours = res )
    }
  }
</script>

<style lang="scss" scoped>
  @import '~@/styles/vars';
  @import '~@/styles/breakpoints';
  @import '~@/styles/helpers';
  .concertsRoute { color: white; }
  .tours {
    position: absolute;
    top: 0;
    padding: 0 ($scale-2-1 - 2px);
    width: 100%;
    left: 2px;
    overflow-y: scroll;
    height: calc( 100vh - #{$routePaddingTop} - 104px - 16px ); // 104 = tabsPanel height

    @extend .fadeIn;

    @include breakpoint( 'tablet' ) { height: calc( 100vh - #{$routePaddingTopTablet} - 104px - 16px ); }
    @include breakpoint( 'mobile' ) { height: calc( 100vh - #{$routePaddingTopMobile} - 104px - 16px ); }

    &::-webkit-scrollbar { width: 4px; }
    &::-webkit-scrollbar-track { background-color: rgba(black, 0.1); }
    &::-webkit-scrollbar-thumb { background-color: rgba(black, 0.2); }
  }
</style>
