<template>
  <div class="contactRoute">
    <background :page="page ? page : null" :color="backgroundColor" />
    <spinner v-if="loadingContacts" />
    <grid-block v-if="page">
      <div class="span-12 margin-bottom-4-1">
        <div class="subheader" v-html="page.content.rendered" />
      </div>
      <div class="span-6" v-if="contacts" v-for="(contact, index) in contacts">
        <contact :contact="contact" class="margin-bottom-4-1" />
      </div>
    </grid-block>
  </div>
</template>

<script>
  import GridBlock from '@/components/GridBlock'
  import Background from '@/components/Background'
  import Contact from '@/components/Contact'
  import Spinner from '@/components/Spinner'
  import { routeColors } from '@/utils/colorVars'
  import { fetchData } from '@/utils/fetchData'
  export default {
    name: 'ContactRoute',
    components: {
      'grid-block': GridBlock,
      'background': Background,
      'spinner': Spinner,
      'contact': Contact
    },
    mixins: [fetchData],
    data() {
      return {
        backgroundColor: routeColors.kontakt.bg,
        page: null,
        contacts: [],
        loadingContacts: true
      }
    },
    created() {
      this.fetchData( 'pages?slug=kontakt' ).then( res => this.page = res[0] )
      this.fetchData( 'contacts?order=asc' ).then( res => {
        this.loadingContacts = false
        this.contacts = res
      })
    }
  }
</script>

<style lang="scss" scoped>
  @import '~@/styles/breakpoints';
  .contactRoute { color: white; }
  .subheader /deep/ * { @include breakpoint('mobile') { text-align: center; }}
</style>
