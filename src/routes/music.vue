<template>
  <div class="musicRoute">
    <background :page="page" :color="backgroundColor" />
    <grid-block>
      <div class="span-4">
        <div class="album">
          <img src="../assets/images/cover.jpg" alt="" width="100%">
          <div class="links">
            <a href="#" class="button"><span>Lyt</span></a>
            <a href="#" class="button"><span>Køb CD</span></a>
            <a href="#" class="button"><span>Køb LP</span></a>
          </div>
          <ul class="tracklist">
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
          </ul>
        </div>
      </div>
      <div class="span-4">
        <div class="album">
          <img src="../assets/images/cover.jpg" alt="" width="100%">
          <div class="links">
            <a href="#" class="button"><span>Lyt</span></a>
            <a href="#" class="button"><span>Køb CD</span></a>
            <a href="#" class="button"><span>Køb LP</span></a>
          </div>
          <ul class="tracklist">
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
          </ul>
        </div>
      </div>
      <div class="span-4">
        <div class="album">
          <img src="../assets/images/cover.jpg" alt="" width="100%">
          <div class="links">
            <a href="#" class="button"><span>Lyt</span></a>
            <a href="#" class="button"><span>Køb CD</span></a>
            <a href="#" class="button"><span>Køb LP</span></a>
          </div>
          <ul class="tracklist">
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
          </ul>
        </div>
      </div>
      <div class="span-4">
        <div class="album">
          <img src="../assets/images/cover.jpg" alt="" width="100%">
          <div class="links">
            <a href="#" class="button"><span>Lyt</span></a>
            <a href="#" class="button"><span>Køb CD</span></a>
            <a href="#" class="button"><span>Køb LP</span></a>
          </div>
          <ul class="tracklist">
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
            <li>Torben Ulrich <a href="#">Tekst</a></li>
          </ul>
        </div>
      </div>
    </grid-block>
  </div>
</template>

<script>
  import GridBlock from '@/components/GridBlock'
  import Background from '@/components/Background'
  import { routeColors } from '@/utils/colorVars'
  export default {
    name: 'MusicRoute',
    components: {
      'grid-block': GridBlock,
      'background': Background
    },
    data() {
      return {
        page: null,
        backgroundColor: routeColors.musik.bg
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
  @import '~@/styles/vars';

  .musicRoute { color: white; }

  .album {
    margin-bottom: $scale-4-1;

    img { display: block; }

    .links {
      display: flex;
      margin-top: $scale-2-1;

      .button {
        display: flex;
        align-items: center;
        flex-basis: 100%;
        padding: $scale $scale-2-1;
        padding-bottom: $scale + 2px;
        margin-right: $scale-2-1;
        white-space: normal;

        span {
          width: 100%;
          text-align: center;
        }

        &:last-child { margin-right: 0; }
      }
    }

    .tracklist {
      list-style: none;
      margin-top: $scale-2-1;

      li {
        padding: $scale-1-2 $scale ($scale-1-2 - 3px);
        font-size: $fontSize-small;
        font-weight: bold;

        &:nth-child(odd) { background-color: rgba(white, 0.05); }

        a {
          position: relative;
          float: right;
          font-size: inherit;
          bottom: -2px;
        }
      }
    }

  }

</style>
