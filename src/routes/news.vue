<template>
  <div class="news">
    <grid-block>
      <div class="span-8" v-if="loading || error">
        <h2>{{ loading ? 'Nyheder hentes...' : error }}</h2>
      </div>
      <div class="span-8" v-else>
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
        loading: false,
        error: null,
        posts: null
      }
    },
    created() {
      this.getPost()
    },
    methods: {
      getPost() {
        this.loading = true
        // wp.rest_root is made available in functions.php
        // the ?_embed expands the returned data with embedded stuff like featured image
        this.$http.get(wp.rest_root + '/wp/v2/posts?_embed').then( (response) => {
          this.loading = false
          this.posts = response.data
        }, (error) => {
          this.loading = false
          this.error = 'Der er desværre sket en fejl. Prøv igen senere.'
          console.log(error)
        });
      }
    }
  }
</script>

<style lang="scss" scoped>
  .news {
    width: 100%;
    min-height: 100%;
    background-image: url('~@/assets/images/pressefoto-fade.png');
    background-repeat: no-repeat;
    background-position: bottom;
    background-size: cover;
  }
</style>
