<template>
  <div class="newsRoute">
    <background :page="page" :color="backgroundColor" />
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
  import Background from '@/components/Background'
  import Post from '@/components/Post'
  import { routeColors } from '@/utils/colorVars'
  export default {
    name: 'NewsRoute',
    components: {
      'grid-block': GridBlock,
      'background': Background,
      'post': Post
    },
    data() {
      return {
        error: null,
        loadingPosts: false,
        posts: null,
        page: null,
        backgroundColor: routeColors.nyheder.bg
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
        }, (error) => {
          this.loadingPosts = false
          this.error = 'Der er desværre sket en fejl. Prøv igen senere.'
          console.log(error)
        });
      },
      getPage() {
        this.$http.get(wp.rest_root + '/wp/v2/pages?slug=nyheder').then( (response) => {
          this.page = response.data
        }, (error) => {
          this.page = null
          console.log('Could not load page');
        });
      }
    }
  }
</script>

<style lang="scss" scoped></style>
