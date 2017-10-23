<template>
  <div class="release">
    <img
      v-if="release._embedded && release._embedded['wp:featuredmedia'][0]"
      :src="release._embedded['wp:featuredmedia'][0].source_url"
      :alt="release.title.rendered"
      width="100%"
      ref="releasecover"
      data-tilt
      data-tilt-max="15"
      data-tilt-speed="1000">
    <img v-else src="../assets/images/album-placeholder.png" :alt="release.title.rendered" width="100%">
    <p class="releaseDate">Udgivet {{ release.acf.release_date }}</p>
    <div class="links">
      <a v-if="release.acf && release.acf.listen_link" :href="release.acf.listen_link" class="button"><span>Lyt</span></a>
      <a v-if="release.acf && release.acf.buy_cd_link" :href="release.acf.buy_cd_link" class="button"><span>Køb CD</span></a>
      <a v-if="release.acf && release.acf.buy_lp_link" :href="release.acf.buy_lp_link" class="button"><span>Køb LP</span></a>
    </div>
    <ul v-if="tracklist" class="tracklist">
      <li v-for="(track, index) in tracklist">
        <p>{{ track.title.rendered }}</p>
        <p class="showLyrics" @click="showLyrics($event, `${track.slug}-lyrics`)">Tekst</p>
        <p v-if="track.acf.lyrics" class="lyrics" :ref="`${track.slug}-lyrics`" v-html="track.acf.lyrics" />
      </li>
    </ul>
  </div>
</template>

<script>
  import vanillaTilt from 'vanilla-tilt'
  export default {
    name: 'Release',
    props: {
      release: Object,
      tracklist: Array
    },
    mounted() { if (this.$refs['releasecover']) vanillaTilt.init(this.$refs['releasecover']) },
    methods: {
      showLyrics(e, trackRef) {
        e.target.innerText = e.target.innerText === 'Tekst' ? 'Skjul' : 'Tekst'
        this.$refs[trackRef][0].classList.toggle( 'display-block' )
      }
    }
  }
</script>

<style lang="scss" scoped>
  @import '~@/styles/vars';
  @import '~@/styles/breakpoints';
  @import '~@/styles/helpers';
  @import '~@/styles/global';

  .release { margin-bottom: $scale-4-1; }

  img { display: block; }

  .releaseDate {
    margin-top: $scale-2-1;
    width: 100%;
    text-align: center;
    font-family: $fontFamily-sans;
    font-size: $fontSize-xsmall;
    padding: $scale 0;
    padding-top: $scale - 2px;
    color: $color-blue-lighter-3;
    border: 1px solid $color-blue-lighter-1;
  }

  .links {
    display: flex;
    margin-top: $scale-2-1;
  }

  .button {
    display: flex;
    align-items: center;
    flex-basis: 100%;
    padding: $scale $scale-2-1;
    padding-bottom: $scale + 2px;
    margin-right: $scale-2-1;
    white-space: normal;

    &:last-child { margin-right: 0; }

    span {
      width: 100%;
      text-align: center;
    }
  }

  .tracklist {
    list-style: none;
    margin-top: $scale-2-1;

    li {
      padding: $scale $scale-2-1 ($scale - 3px);
      font-size: $fontSize-small;
      font-weight: bold;

      &:nth-child(odd) { background-color: rgba(white, 0.05); }

      p { display: inline-block; }
    }

    .showLyrics {
      @extend .a;
      position: relative;
      float: right;
      font-size: $fontSize-base;
      bottom: -2px;
    }

    .lyrics {
      margin: $scale 0;
      padding-top: $scale;
      padding-right: $scale;
      border-top: 1px solid $color-blue-lighter-2;
      font-weight: normal;
      display: none;
    }
  }

</style>
