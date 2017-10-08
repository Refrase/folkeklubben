<template>
  <div>
    <h1>Nyheder</h1>
    <h2>{{ error ? error : !loading && post ? post.title.rendered : 'Loading...' }}</h2>
  </div>
</template>

<script>
  export default {
    name: 'NewsRoute',
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
        this.$http.get('http://localhost:3000/wp-json/wp/v2/posts/1').then( (response) => {
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
