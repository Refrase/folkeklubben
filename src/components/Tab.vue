<template>
  <li class="tab" :class="{ active: active }" @click="handleClick">
    <h3 class="title">{{ tab.title.rendered }}</h3>
    <p class="date">{{ tab.acf.period }}</p>
  </li>
</template>

<script>
  export default {
    name: 'Tab',
    props: {
      tab: Object,
      active: Boolean,
      domRefs: Object
    },
    methods: {
      scrollToRef() { this.domRefs[this.tab.title.rendered][0].$el.scrollIntoView({ behavior: "smooth", block: "start" }) },
      handleClick() {
        this.scrollToRef()
        this.$bus.$emit( 'clickedTab', this.tab.title.rendered )
      }
    }
  }
</script>

<style lang="scss" scoped>
  @import '~@/styles/vars';
  @import '~@/styles/helpers';

  .tab {
    margin-right: $scale-4-1;
    display: inline-block;
    color: rgba(black, 0.3);
    cursor: pointer;
    padding-bottom: $scale;
    @extend .transitionFadeOnHover;

    &:hover,
    &.active { color: white; }
    &.active { border-bottom: 4px solid white; }

    .title {
      font-size: 16px;
      text-transform: uppercase;
      margin-bottom: $scale-1-2;
    }

    .date {
      font-size: $fontSize-small;
      font-weight: bold;
    }
  }

</style>
