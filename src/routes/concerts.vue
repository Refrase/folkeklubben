<template>

  <div class="concertsRoute">

    <background video pause :page="page ? page[0] : null" :color="videoOverlayColor" />

    <grid-block noPadding v-if="tours && !loadingConcerts">
      <div class="span-12">
        <tabs-panel
          v-if="tours"
          title="Vælg turné"
          :domRefs="this.$refs"
          :tabs="toursNotDone" />
      </div>
    </grid-block>

    <grid-block noPadding>
      <div class="span-12" v-if="loadingConcerts">
        <spinner />
      </div>
      <div class="span-12 position-relative" v-if="tours && !loadingConcerts">
        <div class="tours">
          <tour
            v-for="(tour, index) in tours"
            v-if="!tour.acf.done"
            :key="index"
            v-bind:ref="tour.title.rendered"
            :tour="tour"
            :concerts="concertsByTour[tour.slug]" />
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
  import { routeColors } from '@/utils/colorVars'
  import { fetchData } from '@/utils/fetchData'
  export default {
    name: 'ConcertsRoute',
    components: {
      'grid-block': GridBlock,
      'background': Background,
      'tabs-panel': TabsPanel,
      'tour': Tour,
      'spinner': Spinner
    },
    mixins: [fetchData],
    data() {
      return {
        videoOverlayColor: routeColors.koncerter.bg,
        page: [],
        tours: null,
        loadingConcerts: true,
        concerts: []
      }
    },
    computed: {
      toursNotDone() {
        let toursNotDone = []
        for ( let tour of this.tours ) {
          if ( !tour.acf.done ) toursNotDone.push(tour)
        }
        return toursNotDone
      },
      concertsByTour() {
        const concertsByTour = {}
        const tourSlugs = []
        for ( let tour of this.tours ) tourSlugs.push(tour.slug)
        for ( let slug of tourSlugs ) {
          concertsByTour[slug] = []
          for ( let concert of this.concerts ) {
            if ( concert.acf.tour === slug ) concertsByTour[slug].push(concert)
          }
          concertsByTour[slug].sort( (a, b) => { return parseInt(a.acf.concert_date, 10) - parseInt(b.acf.concert_date, 10) }) // Sort concerts by date
        }
        return concertsByTour
      }
    },
    created() {
      this.fetchData( 'pages?slug=koncerter' ).then( res => this.page = res )
      this.fetchData( 'tours' ).then( res => this.tours = res )
      this.fetchData( 'concerts' ).then( res => {
        this.loadingConcerts = false
        this.concerts = res
      })
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
    height: calc( 100vh - #{$routePaddingTop} - 96px - 16px ); // 118 = tabsPanel height

    @extend .fadeIn;

    @include breakpoint( 'tablet' ) { height: calc( 100vh - #{$routePaddingTopTablet} - 96px - 16px ); }
    @include breakpoint( 'mobile' ) { height: calc( 100vh - #{$routePaddingTopMobile} - 97px - 16px ); }

    &::-webkit-scrollbar { width: 4px; }
    &::-webkit-scrollbar-track { background-color: $color-lightred; }
    &::-webkit-scrollbar-thumb { background-color: $color-lightred-darker-2; }
  }
</style>
