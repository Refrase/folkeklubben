<template>

  <div class="concertsRoute">

    <background video pause :page="page ? page[0] : null" :color="videoOverlayColor" />

    <grid-block noPadding v-if="tours && !toursNotDoneByStartdate.length">
      <div class="span-12 margin-top-2-1 textAlign-center">
        <p :style="{ fontSize: '20px' }">Der er desværre ingen koncerter i kalenderen...</p>
      </div>
    </grid-block>

    <grid-block noPadding v-if="tours && toursNotDoneByStartdate.length > 1">
      <div class="span-12">
        <tabs-panel
          title="Vælg turné"
          :domRefs="this.$refs"
          :tabs="toursNotDoneByStartdate" />
      </div>
    </grid-block>

    <grid-block noPadding>
      <div class="span-12" v-if="loadingTours">
        <spinner />
      </div>
      <div class="span-12 position-relative" v-else>
        <div class="tours" :class="{ 'tours-noTabs': toursNotDoneByStartdate.length < 2 }">
          <tour
            v-for="(tour, index) in toursNotDoneByStartdate"
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
  import { today8Digits } from '@/utils/today'
  export default {
    name: 'ConcertsRoute',
    components: {
      'grid-block': GridBlock,
      'background': Background,
      'tabs-panel': TabsPanel,
      'tour': Tour,
      'spinner': Spinner
    },
    mixins: [fetchData, decideRouteBackgroundColor, today8Digits],
    data() {
      return {
        page: [],
        loadingTours: true,
        tours: null
      }
    },
    computed: {
      videoOverlayColor() { return this.decideRouteBackgroundColor( 'Concerts page', 'koncerter' ) },
      toursNotDoneByStartdate() {
        let toursNotDone = []
        for ( let tour of this.tours ) {
          if ( tour.acf.done ) continue // To check if it is marked as done on wp-admin
          if ( this.tourHasUpcomingConcerts(tour.acf.concerts) ) toursNotDone.push(tour)
        }
        const toursNotDoneByStartdate = toursNotDone.sort( (a, b) => { return parseInt(a.acf.start_date, 10) - parseInt(b.acf.start_date, 10) })
        return toursNotDoneByStartdate
      }
    },
    created() {
      this.fetchData( 'pages?slug=koncerter' ).then( res => this.page = res )
      this.fetchData( 'tours' ).then( res => {
        this.loadingTours = false
        this.tours = res
      })
    },
    methods: {
      tourHasUpcomingConcerts(concerts) {
        for ( let concert of concerts ) if ( concert.date >= this.today8Digits() ) return true
        return false
      }
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
    -webkit-overflow-scrolling: touch;
    @extend .fadeIn;

    height: calc( 100vh - #{$routePaddingTop} - 104px - 24px ); // 104 = tabsPanel height
    @include breakpoint( 'tablet' ) { height: calc( 100vh - #{$routePaddingTopTablet} - 104px - 24px ); }
    @include breakpoint( 'mobile' ) { height: calc( 100vh - #{$routePaddingTopMobile} - 104px - 24px ); }

    &-noTabs {
      margin-top: $scale-2-1;
      height: calc( 100vh - #{$routePaddingTop} - 32px );
      @include breakpoint( 'tablet' ) { height: calc( 100vh - #{$routePaddingTopTablet} - 32px ); }
      @include breakpoint( 'mobile' ) { height: calc( 100vh - #{$routePaddingTopMobile} - 32px ); }
    }

    &::-webkit-scrollbar { width: 4px; }
    &::-webkit-scrollbar-track { background-color: rgba(black, 0.1); }
    &::-webkit-scrollbar-thumb { background-color: rgba(black, 0.2); }
  }
</style>
