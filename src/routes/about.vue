<template>
  <div class="aboutRoute">
    <background :page="page" :color="backgroundColor" />
    <grid-block v-if="page" class="grid-upper">
      <div class="span-6 margin-bottom-4-1">
        <div v-html="page.content.rendered" />
      </div>
      <div class="span-5 offset-1 margin-bottom-4-1">
        <img
          width="100%"
          :src="page._embedded['wp:featuredmedia'][0].source_url"
          :alt="page._embedded['wp:featuredmedia'][0].alt_text ? page._embedded['wp:featuredmedia'][0].alt_text : null">
        <div class="caption margin-bottom-2-1" v-html="page._embedded['wp:featuredmedia'][0].caption.rendered" />
        <social-links />
      </div>
    </grid-block>
    <!-- <grid-block>
      <div class="span-7">

      </div>
    </grid-block> -->
  </div>
</template>

<script>
  import GridBlock from '@/components/GridBlock'
  import Background from '@/components/Background'
  import SocialLinks from '@/components/SocialLinks'
  import { routeColors } from '@/utils/colorVars'
  import { fetchData } from '@/utils/fetchData'
  export default {
    name: 'AboutRoute',
    components: {
      'grid-block': GridBlock,
      'background': Background,
      'social-links': SocialLinks,
    },
    mixins: [fetchData],
    data() {
      return {
        page: null,
        backgroundColor: routeColors.om.bg
      }
    },
    created() { this.fetchData( 'pages?slug=om&_embed' ).then( res => this.page = res[0] ) }
  }
</script>

<style lang="scss" scoped>
  @import '~@/styles/vars';
  @import '~@/styles/breakpoints';
  .aboutRoute { color: white; }
  .grid-upper { @include breakpoint( 'mobile' ) { flex-direction: column-reverse; } }
</style>
