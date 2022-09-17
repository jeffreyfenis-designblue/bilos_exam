<template>
  <div id="__db" :style="style">
    <Nuxt />
    <transition name="fade">
      <template v-if="getShowStatus('loader')">
        <loader />
      </template>
    </transition>
  </div>
</template>

<script>
import SecureLS from 'secure-ls'
import { mapMutations } from 'vuex'

export default {
  data: () => ({
    style: 0,
    toggle: {
      compliance: false
    }
  }),
  watch: {
    $route(to, from) {
      this.routeChecklist()
    }
  },
  methods: {
    ...mapMutations({
      enteredMobile: 'global/settings/enteredMobile'
    }),
    routeChecklist() {
      setTimeout(() => {
        this.autoStyle()
        this.onResize()
      }, 250)
    },
    onResize() {
      if (document.documentElement && document.documentElement.clientWidth) {
        this.enteredMobile({ status: (document.documentElement.clientWidth <= 1024) ? true : false })
      }
      this.autoStyle()
    },
    autoStyle() {
      let topbar = document.querySelector('.__tb')

      if (this.$route.fullPath != '/') {
        if (topbar) {
          let padding_top = topbar.offsetHeight

          this.style = `padding-top: ${padding_top}px`
        }
      } else {
        this.style = 'padding-top: 0px'
      }
    },
    websiteChecker() {
      let ls = new SecureLS()

      if (!ls.get('_compliance_')) {
        this.toggle.compliance = true
      } else {
        if (ls.get('_compliance_expiration_')) {
          let agreed_date = this.$moment(ls.get('_compliance_expiration_')).add(7, 'days'),
            expiration_date = this.$moment()
          if (agreed_date.diff(expiration_date) <= 0) {
            ls.remove('_compliance_')
            ls.remove('_compliance_expiration_')
            this.toggle.compliance = true
          }
        }
      }
    }
  },
  mounted() {
    document.addEventListener('contextmenu', event => event.preventDefault())
    window.addEventListener('load', this.onResize)
    window.addEventListener('resize', this.onResize)

    setTimeout(() => {
      this.onResize()
      this.autoStyle()
      this.websiteChecker()
    }, 500)
  },
  destroyed() {
    window.removeEventListener('load', this.onResize)
    window.removeEventListener('resize', this.onResize)
  },
  head() {
    return {
      title: 'Bilos Exam | Calendar'
    }
  }
}
</script>

<style lang="stylus">
  :root
    --theme_white: #FFF
    --theme_white_v2: #F6F6F6
    --theme_white_v3: #FFFCF6
    --theme_white_v4: #F3EEE7
    --theme_black: #1E1E1E
    --theme_black_v2: #575757
    --theme_black_v3: #111
    --theme_gray: #7E7E7E
    --theme_gray_v2: #D5D3D3
    --theme_gray_v3: #F8F8F8
    --theme_primary: #f69331
    --theme_secondary: #02afa0
    --theme_dark_secondary: #1E9188
    --theme_success: #48F3A9
    --theme_warning: #ffc800
    --theme_error: #D13744
    --theme_info: #438EFF
    --dm_sans: 'DM Sans'
    --playfair: 'Playfair Display'
    --reg: 400
    --med: 500
    --semi: 600
    --bold: 700

  #__db
    transition: .3s cubic-bezier(.17,.67,.17,1)

  html
    background-color: #FFF
    -webkit-text-size-adjust: none
    -webkit-font-smoothing: subpixel-antialiased
    backface-visibility: hidden
    font-family: 'DM Sans', 'Playfair Display', sans-serif

  *,
  *:before,
  *:after
    user-select: none
    box-sizing: border-box
    margin: 0
    word-break: break-word !important

  body
    display: none
    font-size: 16px

  @media screen and (min-width: 320px)
    body
      display: unset
      .container
        display: block
        box-sizing: inherit
        width: 100%
        padding-right: calc(1.5rem * .5)
        padding-left: calc(1.5rem * .5)
        margin-right: auto
        margin-left: auto
      .row
        display: flex
        flex-wrap: wrap
        margin-top: 0
        margin-right: calc(-.5 * 1.5rem)
        margin-left: calc(-.5 * 1.5rem)
        &>*
          flex-shrink: 0
          width: 100%
          max-width: 100%
          padding-right: calc(1.5rem * .5)
          padding-left: calc(1.5rem * .5)
          margin-top: 0
        .col
          flex: 1 0 0%;
  @media screen and (min-width: 375px)
    body
      display: unset
  @media screen and (min-width: 425px)
    body
      display: unset
  @media screen and (min-width: 768px)
    body
      .container
        max-width: 720px
  @media screen and (min-width: 1024px)
    body
      .container
        max-width: 720px
  @media screen and (min-width: 1024px)
    body
      .container
        max-width: 1320px      
</style>
