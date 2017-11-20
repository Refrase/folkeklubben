<template>
  <div class="pressRoute">
    <background :page="page ? page : null" :color="backgroundColor" />
    <spinner v-if="!page" />
    <grid-block v-if="page" class="grid-upper">
      <div class="span-7 margin-bottom-4-1">
        <img width="100%" :src="page.acf.press_image_01">
        <p class="caption margin-bottom-4-1">{{ page.acf.press_image_01_caption }}</p>
        <div v-html="page.content.rendered" />
      </div>
      <div class="span-4 offset-1 margin-bottom-4-1">
        <social-links class="margin-bottom-4-1" :style="{ backgroundColor: 'transparent' }" />
        <a class="button margin-bottom-4-1 display-block center" :href="page.acf.press_material_package">Hent pressemateriale</a>
        <img width="100%" :src="page.acf.press_image_02">
        <p class="caption margin-bottom-4-1">{{ page.acf.press_image_01_caption }}</p>
        <img width="100%" :src="page.acf.press_image_03">
        <p class="caption margin-bottom-4-1">{{ page.acf.press_image_01_caption }}</p>
      </div>
    </grid-block>
  </div>
</template>

<script>
  import GridBlock from '@/components/GridBlock'
  import Background from '@/components/Background'
  import Spinner from '@/components/Spinner'
  import SocialLinks from '@/components/SocialLinks'
  import { routeColors } from '@/utils/colorVars'
  import { fetchData } from '@/utils/fetchData'
  export default {
    name: 'AboutRoute',
    components: {
      'grid-block': GridBlock,
      'background': Background,
      'spinner': Spinner,
      'social-links': SocialLinks,
    },
    mixins: [fetchData],
    data() {
      return {
        backgroundColor: routeColors.presse.bg,
        page: null
      }
    },
    created() { this.fetchData( 'pages?slug=presse&_embed' ).then( res => this.page = res[0] ) }
  }
</script>

<style lang="scss" scoped>
  @import '~@/styles/vars';
  @import '~@/styles/breakpoints';
  .pressRoute { color: white; }
  .button { padding-left: $scale; padding-right: $scale; }
</style>
