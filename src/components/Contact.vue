<template>
  <div class="contact">
    <h2>{{ contact.acf.area }}</h2>
    <p v-if="contact.acf.fullnames" class="fontWeight-bold">{{ contact.acf.fullnames }}</p>
    <p v-if="contact.acf.company">{{ contact.acf.company }}</p>
    <a v-if="contact.acf.mail" :href="'mailto:' + contact.acf.mail" class="display-block margin-top">{{ contact.acf.mail }}</a>
    <p v-if="contact.acf.phone">{{ contact.acf.phone }}</p>
  </div>
</template>

<script>
  export default {
    name: 'Contact',
    props: { contact: Object }
  }
</script>

<style lang="scss" scoped>
  @import '~@/styles/helpers';
  .contact {
    @extend .box;
    min-height: 200px;
  }
</style>
