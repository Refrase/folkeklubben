<template>
  <div class="post">
    <img v-if="hasImage" :src="post._embedded['wp:featuredmedia'][0].source_url" width="100%" />
    <div class="content" :class="{ 'noImage': !hasImage }">
      <h2 class="title">{{ post.title.rendered }}</h2>
      <p class="date">{{ date }}</p>
      <div class="text" v-html="post.content.rendered" />
    </div>
  </div>
</template>

<script>
  export default {
    name: 'Post',
    props: { post: Object },
    computed: {
      hasImage() { return this.post._embedded['wp:featuredmedia'] },
      date() {
        const monthNames = ['januar', 'februar', 'marts', 'april', 'maj', 'juni', 'juli', 'august', 'september', 'oktober', 'november', 'december']
        const date = new Date(this.post.date)
        const day = date.getDate()
        const month = monthNames[date.getMonth()]
        const year = date.getFullYear()
        return day + ' ' + month + ' ' + year
      }
    }
  }
</script>

<style lang="scss" scoped>
  @import '~@/styles/vars';
  @import '~@/styles/helpers';

  .post {
    width: 100%;
    @extend .fadeInSequence;
    @extend .roundedCorners;
    overflow: hidden;

    img { display: block; }
  }

  .content {
    border-bottom-left-radius: $borderRadius;
    border-bottom-right-radius: $borderRadius;
    background-color: white;
    border: 1px solid $color-gold;
    border-top: none;
    padding: $scale-3-1 $scale-4-1;

    &.noImage { border-top: 1px solid $color-gold; }
  }

  .title {
    font-size: 42px;
    margin-bottom: $scale-2-1;
  }

  .date {
    font-size: $fontSize-small;
    margin-bottom: $scale + 4px;
    color: $color-gold;
    font-weight: bold;
  }

  .text /deep/ * {
    font-size: 16px;
    @include breakpoint( 'mobile' ) { font-size: $fontSize-small !important; }
    a { letter-spacing: 0; }
  }


</style>
