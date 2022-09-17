<template lang="html">
  <section :id="attr.compliance">
    <div :class="attr.wrapper">
      <p>This site uses cookies to store information in your computer.<br> By using our site, you accept the terms of our <a href="/privacy" target="_blank">Privacy Statement</a> pursuant to the Data Privacy Act of 2012.</p>
      <div :class="attr.action">
        <button-template
          :label="'OK, I Agree'"
          :button_type="'button'"
          :status="2"
          :minimal="true"
          @click.native="close()"
        />
      </div>
    </div>
  </section>
</template>

<script>
  import SecureLS from 'secure-ls'

  export default {
    methods: {
      close () {
        let ls = new SecureLS()

        ls.set('_compliance_', 1)
        ls.set('_compliance_expiration_', this.$moment())
        this.$parent.toggle.compliance = false
      }
    }
  }
</script>

<style lang="stylus" module="attr">
  #compliance
    position: fixed
    bottom: 20px
    left: 20px
    z-index: 1005
    width: 100%
    max-width: 500px
    border-radius: 5px
    background-color: rgba(0, 0, 0, .75)
    box-shadow: 0 3px 20px rgba(0, 0, 0, .65)
    .wrapper
      display: flex
      flex-flow: row wrap
      align-items: center
      justify-content: center
      text-align: center
      padding: 20px
      margin: 0 auto
      p
        flex: 0 0 100%
        font-family: var(--med)
        color: var(--theme_white)
        a
          color: var(--theme_primary)
          text-decoration: underline
          font-family: var(--bold)
      .action
        margin-top: 20px
  /**
   * 1280px - 768px */
  @media (max-width: 1280px) and (min-width: 768px)
    #compliance
      bottom: 20px
      left: 0
      right: 0
      max-width: 500px
      margin: 0 auto
  /**
   * 767px - 310px */
  @media (max-width: 767px) and (min-width: 280px)
    #compliance
      bottom: 60px
      left: 0
      right: 0
      max-width: 450px
      margin: 0 auto
      .wrapper
        text-align: center
        p
          flex: 0 0 100%
          font-size: 14px
    @media (max-width: 450px) and (min-width: 280px)
      #compliance
        max-width: calc(100% - 40px)
</style>
