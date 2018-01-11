<template>
  <div class="tour" v-if="upcomingConcerts.length">
    <div class="header">
      <h2 class="title">{{ tour.title.rendered }}</h2>
      <p v-if="tour.acf.period" class="period">{{ tour.acf.period }}</p>
    </div>
    <ul class="concerts">
      <concert v-for="(concert, index) in upcomingConcerts" :concert="concert" :key="index" />
    </ul>
  </div>
</template>

<script>
  import Concert from '@/components/Concert'
  import { today8Digits } from '@/utils/today'
  export default {
    name: 'Concerts',
    components: { concert: Concert },
    mixins: [today8Digits],
    props: {
      tour: Object,
      concerts: Array
    },
    computed: {
      upcomingConcerts() {
        let upcomingConcerts = []
        for ( let concert of this.concerts ) {
          if ( concert.date >= this.today8Digits() ) upcomingConcerts.push(concert)
        }
        return upcomingConcerts
      }
    }
  }
</script>

<style lang="scss" scoped>
  @import '~@/styles/vars';
  @import '~@/styles/breakpoints';

  .tour:not(:first-child) { margin-top: $scale-4-1; }

  .header {
    background-color: rgba(black, 0.3);
    padding: $scale-3-1;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .title {
    text-transform: uppercase;
    text-align: center;
    font-family: $fontFamily-sansCondensed;
    font-size: $fontSize-xxxlarge;
    margin-bottom: 1px;
    margin-bottom: $scale;
  }

  .period {
    color: rgba(black, 0.6);
    font-weight: bold;
  }

  .concerts { list-style: none; }

</style>
