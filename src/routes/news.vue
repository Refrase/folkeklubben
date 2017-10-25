<template>
  <div class="newsRoute">
    <background :page="page ? page[0] : null" :color="backgroundColor" />
    <grid-block>
      <div class="span-7" v-if="loadingPosts">
        <h2>Nyheder hentes...</h2>
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
  import { fetchData } from '@/utils/fetchData'
  export default {
    name: 'NewsRoute',
    components: {
      'grid-block': GridBlock,
      'background': Background,
      'post': Post
    },
    mixins: [fetchData],
    data() {
      return {
        page: null,
        loadingPosts: true,
        posts: null,
        backgroundColor: routeColors.nyheder.bg
      }
    },
    created() {
      this.fetchData( 'pages?slug=musik' ).then( res => this.page = res )
      this.fetchData( 'posts?_embed' ).then( res => {
        this.loadingPosts = false
        this.posts = res
      })
    }
  }
</script>

<style lang="scss" scoped></style>
