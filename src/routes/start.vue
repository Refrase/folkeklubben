<template>
  <div class="start">
    <background :page="page" />
    <ul class="links">
      <li><router-link :to="{ name: 'nyheder' }"><span>Nyheder</span></router-link></li>
      <li><router-link :to="{ name: 'koncerter' }"><span>Koncerter</span></router-link></li>
      <li><a><span>Musik</span></a></li>
      <li><a><span>Merch</span></a></li>
    </ul>
  </div>
</template>

<script>
  import Background from '@/components/Background'
  export default {
    name: 'StartRoute',
    components: { 'background': Background },
    data() {
      return { page: null }
    },
    created() {
      this.getPage()
    },
    methods: {
      getPage() {
        this.$http.get(wp.rest_root + '/wp/v2/pages?slug=start').then( (response) => {
          this.page = response.data
        }, (error) => {
          this.page = null
          console.log('Could not load page');
        });
      }
    }
  }
</script>

<style lang="scss" scoped>
  @import '~@/styles/vars';
  @import '~@/styles/breakpoints';

  .start {
    background-color: white;

    .backgroundImage {
      @include breakpoint( 'mobile' ) { background-position: -650px top; }
    }
  }

  .links {
    display: flex;
    position: absolute;
    bottom: $scale-2-1;
    left: 15px;
    width: calc( 100% - 30px ); // Borders
    height: 160px;
    list-style: none;

    @include breakpoint( 'tablet' ) { flex-wrap: wrap; height: 320px; }

    li {
      width: 25%;
      height: 100%;

      @include breakpoint( 'tablet' ) { width: 50%; height: 50%; }
      @include breakpoint( 'custom', '480px' ) { width: 100%; height: 25%; }

      transition: background-color 0.15s ease-out;

      &:nth-child(1) { background-color: rgba(white, 0.9);
        a { color: $color-darkblue; }
        &:hover { background-color: white; }}
      &:nth-child(2) { background-color: rgba($color-lightred, 0.9);
        &:hover { background-color: $color-lightred; }}
      &:nth-child(3) { background-color: rgba($color-darkblue, 0.9);
        &:hover { background-color: $color-darkblue; }}
      &:nth-child(4) { background-color: rgba($color-gold, 0.9);
        &:hover { background-color: $color-gold; }}
    }

    a {
      display: flex;
      align-items: center;
      width: 100%;
      height: 100%;
      font-family: $fontFamily-sansCondensed;
      text-transform: uppercase;
      color: white;
      font-size: $fontSize-xxxlarge;

      span {
        width: 100%;
        text-align: center;
      }
    }
  }
</style>
