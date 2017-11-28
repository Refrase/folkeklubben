<template>
  <li class="concert">
    <div class="left">
      <p v-if="prettyDate" class="date">{{ prettyDate }}</p>
      <div class="place">
        <p class="venue">{{ concert.venue }}</p>
        <p class="city">{{ concert.city }}<span v-if="concert.country">, {{ concert.country }}</span></p>
        <p v-if="concert.stage" class="stage">{{ concert.stage }}</p>
      </div>
    </div>
    <div class="right">
      <a v-if="concert.facebook_event_link" :href="concert.facebook_event_link" class="facebookEvent button">Facebook event</a>
      <a :href="concert.ticket_link && !concert.cancelled ? concert.ticket_link : '#'"
        target="_blank"
        class="buy button"
        :class="buyButtonClass"
        :style="{ backgroundColor: concert.status === 'few_tickets' || concert.status === 'waiting_list' ? buttonAttentionColor : null }">
        <span v-if="concert.status === 'free'">Gratis entré</span>
        <span v-else-if="concert.status === 'sold_out'">Udsolgt</span>
        <span v-else-if="concert.status === 'cancelled'">Aflyst</span>
        <span v-else-if="concert.status === 'few_tickets'">Få billetter</span>
        <span v-else-if="concert.status === 'waiting_list'">Venteliste</span>
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
      buttonAttentionColor() {
        const colorObj = wp.colors ? wp.colors.find( x => x.name === 'Concerts button attention' ) : null
        if ( colorObj && colorObj.color ) return colorObj.color
        else return '#ffe059'
      },
      prettyDate() { return this.getPrettyDate(this.concert.date, 'shorter', true) },
      buyButtonClass() {
        return {
          free: this.concert.status === 'free',
          soldOut: this.concert.status === 'sold_out',
          cancelled: this.concert.status === 'cancelled',
          fewTickets: this.concert.status === 'few_tickets',
          waitingList: this.concert.status === 'waiting_list'
        }
      }
    }
  }
</script>

<style lang="scss" scoped>
  @import '~@/styles/vars';
  @import '~@/styles/breakpoints';
  @import '~@/styles/helpers';
  @import '~@/styles/global';

  .concert {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: $scale-3-1;

    &:nth-child(even) { background-color: rgba(black, 0.1); }
    &:nth-child(odd) {
      & .facebookEvent {
        background-color: rgba(black, 0.25) !important;
        &:hover { background-color: rgba(black, 0.15) !important; }
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
        top: -4px;
        color: rgba(black, 0.6);
        margin-right: $scale-3-1;
        display: inline-block;
        letter-spacing: 0.5px;

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
        letter-spacing: 0.5px;

        @include breakpoint( 'mobile' ) { text-align: center; }
      }

      .city,
      .stage {
        color: white;
        font-size: $fontSize-small;
        margin-top: 4px;
        font-weight: bold;
        line-height: 14px;
        display: inline-block;
        @include breakpoint( 'mobile' ) { width: 100%; text-align: center; }
      }

      .stage {
        color: rgba(black, 0.6);
        font-family: $fontFamily-sans;
        font-size: $fontSize-xsmall;
        text-transform: uppercase;
        margin-left: $scale;
        letter-spacing: 0.5px;

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
        color: rgba(black, 0.9);
        background-color: rgba(black, 0.2);
        font-weight: bold;
        display: inline-block;
        margin-right: $scale;
        padding-left: $scale-2-1 !important;
        padding-right: $scale-2-1 !important;

        &:hover { background-color: rgba(black, 0.1); }

        @include breakpoint( 'tablet' ) { margin-right: 0; margin-top: $scale; order: 2; }
      }

      .buy {
        background-color: white;
        position: relative;
        top: -1px;
        display: inline-block;
        padding-left: $scale-2-1 !important;
        padding-right: $scale-2-1 !important;
        min-width: 154px;
        &:hover { background-color: rgba(white, 0.8); }
        @include breakpoint( 'tablet' ) { order: 1; }
      }

      .soldOut,
      .cancelled {
        color: rgba(black, 0.6);
        background-color: rgba(black, 0.15);
        &:hover { background-color: rgba(black, 0.1); }
      }

      .fewTickets,
      .waitingList {
        &:hover { opacity: 0.9 }
      }

    }
  }

</style>
