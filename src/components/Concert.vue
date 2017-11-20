<template>
  <li class="concert">
    <div class="left">
      <p v-if="prettyDate" class="date">{{ prettyDate }}</p>
      <div class="place">
        <p class="venue">{{ concert.acf.venue }}</p>
        <p class="city">{{ concert.acf.city }}<span v-if="concert.acf.country">, {{ concert.acf.country }}</span></p>
        <p v-if="concert.acf.stage" class="stage">{{ concert.acf.stage }}</p>
      </div>
    </div>
    <div class="right">
      <a v-if="concert.acf.facebook_event_link" :href="concert.acf.facebook_event_link" class="facebookEvent button">Facebook event</a>
      <a :href="concert.acf.ticket_link && !concert.acf.cancelled ? concert.acf.ticket_link : '#'" target="_blank" class="buy button" :class="buyButtonClass">
        <span v-if="concert.acf.free">Gratis entré</span>
        <span v-else-if="concert.acf.sold_out">Udsolgt</span>
        <span v-else-if="concert.acf.cancelled">Aflyst</span>
        <span v-else-if="concert.acf.few_tickets">Få billetter</span>
        <span v-else-if="concert.acf.waiting_list">Venteliste</span>
        <span v-else>Køb billet</span>
      </a>
    </div>
  </li>
</template>

<script>
  import { getPrettyDate } from '@/utils/date'
  export default {
    name: 'Concert',
    props: { concert: Object },
    mixins: [getPrettyDate],
    computed: {
      prettyDate() { return this.getPrettyDate(this.concert.acf.concert_date, 'shorter', true) },
      buyButtonClass() {
        return {
          free: this.concert.acf.free,
          soldOut: this.concert.acf.sold_out,
          cancelled: this.concert.acf.cancelled,
          fewTickets: this.concert.acf.few_tickets,
          waitingList: this.concert.acf.waiting_list
        }
      }
    }
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
    &:nth-child(odd) {
      & .facebookEvent {
        background-color: rgba($color-lightred-darker-1, 0.5) !important;
        &:hover { background-color: rgba($color-lightred-darker-1, 1) !important; }
      }
    }

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
        color: $color-lightred-darker-3;
        background-color: rgba($color-lightred, 0.5);
        font-weight: bold;
        display: inline-block;
        margin-right: $scale;
        padding-left: $scale-2-1 !important;
        padding-right: $scale-2-1 !important;

        &:hover { background-color: rgba($color-lightred, 1) !important; }

        @include breakpoint( 'tablet' ) { margin-right: 0; margin-top: $scale; order: 2; }
      }

      .buy {
        background-color: $color-blue;
        color: white;
        position: relative;
        top: -1px;
        display: inline-block;
        padding-left: $scale-2-1 !important;
        padding-right: $scale-2-1 !important;
        min-width: 154px;
        &:hover { background-color: $color-blue-darker-1; }
        @include breakpoint( 'tablet' ) { order: 1; }
      }

      .soldOut,
      .cancelled {
        background-color: $color-lightred-darker-2;
        &:hover { background-color: $color-lightred-darker-2 }
      }

      .fewTickets,
      .waitingList {
        background-color: $color-darkblue;
        &:hover { background-color: $color-darkblue-darker-4; }
      }

    }
  }

</style>
