<template lang="html" v-if="loaded">
  <div :id="attr.page">
    <div class="container">
      <event-calendar />
    </div>
  </div>
</template>

<script>
export default {
  components: {
    ClientProfile: () => import('~/components/global/EventCalendar')
  },
  data: () => ({
    loaded: false
  }),
  mounted() {
    this.toggleModalStatus({ type: 'loader', status: true })
    setTimeout(() => {
      this.toggleModalStatus({ type: 'loader', status: false })
      this.loaded = true
    }, 500)
  }
}
</script>

<style lang="stylus" module="attr">
  #page
    position: relative
</style>
