<template>
  <div class="musicRoute">
    <background :page="page ? page[0] : null" :color="backgroundColor" />
    <spinner v-if="!releases" />
    <div v-if="releases" class="fadeIn">
      <grid-block>
        <div v-for="(release, index) in releasesByReleasedateReversed" class="span-4">
          <release :release="release" :key="index" />
        </div>
      </grid-block>
      <grid-block>
        <h1 class="span-12 margin-bottom-4-1">Musikvideoer</h1>
        <div v-for="(video, index) in videos" class="span-4 margin-bottom-4-1">
          <div class="videoWrap">
            <iframe class="video" :src="video.acf.video_embed_url_youtube" frameborder="0" allow="autoplay" allowfullscreen></iframe>
          </div>
          <release-date v-if="video.acf.video_release_date" :date="video.acf.video_release_date" />
        </div>
        <div class="span-12">
          <p v-if="noMoreVideos" :style="{ textAlign: 'center', marginBottom: '32px', fontWeight: 'bold' }">Det var det :)</p>
          <button @click.prevent="loadMoreVideos" :style="{ display: 'block', margin: '0 auto 32px' }">Vis flere videoer</button>
        </div>
      </grid-block>
    </div>
  </div>
</template>

<script>
  import GridBlock from '@/components/GridBlock'
  import Background from '@/components/Background'
  import Release from '@/components/Release'
  import ReleaseDate from '@/components/ReleaseDate'
  import Spinner from '@/components/Spinner'
  import { fetchData } from '@/utils/fetchData'
  import { decideRouteBackgroundColor } from '@/utils/decideRouteBackgroundColor'
  export default {
    name: 'MusicRoute',
    components: {
      'grid-block': GridBlock,
      'background': Background,
      'release': Release,
      'release-date': ReleaseDate,
      'spinner': Spinner
    },
    mixins: [fetchData, decideRouteBackgroundColor],
    data() {
      return {
        page: [],
        releases: [],
        videos: [],
        loadingMoreVideos: false,
        videosPerPage: 6,
        videosCollectionNumber: 1,
        noMoreVideos: null,
      }
    },
    computed: {
      backgroundColor() { return this.decideRouteBackgroundColor( 'Music page', 'musik' ) },
      releasesReversed() { if (this.releases) return this.releases.reverse() },
      releasesByReleasedateReversed() {
        let releases = this.releases
        releases.sort( (a, b) => { return parseInt(a.acf.release_date, 10) - parseInt(b.acf.release_date, 10) })
        return releases.reverse()
      },
      videosByReleasedateReversed() {
        let videos = this.videos
        videos.sort( (a, b) => { return parseInt(a.acf.video_release_date, 10) - parseInt(b.acf.video_release_date, 10) })
        return videos.reverse()
      }
    },
    created() {
      this.fetchData( 'pages?slug=musik' ).then( res => this.page = res )
      this.fetchData( 'releases?_embed' ).then( (res) => {
        this.releases = res
        this.fetchData( 'videos?per_page=' + this.videosPerPage + '&page=1&filter[orderby]=meta_value_num&filter[meta_key]=video_release_date&order=desc' ).then( res => this.videos = res )
      })
    },
    methods: {
      loadMoreVideos() {
        this.loadingMoreVideos = true
        this.videosCollectionNumber = this.videosCollectionNumber + 1
        this.fetchData( 'videos?per_page=' + this.videosPerPage + '&page=' + this.videosCollectionNumber + '&filter[orderby]=meta_value_num&filter[meta_key]=video_release_date&order=desc' ).then( res => {
          this.loadingMoreVideos = false
          this.videos = this.videos.concat(res)
        }).catch( () => {
          this.loadingMoreVideos = false
          this.noMoreVideos = true
        })
      }
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
