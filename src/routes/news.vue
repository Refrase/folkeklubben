<template>
  <div class="newsRoute">
    <background :page="page ? page[0] : null" :color="backgroundColor" />
    <grid-block>

      <div class="span-7" v-if="loadingPosts">
        <spinner />
      </div>

      <div class="span-7" v-else>
        <post
          v-for="(post, index) in posts"
          :key="index"
          :post="post"
          class="margin-bottom-4-1" />
        <spinner v-if="loadingMorePosts" />
        <p v-if="noMorePosts" :style="{ textAlign: 'center', marginBottom: '32px', fontWeight: 'bold' }">Det var det :)</p>
        <button @click.prevent="loadMorePosts" :style="{ display: 'block', margin: '0 auto 32px' }">Hent flere nyheder</button>
      </div>

      <div class="span-5" v-if="posts.length && notPhone">

        <social-links />

        <div class="facebook">
          <h3>Følg eller like os på Facebook</h3>
          <div class="facebook_button">
            <div class="fb-follow" data-href="https://www.facebook.com/folkeklubben" data-layout="button" data-size="large" data-show-faces="false" />
            <div class="fb-like" data-href="https://www.facebook.com/folkeklubben" data-layout="button" data-size="large" data-show-faces="false" />
          </div>
        </div>

        <div v-if="this.instagramImage" class="instagram margin-top-4-1">
          <img :src="this.instagramImage.images.standard_resolution.url" width="100%" class="display-block" alt="">
          <div class="instagram_content">
            <p>{{ this.instagramImage.caption.text }}</p>
            <a href="https://www.instagram.com/folkeklubben/" class="display-block margin-top-2-1 textAlign-center width-full">Følg os på Instagram</a>
          </div>
        </div>

      </div>
    </grid-block>
  </div>
</template>

<script>
  import GridBlock from '@/components/GridBlock'
  import Background from '@/components/Background'
  import Post from '@/components/Post'
  import SocialLinks from '@/components/SocialLinks'
  import Spinner from '@/components/Spinner'
  import { routeColors } from '@/utils/colorVars'
  import { fetchData } from '@/utils/fetchData'
  import { whichDevice } from '@/utils/detectDevice'
  export default {
    name: 'NewsRoute',
    components: {
      'grid-block': GridBlock,
      'background': Background,
      'post': Post,
      'social-links': SocialLinks,
      'spinner': Spinner
    },
    mixins: [fetchData, whichDevice],
    data() {
      return {
        backgroundColor: routeColors.nyheder.bg,
        created: false,
        page: null,
        loadingPosts: true,
        loadingMorePosts: false,
        posts: [],
        postsPerPage: 2,
        postsCollectionNumber: 1,
        noMorePosts: null,
        instagramImage: null
      }
    },
    computed: {
      notPhone() {
        const device = this.whichDevice()
        return device !== 'iPhone' && device !== 'android mobile'
      }
    },
    created() {
      this.fetchData( 'pages?slug=nyheder' ).then( res => this.page = res )
      this.fetchData( 'posts?_embed&per_page=' + this.postsPerPage + '&page=1' ).then( res => {
        this.loadingPosts = false
        this.posts = res
      })
    },
    watch: {
      posts: function() { this.renderSocialMediaContent ? this.renderSocialMediaContent() : null }
    },
    methods: {
      renderSocialMediaContent() {
        if ( this.notPhone ) { // Only fetch if not phone
          this.$http.jsonp( 'https://api.instagram.com/v1/users/self/media/recent/?access_token=354252845.1677ed0.01fc64c82cd64fdd92b91f248c804ef7' )
          .then( res => this.instagramImage = res.body.data[0] )
          window.setTimeout( () => { window.FB.XFBML.parse() }, 100) // Re-render Facebook plugins when this route is mounted
        }
      },
      loadMorePosts() {
        this.loadingMorePosts = true
        this.postsCollectionNumber = this.postsCollectionNumber + 1
        this.fetchData( 'posts?_embed&per_page=' + this.postsPerPage + '&page=' + this.postsCollectionNumber ).then( res => {
          this.loadingMorePosts = false
          this.posts = this.posts.concat(res)
        }).catch( () => {
          this.loadingMorePosts = false
          this.noMorePosts = true
        })
      }
    }
  }
</script>

<style lang="scss" scoped>
  @import '~@/styles/helpers';

  .facebook {
    @extend .box;
    background-color: transparent;
    border-color: $color-blue;
    text-align: center;
    min-height: 122px;
    @extend .fadeInWithDelay;
    h3 {
      color: $color-blue;
      margin-bottom: $scale-2-1;
    }
  }

  .instagram {
    @extend .fadeInWithDelay;
    &_content {
      @extend .box;
      border-top: none;
    }
  }
</style>
