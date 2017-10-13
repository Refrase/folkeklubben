<template>
  <div class="menu">
    <div class="top">
      <p class="logo">Folkeklubben</p>
      <ul class="nav">
        <li>Nyheder</li>
        <li>Koncerter</li>
        <li>Musik</li>
        <li>Merch</li>
        <li>Om</li>
        <li>Kontakt</li>
      </ul>
    </div>
    <form class="newsletter" action="index.html" method="post">
      <input type="email" name="email" id="email" placeholder="Meld dig til nyhedsbrevet her..." />
      <input type="submit" value="Tilmeld" />
    </form>
  </div>
</template>

<script>
  export default {
    name: 'Menu',
  }
</script>

<style lang="scss" scoped>
  @import '~@/styles/vars';
  @import '~@/styles/breakpoints';

  .menu {
    width: 381px;
    position: fixed;

    @include breakpoint( 'tablet' ) {
      width: 274px;
      top: 0;
    }

    @include breakpoint( 'mobile' ) {
      left: 50%;
      transform: translateX(-50%);
    }
  }

  .top {
    background-color: $color-gold;
    padding: $scale-2-1 $scale-3-1;
  }

  .nav {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    list-style: none;
    margin-top: $scale-2-1;
    white-space: nowrap;

    @include breakpoint( 'tablet' ) {
      justify-content: center !important;
      margin-top: $scale + $scale-1-2;
    }

    li {
      font-family: $fontFamily-sans;
      text-transform: uppercase;
      font-size: $fontSize-xsmall;

      &:nth-child(4) { display: block; }

      @include breakpoint( 'tablet' ) { margin-right: $scale; }
    }
  }

  .logo {
    font-family: $fontFamily-sansCondensed;
    text-transform: uppercase;
    width: 100%;
    text-align: center;
    line-height: 0.8;
    font-size: 61px;
    margin-left: -2px;
    color: $color-gold-lighter-4;
    @include breakpoint( 'tablet' ) { font-size: 41.3px; }
  }

  .newsletter {
    margin-top: 1px;

    label {
      display: block;
      width: 100%;
      font-size: $fontSize-xsmall;
      text-transform: uppercase;
      padding: $scale $scale-2-1;
      color: white;
      text-align: center;
      background: $color-gold;
      letter-spacing: 0.8px;
    }

    input[type="email"] {
      // max-width: 164px;
      width: 68%;
      font-size: $fontSize-xsmall;
      padding: $scale $scale-3-1;
      padding-right: $scale-1-2;
      display: inline-block;
      float: left;
      background-color: rgba($color-gold, 0.8);
    }

    input[type="submit"] {
      min-width: 80px;
      width: 32%;
      float: left;
      display: inline-block;
      background-color: $color-gold;
    }
  }
</style>
