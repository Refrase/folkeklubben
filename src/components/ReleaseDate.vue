<template>
  <p class="releaseDate">Udgivet {{ prettyDate }}</p>
</template>

<script>
  import { getPrettyDate } from '@/utils/date'
  export default {
    name: 'ReleaseDate',
    mixins: [getPrettyDate],
    props: { date: String },
    computed: { prettyDate() { return this.getPrettyDate(this.date, 'short', true) } }
  }
</script>

<style lang="scss" scoped>
  @import '~@/styles/vars';
  .releaseDate {
    margin-top: $scale-2-1;
    width: 100%;
    text-align: center;
    font-family: $fontFamily-sans;
    font-size: $fontSize-xsmall;
    padding: $scale 0;
    padding-top: $scale - 2px;
    color: rgba(white, 0.5);
    border: 1px solid rgba(white, 0.5);
    letter-spacing: 0.5px;
    border-radius: $borderRadius;
  }
</style>
