<template>
  <div :id="attr.error" :class="(error.statusCode == 42069) ? attr.coming_soon : ''" v-if="loaded">
    <div :class="attr.wrapper">
      <template v-if="error.statusCode == 42069">
        <img src="/logo.svg" />
      </template>
      <h1 :class="attr.title">{{ label.title }}</h1>
      <h2 :class="attr.subtitle">{{ label.subtitle }}</h2>
      <template v-if="label.button">
        <button-template
          :label="label.button.label"
          :link="label.button.link"
          :template="'template_2'"
        />
      </template>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['error'],
    layout: 'default',
    data: () => ({
      loaded: false,
      page_title: 'Designblue Manila | Home',
      label: {
        title: '',
        subtitle: '',
        button: {
          label: '',
          link: ''
        }
      }
    }),
    methods: {
      initialization () {
        switch (this.error.statusCode) {
          case 404:
            this.page_title = 'Designblue Manila | Page Not Found'
            this.label = {
              title: 'Error 404',
              subtitle: 'The page you are trying to visit does not exist.',
              button: {
                label: 'Back to Home',
                link: '/'
              }
            }
            break
          case 42069:
            this.page_title = 'Designblue Manila | Coming Soon'
            this.label = {
              title: 'Coming Soon',
              subtitle: 'We are going to launch this page very soon. Stay Tune!',
              button: null
            }
            break
          case 403:
            this.page_title = 'Designblue Manila | Access Denied'
            this.label = {
              title: 'Error 403',
              subtitle: 'You don\'t have access to this page.',
              button: {
                label: 'Back to Home',
                link: '/'
              }
            }
            break
          case 401:
            this.page_title = 'Designblue Manila | Unauthorized'
            this.label = {
              title: 'Error 401',
              subtitle: 'Oops! Looks like your token has been expired!',
              button: {
                label: 'Re-login',
                link: '/login'
              }
            }
            break
          default:
            this.page_title = 'Designblue Manila | Something Went Wrong'
            this.label = {
              title: 'Oops!',
              subtitle: 'Something Went Wrong!',
              button: {
                label: 'Back to Home',
                link: '/'
              }
            }
            break
        }

        setTimeout( () => {
          this.loaded = true
          this.toggleModalStatus({ type: 'loader', status: false })
        }, 500)
      }
    },
    mounted () {
      this.initialization()
    },
    head () {
      return {
        title: this.page_title
      }
    }
  }
</script>

<style lang="stylus" module="attr">
  #error
    position: relative
    display: flex
    flex-flow: row wrap
    align-items: center
    justify-content: center
    width: 100%
    max-width: 1280px
    height: 900px
    padding: 10% 0
    margin: 0 auto
    text-align: center
    &.coming_soon
      max-width: 100%
      background-image: url('/coming-soon/banner.png')
      background-repeat: no-repeat
      background-size: cover
      background-position: center
      &::before
        content: ''
        position: absolute
        top: 0
        left: 0
        right: 0
        bottom: 0
        background-image: linear-gradient(180deg, #1E1E1E17 0%, #0A0A0AC2 49%, #000000 100%)
        z-index: 0
      .wrapper
        .title
          margin: 20px 0 10px
          font-family: var(--playfair)
        .title,
        .subtitle
          color: var(--theme_white)
        img
          width: 100%
          height: 250px
    .wrapper
      position: relative
      z-index: 1
      display: flex
      flex-flow: column wrap
      align-items: center
      justify-content: center
      .title
        font-weight: var(--bold)
        font-size: 75px
        color: var(--theme_secondary)
        text-transform: uppercase
        margin-bottom: 10px
      .subtitle
        width: 100%
        max-width: 300px
        margin: 0 auto
        font-size: 20px
        margin-bottom: 20px
        color: var(--theme_black)
  /**
   * Responsive */
  @media (max-width: 1280px) and (min-width: 1025px)
    #error
      max-width: 100%
      padding: 0 40px
      .wrapper
        .title
          font-size: 45px
  /**
   * 1024px - 280px */
  @media (max-width: 1024px) and (min-width: 280px)
    #error
      max-width: 100%
      padding: 0 20px
      .wrapper
        &.coming_soon
          img
            height: 200px
        .title
          font-size: 35px
        .subtitle
          font-size: 18px
</style>
