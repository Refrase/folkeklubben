<template>
  <div
    class="gridBlock gridBlock-columns"
    :class="[
      this.columns ? 'gridBlock-columns-' + this.columns : null,
      {'gridBlock-noPadding': noPadding},
      {'gridBlock-noWrap': noWrap}
    ]">
    <slot />
  </div>
</template>

<script>
  export default {
    name: 'GridBlock',
    props: {
      columns: {
        type: String,
        default: '12'
      },
      noPadding: Boolean,
      noWrap: Boolean
    }
  }
</script>

<style lang="scss">
  @import '~@/styles/vars';
  @import '~@/styles/breakpoints';

  .gridBlock {
    width: 1024px;
    display: flex;
    flex-wrap: wrap;
    padding: $scale-2-1;
    margin: 0 auto;

    &-noPadding {
      padding-top: 0;
      padding-bottom: 0;
      @include breakpoint( 'tablet' ) { padding: 0 $scale-2-1 !important; }
    }

    &-noWrap { flex-wrap: nowrap !important; }

    & > * { padding: 0 $scale-2-1; }

    // Content-widths
    @include breakpoint( 'tablet' ) { width: 768px; }
    @include breakpoint( 'mobile' ) { width: 100%; }
    @include breakpoint( 'custom', '1400px', true ) { width: 1320px; }
  }

  // Grid
  $cols: 2 3 4 5 6 8 12;
  $spans: 0 1 2 3 4 5 6 7 8 9 10 11 12;
  @each $col in $cols {
    .gridBlock-columns-#{$col} > * { // Set num. columns with columns="X"
      width: percentage(1/$col);
      @include breakpoint( 'mobile' ) { width: 100% !important; }} // Default to 100% width on tablet and below

    @each $span in $spans {
      .gridBlock-columns-#{$col} > *.span-#{$span} { width: percentage(1/$col * $span); } // Set num. of columns to span for direct children
      .gridBlock-columns-#{$col} > *.offset-#{$span} {
        margin-left: percentage(1/$col * $span); // Set num. of columns to offset
        @include breakpoint( 'mobile' ) { margin-left: 0 !important; }}} // Never offset on mobile
  }
</style>
