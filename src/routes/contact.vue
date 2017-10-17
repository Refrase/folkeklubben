<template>
  <div class="contactPage">
    <background :page="page" :color="backgroundColor" />
    <grid-block>
      <div class="span-12">
        <h2>Kontakt</h2>
      </div>
    </grid-block>
  </div>
</template>

<script>
  import GridBlock from '@/components/GridBlock'
  import Background from '@/components/Background'
  import { routeColors } from '@/utils/colorVars'
  export default {
    name: 'ContactRoute',
    components: {
      'grid-block': GridBlock,
      'background': Background
    },
    data() {
      return {
        page: null,
        backgroundColor: routeColors.kontakt.bg
      }
    },
    created() {
      this.getPage()
    },
    methods: {
      getPage() {
        this.$http.get(wp.rest_root + '/wp/v2/pages?slug=kontakt').then( (response) => {
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
  .contactPage { color: white; }
</style>
