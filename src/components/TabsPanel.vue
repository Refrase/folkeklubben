<template>
  <div class="tabsPanel" ref="tabsPanel">
    <h2 class="title">{{ title }}</h2>
    <div class="tabsWrap">
      <ul class="tabs">
        <tab
          v-for="(tab, index) in tabs"
          v-if="!tab.acf.done"
          :active="activeTab === tab.title.rendered"
          :tab="tab"
          :key="index"
          :domRefs="domRefs" />
      </ul>
      <div class="xScrollShadow" />
    </div>
  </div>
</template>

<script>
  import Tab from '@/components/Tab'
  export default {
    name: 'TabsPanel',
    components: { tab: Tab },
    props: {
      title: String,
      tabs: Array,
      domRefs: Object
    },
    data() {
      return {
        activeTab: null
      }
    },
    watch: { tabs: function() { this.setActiveTab() } },
    created() { this.$bus.$on( 'clickedTab', (e) => { this.activeTab = e }) },
    mounted() { this.setActiveTab() },
    methods: {
      setActiveTab() {
        this.activeTab = this.tabs[0] ? this.tabs[0].title.rendered : null
      }
    }
  }
</script>

<style lang="scss" scoped>
  @import '~@/styles/vars';
  @import '~@/styles/breakpoints';
  @import '~@/styles/helpers';

  .tabsPanel {
    position: relative;
    @extend .fadeIn;

    .title {
      color: rgba(black, 0.25);
      text-transform: uppercase;
      font-size: $fontSize-large !important;
      @include breakpoint( 'mobile' ) { text-align: center; }
    }

    .tabsWrap {
      position: relative;
      @include breakpoint( 'mobile' ) { width: calc( 100% + 18px ); }
    }

    .tabs {
      list-style: none;
      white-space: nowrap;
      overflow-x: scroll;
      padding-top: $scale-2-1;
      padding-right: $scale-2-1;
      margin-top: $scale;
      min-height: 69px;

      &::-webkit-scrollbar { height: 0; }
      &::-webkit-scrollbar-track { background-color: transparent; }
      &::-webkit-scrollbar-thumb { background-color: $color-gold; }
    }

    .xScrollShadow {
      position: absolute;
      bottom: 0;
      right: 1px;
      height: 100%;
      width: 48px;
      background: linear-gradient(to right, transparent, rgba(black, 0.1));
      display: none;

      @include breakpoint( 'mobile' ) { display: block; }
    }
  }

</style>
