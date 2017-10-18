<template>
  <div class="album">
    <img v-if="album.image && album.image.url" :src="album.image.url" :alt="album.title" width="100%">
    <img v-else src="../assets/images/album-placeholder.png" :alt="album.title" width="100%">
    <p class="releaseDate">Udgivet {{ album.releaseDate }}</p>
    <div class="links">
      <a v-if="album.links && album.links.listen" :href="album.links.listen" class="button"><span>Lyt</span></a>
      <a v-if="album.links && album.links.buy.cd" :href="album.links.buy.cd" class="button"><span>Køb CD</span></a>
      <a v-if="album.links && album.links.buy.lp" :href="album.links.buy.lp" class="button"><span>Køb LP</span></a>
    </div>
    <ul v-if="album.tracklist" class="tracklist">
      <li v-for="(track, index) in album.tracklist">
        <p>{{ track.title }}</p>
        <p class="showLyrics" @click="showLyrics($event, `${track.id}-lyrics`)">Tekst</p>
        <p v-if="track.lyrics" class="lyrics" :ref="`${track.id}-lyrics`" v-html="track.lyrics" />
      </li>
    </ul>
  </div>
</template>

<script>
  export default {
    name: 'Album',
    props: { album: Object },
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

  .album { margin-bottom: $scale-4-1; }

  img { display: block; }

  .releaseDate {
    margin-top: $scale-2-1;
    width: 100%;
    text-align: center;
    font-family: $fontFamily-sans;
    font-size: $fontSize-xsmall;
    padding: $scale 0;
    padding-top: $scale - 2px;
    color: $color-darkblue-lighter-3;
    border: 1px solid $color-darkblue-lighter-1;
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
      border-top: 1px solid $color-darkblue-lighter-2;
      font-weight: normal;
      display: none;
    }
  }

</style>
