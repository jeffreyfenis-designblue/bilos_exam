<template lang="html">
  <nuxt-link
    :to="link"
    custom
    v-slot="{ href, navigate, isActive, isExactActive }"
    v-if="status == 0
  ">
    <a
      :class="[
        (isExactActive) ? attr.exact : '',
        attr.button,
        attr[template],
        attr.pointer,
        (disabled) ? attr.disabled : '',
        (minimal) ? attr.minimal : '',
        (full_width) ? attr.full : ''
      ]"
      :href="href"
      @click="navigate"
    >
      <span>{{ label }}</span>
    </a>
  </nuxt-link>

  <a
    :href="link"
    target="_blank"
    :class="[
      attr.button,
      attr[template],
      attr.pointer,
      (disabled) ? attr.disabled : '',
      (minimal) ? attr.minimal : '',
      (full_width) ? attr.full : ''
    ]"
    v-else-if="status == 1"
  >
    <span>{{ label }}</span>
  </a>

  <button
    :type="button_type"
    :class="[
      attr.button,
      attr[template],
      attr.pointer,
      (disabled) ? attr.disabled : '',
      (minimal) ? attr.minimal : '',
      (full_width) ? attr.full : ''
    ]"
    v-else-if="status == 2"
  >
    <span>{{ label }}</span>
  </button>
</template>

<script lang="ts">
  export default {
    props: {
      button_type: {
        type: String,
        default: 'button'
      },
      label: {
        type: String,
        default: ''
      },
      link: {
        type: String,
        default: '#'
      },
      status: {
        type: Number,
        default: 0
      },
      disabled: {
        type: Boolean,
        default: false
      },
      minimal: {
        type: Boolean,
        default: false
      },
      full_width: {
        type: Boolean,
        default: false
      },
      template: {
        type: String,
        default: 'template_1'
      }
    }
  }
</script>

<style lang="stylus" module="attr">
  .pointer
    cursor: pointer
  .ml
    margin-left: 20px
  .button
    display: inline-block
    font-family: var(--dm_sans)
    font-weight: var(--med)
    display: inline-block
    position: relative
    text-align: center
    padding: 10px 30px
    border-radius: 5px
    box-shadow: 0 0 15px transparent
    transition: .3s ease-in-out
    &.minimal
      padding: 10px 20px
      span
        font-size: 14px
    &.disabled
      pointer-events: none
      &.template_1,
      &.template_2,
      &.template_3,
      &.template_4,
      &.template_5
        border: 2px solid var(--theme_gray_v2)
        background-color: var(--theme_gray_v2)
        span
          color: var(--theme_white)
    &.full
      display: block
      width: 100%
    &.template_1
      border: 2px solid var(--theme_primary)
      background-color: var(--theme_primary)
    &.template_2
      border: 2px solid var(--theme_primary)
      background-color: transparent
      span
        color: var(--theme_primary)
      &:hover
        background-color: var(--theme_primary)
        border: 2px solid var(--theme_primary)
        span
          color: var(--theme_white)
    &.template_3
      border: 2px solid var(--theme_white)
      background-color: transparent
      span
        color: var(--theme_white)
      &:hover
        background-color: var(--theme_white)
        border: 2px solid var(--theme_white)
        span
          color: var(--theme_primary)
    &.template_4
      border: 2px solid var(--theme_error)
      background-color: var(--theme_error)
      &:hover
        box-shadow: 0 0 15px var(--theme_error)
    &.template_5
      border: 2px solid var(--theme_secondary)
      background-color: var(--theme_secondary)
      &:hover
        box-shadow: 0 0 15px var(--theme_secondary)
    span
      display: block
      position: inherit
      z-index: 0
      font-size: 18px
      color: var(--theme_white)
      vertical-align: top
      transform: scale(1)
      transition: .3s cubic-bezier(.17,.67,.77,1)
    &:hover
      box-shadow: 0 0 15px var(--theme_primary)
  /**
   * Responsive */
  @media (max-width: 1024px) and (min-width: 280px)
    .button
      padding: 10px 20px
      span
        font-size: 14px
    @media (max-width: 310px) and (min-width: 280px)
      .button
        display: block
        width: 100%
</style>
