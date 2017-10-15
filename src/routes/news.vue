<template>
  <div class="news routeWithHeader" v-bind:style="{ backgroundImage: backgroundImage ? 'url(' + backgroundImage + ')' : null }">
    <grid-block>
      <div class="span-7" v-if="loadingPosts || error">
        <h2>{{ loadingPosts ? 'Nyheder hentes...' : error }}</h2>
      </div>
      <div class="span-7" v-else>
        <post
          v-for="(post, index) in posts"
          :key="index"
          :post="post"
          class="margin-bottom-4-1" />
      </div>
    </grid-block>
  </div>
</template>

<script>
  import GridBlock from '@/components/GridBlock'
  import Post from '@/components/Post'
  export default {
    name: 'NewsRoute',
    components: {
      'grid-block': GridBlock,
      'post': Post
    },
    data() {
      return {
        error: null,
        loadingPosts: false,
        posts: null,
        page: null,
        backgroundImage: null
      }
    },
    created() {
      this.getPosts()
      this.getPage()
    },
    methods: {
      getPosts() {
        this.loadingPosts = true
        // wp.rest_root is made available in functions.php
        // the ?_embed expands the returned data with embedded stuff like featured image
        this.$http.get(wp.rest_root + '/wp/v2/posts?_embed').then( (response) => {
          this.loadingPosts = false
          this.posts = response.data
          this.setBackgroundImage()
        }, (error) => {
          this.loadingPosts = false
          this.error = 'Der er desværre sket en fejl. Prøv igen senere.'
          console.log(error)
        });
      },
      getPage() {
        this.$http.get(wp.rest_root + '/wp/v2/pages?slug=nyheder').then( (response) => {
          this.page = response.data
          this.setBackgroundImage()
        }, (error) => {
          this.page = null
          console.log('Could not load page');
        });
      },
      setBackgroundImage() {
        if (this.posts && this.page) this.backgroundImage = this.page[0].acf['background-image'] ? this.page[0].acf['background-image'] : null
      }
    }
  }
</script>

<style lang="scss" scoped>
  @import '~@/styles/vars';
  .news {
    background-color: white;
    background-repeat: no-repeat;
    background-position: bottom right;
    background-size: cover;
  }
</style>
