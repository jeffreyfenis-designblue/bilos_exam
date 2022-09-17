<template lang="html">
  <transition name="slideY">
    <span :class="[ '__v', attr.validate, attr[payload.adjusted] ]" v-if="payload.errors && payload.errors.length > 0">
      <div :class="attr.text">{{ payload.errors[0] }}</div>
    </span>
  </transition>
</template>

<script>
  export default {
    props: {
      payload: {
        type: Object,
        default: {
          errors: null,
          adjusted: ''
        }
      }
    }
  }
</script>

<style lang="stylus" module="attr">
  .validate
    position: absolute
    top: 105%
    left: 0
    right: 0
    pointer-events: none
    &.adjusted
      top: 102%
    .text
      color: var(--theme_error)
      font-weight: var(--reg)
      font-size: 12px
      user-select: none
      line-height: 1
</style>
