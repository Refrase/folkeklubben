<template>
  <div class="musicRoute">
    <background :page="page ? page[0] : null" :color="backgroundColor" />
    <grid-block>
      <div class="span-12" v-if="loadingReleases">
        <h2>Udgivelser hentes...</h2>
      </div>
      <div v-for="(release, index) in releasesReversed" class="span-4">
        <release :release="release" :tracklist="tracksByRelease[release.slug]" :key="index" />
      </div>
    </grid-block>
  </div>
</template>

<script>
  import GridBlock from '@/components/GridBlock'
  import Background from '@/components/Background'
  import Release from '@/components/Release'
  import { routeColors } from '@/utils/colorVars'
  import { fetchData } from '@/utils/fetchData'
  export default {
    name: 'MusicRoute',
    components: {
      'grid-block': GridBlock,
      'background': Background,
      'release': Release
    },
    mixins: [fetchData],
    data() {
      return {
        backgroundColor: routeColors.musik.bg,
        page: [],
        loadingReleases: true,
        releases: [],
        tracks: []
      }
    },
    computed: {
      releasesReversed() { if (this.releases) return this.releases.reverse() },
      tracksByRelease() {
        const tracksByRelease = {}
        const releaseSlugs = []
        for ( let release of this.releases ) releaseSlugs.push(release.slug)
        for ( let slug of releaseSlugs ) {
          tracksByRelease[slug] = []
          for ( let track of this.tracks ) {
            if ( track.acf.release === slug ) tracksByRelease[slug].push(track)
          }
          tracksByRelease[slug].sort( (a, b) => { return parseInt(a.acf.tracklist_number, 10) - parseInt(b.acf.tracklist_number, 10) }) // Sort albumtracks by tracklist num
        }
        return tracksByRelease
      }
    },
    created() {
      this.fetchData( 'pages?slug=musik' ).then( res => this.page = res )
      this.fetchData( 'releases?_embed' ).then( res => {
        this.loadingReleases = false
        this.releases = res
      })
      this.fetchData( 'tracks' ).then( res => this.tracks = res )
    }
  }
</script>

<style lang="scss" scoped>
  .musicRoute { color: white; }
</style>
