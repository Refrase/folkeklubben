<template>
  <grid-block>
    <div class="span-8">
      <h1>Nyheder</h1>
      <h2>{{ error ? error : !loading && post ? post.title.rendered : 'Loading...' }}</h2>
      <div v-html="post.content.rendered" />
    </div>
  </grid-block>
</template>

<script>
  import GridBlock from '@/components/GridBlock'
  export default {
    name: 'NewsRoute',
    components: { 'grid-block': GridBlock },
    data() {
      return {
        loading: false,
        error: null,
        post: null
      }
    },
    created() {
      this.getPost()
    },
    methods: {
      getPost() {
        this.loading = true
        // wp.rest_root is made available in functions.php
        this.$http.get(wp.rest_root + '/wp/v2/posts/4').then( (response) => {
          this.loading = false
          this.post = response.data
        }, (error) => {
          this.error = 'Der er desværre sket en fejl'
          console.log(error)
        });
      }
    }
  }
</script>

<style lang="scss" scoped>
  @import '~@/styles/breakpoints';
  h1 {
    font-size: 100px;
    @include breakpoint( 'mobile' ) { font-size: 28px; }
  }
</style>
