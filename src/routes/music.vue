<template>
  <div class="musicRoute">
    <background :page="page" :color="backgroundColor" />
    <grid-block>
      <div v-for="(album, index) in albums" class="span-4">
        <album :album="album" :key="index" />
      </div>
    </grid-block>
  </div>
</template>

<script>
  import GridBlock from '@/components/GridBlock'
  import Background from '@/components/Background'
  import Album from '@/components/Album'
  import { routeColors } from '@/utils/colorVars'
  export default {
    name: 'MusicRoute',
    components: {
      'grid-block': GridBlock,
      'background': Background,
      'album': Album
    },
    data() {
      return {
        backgroundColor: routeColors.musik.bg,
        page: null,
        albums: [
          {
            title: 'Slår Flint',
            image: { url: null },
            releaseDate: '22 jan \'14',
            links: {
              listen: '#',
              buy: {
                cd: '#',
                lp: '#'
              }
            },
            tracklist: [
              {
                title: 'Torben Ulrich',
                id: 'torben-ulrich',
                lyrics: '<p>Der er sol over Danmark.<br>Vi synger dine sange og glemmer dine nederlag.</p><p>Folkehelt, fanebærer, beatnik, laissez-faire,<br>hej hej bolighaj, skåltaler 1. maj.<br>Folkehold, fattigrøve, Egon, Benny, Kjeld og Børge.<br>Kan du ikke gå, så stå på dine ben.</p><p>I dag bliver en god dag.<br>Jeg går som Torben Ulrich efter det perfekte slag.<br>Og jeg klapper det klaptræ. Til filmen om en mand,<br>der blev sin egen herre en dag.<br>Yeah, yeah juhu!<br>Yeah, yeah juhu!</p>'
              },
              {
                title: 'Torben Ulrich 2',
                id: 'torben-ulrich-2',
                lyrics: '<p>Der er sol over Danmark.<br>Vi synger dine sange og glemmer dine nederlag.</p>'
              },
              {
                title: 'Torben Ulrich 3',
                id: 'torben-ulrich-3',
                lyrics: '<p>Folkehelt, fanebærer, beatnik, laissez-faire,<br>hej hej bolighaj, skåltaler 1. maj.<br>Folkehold, fattigrøve, Egon, Benny, Kjeld og Børge.<br>Kan du ikke gå, så stå på dine ben.</p><p>I dag bliver en god dag.<br>Jeg går som Torben Ulrich efter det perfekte slag.<br>Og jeg klapper det klaptræ. Til filmen om en mand,<br>der blev sin egen herre en dag.<br>Yeah, yeah juhu!<br>Yeah, yeah juhu!</p>'
              }
            ]
          },
          {
            title: 'Slår Flint',
            image: { url: null },
            releaseDate: '14 aug \'16',
            links: {
              listen: '#',
              buy: {
                cd: '#',
                lp: '#'
              }
            },
            tracklist: [
              {
                title: 'Torben Ulrich',
                id: 'torben-ulrich',
                lyrics: '<p>Der er sol over Danmark.<br>Vi synger dine sange og glemmer dine nederlag.</p><p>Folkehelt, fanebærer, beatnik, laissez-faire,<br>hej hej bolighaj, skåltaler 1. maj.<br>Folkehold, fattigrøve, Egon, Benny, Kjeld og Børge.<br>Kan du ikke gå, så stå på dine ben.</p><p>I dag bliver en god dag.<br>Jeg går som Torben Ulrich efter det perfekte slag.<br>Og jeg klapper det klaptræ. Til filmen om en mand,<br>der blev sin egen herre en dag.<br>Yeah, yeah juhu!<br>Yeah, yeah juhu!</p>'
              },
              {
                title: 'Torben Ulrich 2',
                id: 'torben-ulrich-2',
                lyrics: '<p>Der er sol over Danmark.<br>Vi synger dine sange og glemmer dine nederlag.</p>'
              },
              {
                title: 'Torben Ulrich 3',
                id: 'torben-ulrich-3',
                lyrics: '<p>Folkehelt, fanebærer, beatnik, laissez-faire,<br>hej hej bolighaj, skåltaler 1. maj.<br>Folkehold, fattigrøve, Egon, Benny, Kjeld og Børge.<br>Kan du ikke gå, så stå på dine ben.</p><p>I dag bliver en god dag.<br>Jeg går som Torben Ulrich efter det perfekte slag.<br>Og jeg klapper det klaptræ. Til filmen om en mand,<br>der blev sin egen herre en dag.<br>Yeah, yeah juhu!<br>Yeah, yeah juhu!</p>'
              }
            ]
          }
        ]
      }
    },
    created() {
      this.getPage()
    },
    methods: {
      getPage() {
        this.$http.get(wp.rest_root + '/wp/v2/pages?slug=musik').then( (response) => {
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
  .musicRoute { color: white; }
</style>
