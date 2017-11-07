<template>
  <div class="musicRoute">
    <background :page="page ? page[0] : null" :color="backgroundColor" />
    <spinner v-if="loadingReleases" />
    <div v-if="!loadingReleases">
      <grid-block>
        <div v-for="(release, index) in releasesReversed" class="span-4">
          <release :release="release" :tracklist="tracksByRelease[release.slug]" :key="index" />
        </div>
      </grid-block>
      <grid-block>
        <h1 class="span-12 margin-bottom-4-1">Musikvideoer</h1>
        <div v-for="(video, index) in videosByReleasedateReversed" class="span-6">
          <div class="videoWrap margin-bottom-4-1">
            <iframe class="video" :src="video.acf.video_embed_url_youtube" frameborder="0" gesture="media" allowfullscreen></iframe>
          </div>
        </div>
      </grid-block>
    </div>
  </div>
</template>

<script>
  import GridBlock from '@/components/GridBlock'
  import Background from '@/components/Background'
  import Release from '@/components/Release'
  import Spinner from '@/components/Spinner'
  import { routeColors } from '@/utils/colorVars'
  import { fetchData } from '@/utils/fetchData'
  export default {
    name: 'MusicRoute',
    components: {
      'grid-block': GridBlock,
      'background': Background,
      'release': Release,
      'spinner': Spinner
    },
    mixins: [fetchData],
    data() {
      return {
        backgroundColor: routeColors.musik.bg,
        page: [],
        loadingReleases: true,
        releases: [],
        tracks: [],
        videos: []
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
      },
      videosByReleasedateReversed() {
        let videos = this.videos
        videos.sort( (a, b) => { return parseInt(a.acf.video_release_date, 10) - parseInt(b.acf.video_release_date, 10) })
        return videos.reverse()
      }
    },
    created() {
      this.fetchData( 'pages?slug=musik' ).then( res => this.page = res )
      this.fetchData( 'releases?_embed' ).then( res => {
        this.loadingReleases = false
        this.releases = res
      })
      this.fetchData( 'tracks' ).then( res => this.tracks = res )
      this.fetchData( 'videos?order=asc' ).then( res => this.videos = res )
    }
  }
</script>

<style lang="scss" scoped>
  .musicRoute { color: white; }
  .videoWrap {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 */
    height: 0;
  }
  .video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
  }
</style>
