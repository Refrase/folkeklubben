<template>
  <li class="concert">
    <div class="left">
      <p class="date">{{ concert.date }}</p>
      <div class="place">
        <p class="venue">{{ concert.venue }}</p>
        <p class="city">{{ concert.city }}</p>
        <p class="stage">{{ concert.stage ? concert.stage : null }}</p>
      </div>
    </div>
    <div class="right">
      <a :href="concert.facebookEventUrl" class="facebookEvent button">Facebook event</a>
      <a :href="concert.ticketUrl" class="buy button">Køb billet</a>
    </div>
  </li>
</template>

<script>
  export default {
    name: 'Concert',
    props: { concert: Object }
  }
</script>

<style lang="scss" scoped>
  @import '~@/styles/vars';
  @import '~@/styles/breakpoints';
  @import '~@/styles/helpers';

  .concert {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: $scale-3-1;

    &:nth-child(even) { background-color: rgba($color-lightred-darker-2, 0.3); }

    @include breakpoint( 'mobile' ) {
      align-items: center;
      flex-direction: column;
      padding: $scale-4-1 $scale-5-1 $scale-5-1;
    }

    .left {
      display: flex;
      align-items: center;

      @include breakpoint( 'tablet' ) {
        align-items: flex-start;
        flex-direction: column;
      }

      @include breakpoint( 'mobile' ) { align-items: center; }

      .date {
        font-size: 48px;
        width: 184px;
        font-family: $fontFamily-sansCondensed;
        text-transform: uppercase;
        line-height: 32px;
        position: relative;
        top: -2px;
        color: $color-lightred-darker-2;
        margin-right: $scale-3-1;
        display: inline-block;

        @include breakpoint( 'tablet' ) {
          width: auto;
          margin-top: -5px;
          margin-bottom: $scale-2-1 + 2px;
          margin-right: 0;
          font-size: 24px;
        }
      }

      .place { display: inline-block; }

      .venue {
        position: relative;
        top: -4px;
        font-family: $fontFamily-sans;
        font-weight: bold;
        text-transform: uppercase;
        line-height: 1.2;

        @include breakpoint( 'mobile' ) { text-align: center; }
      }

      .city,
      .stage {
        color: $color-gold;
        font-size: $fontSize-small;
        margin-top: 4px;
        font-weight: bold;
        letter-spacing: $letterSpacing;
        line-height: 14px;
        display: inline-block;
        @include breakpoint( 'mobile' ) { width: 100%; text-align: center; }
      }

      .stage {
        color: $color-lightred-darker-2;
        font-family: $fontFamily-sans;
        font-size: $fontSize-xsmall;
        text-transform: uppercase;
        margin-left: $scale;
        letter-spacing: 0;

        @include breakpoint( 'mobile' ) { display: block; margin-left: 0; }
      }
    }

    .right {
      display: flex;
      justify-content: flex-end;

      @include breakpoint( 'tablet' ) { flex-direction: column; }
      @include breakpoint( 'mobile' ) { margin-top: $scale-3-1; }

      .facebookEvent {
        position: relative;
        top: -1px;
        color: $color-lightred-darker-2;
        background-color: $color-lightred;
        font-weight: bold;
        display: inline-block;
        margin-right: $scale;

        &:hover {
          color: white;
          background-color: $color-blue;
        }

        @include breakpoint( 'tablet' ) { margin-right: 0; margin-top: $scale; order: 2; }
      }

      .buy {
        position: relative;
        top: -1px;
        display: inline-block;
        @include breakpoint( 'tablet' ) { order: 1; }
      }

    }
  }

</style>
