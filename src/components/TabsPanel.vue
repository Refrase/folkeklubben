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

  .tabsPanel {
    position: relative;

    .title {
      color: rgba(black, 0.25);
      text-transform: uppercase;
      font-size: $fontSize-large !important;

      @include breakpoint( 'mobile' ) {
        text-align: center;

      }
    }

    .tabsWrap { position: relative; }

    .tabs {
      border-bottom: 1px solid $color-lightred-darker-2;
      list-style: none;
      white-space: nowrap;
      overflow-x: scroll;
      padding-top: $scale-2-1;
      padding-right: $scale-2-1;
      margin-top: $scale;
      min-height: 70px;

      @include breakpoint( 'mobile' ) {
        border-top: 1px solid $color-lightred-darker-2;
        border-right: 1px solid $color-lightred-darker-2;
      }

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
      background: linear-gradient(to right, transparent, rgba($color-lightred-darker-2, 0.3));
      display: none;

      @include breakpoint( 'mobile' ) { display: block; }
    }
  }

</style>
