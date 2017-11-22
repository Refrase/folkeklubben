<template>
  <div class="tour">
    <div class="header">
      <h2 class="title">{{ tour.title.rendered }}</h2>
      <p v-if="tour.acf.period" class="period">{{ tour.acf.period }}</p>
    </div>
    <ul class="concerts">
      <concert v-for="(concert, index) in concerts" :concert="concert" :key="index" />
    </ul>
  </div>
</template>

<script>
  import Concert from '@/components/Concert'
  export default {
    name: 'Concerts',
    components: { concert: Concert },
    props: {
      tour: Object,
      concerts: Array
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
