<template>
  <div class="musicRoute">
    <background :page="page ? page[0] : null" :color="backgroundColor" />
    <spinner v-if="!releases" />
    <div v-if="releases" class="fadeIn">
      <grid-block>
        <div v-for="(release, index) in releasesReversed" class="span-4">
          <release :release="release" :tracklist="tracksByRelease[release.slug]" :key="index" />
        </div>
      </grid-block>
      <grid-block>
        <h1 class="span-12 margin-bottom-4-1">Musikvideoer</h1>
        <div v-for="(video, index) in videosByReleasedateReversed" v-if="index < 2" class="span-6">
          <div class="videoWrap margin-bottom-4-1">
            <iframe class="video" :src="video.acf.video_embed_url_youtube" frameborder="0" gesture="media" allowfullscreen></iframe>
          </div>
        </div>
        <div v-else class="span-12 margin-bottom-2-1">
          <a target="_blank" class="button" :href="video.acf.video_embed_url_youtube">{{ video.title.rendered }}</a>
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
  import { fetchData } from '@/utils/fetchData'
  import { decideRouteBackgroundColor } from '@/utils/decideRouteBackgroundColor'
  export default {
    name: 'MusicRoute',
    components: {
      'grid-block': GridBlock,
      'background': Background,
      'release': Release,
      'spinner': Spinner
    },
    mixins: [fetchData, decideRouteBackgroundColor],
    data() {
      return {
        page: [],
        releases: null,
        tracks: [],
        videos: []
      }
    },
    computed: {
      backgroundColor() { return this.decideRouteBackgroundColor( 'Music page', 'musik' ) },
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
      this.fetchData( 'releases?_embed' ).then( res => this.releases = res )
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
