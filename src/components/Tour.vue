<template>
  <div class="tour">
    <h2 class="title">{{ title }}</h2>
    <ul class="concerts">
      <concert v-for="concert in concerts" :concert="concert" :key="concert.venue" />
    </ul>
  </div>
</template>

<script>
  import Concert from '@/components/Concert'
  export default {
    name: 'Concerts',
    components: { concert: Concert },
    props: {
      title: String,
      concerts: Array
    }
  }
</script>

<style lang="scss" scoped>
  @import '~@/styles/vars';
  @import '~@/styles/breakpoints';

  .tour:not(:first-child) { margin-top: $scale-4-1; }

  .title {
    background-color: $color-lightred-darker-2;
    padding: $scale-2-1;
    padding-bottom: $scale-2-1 + 4px;
    text-align: center;
    text-transform: uppercase;
    font-family: $fontFamily-sansCondensed;
    font-size: $fontSize-xxxlarge;
    margin-bottom: 1px;

    @include breakpoint( 'tablet' ) { padding-bottom: $scale-2-1 + 2px; }
  }

  .concerts { list-style: none; }

</style>
