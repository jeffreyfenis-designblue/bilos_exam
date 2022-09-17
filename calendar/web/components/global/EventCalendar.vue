<template>
  <div :class="attr['event-calendar']">
    <div :class="attr['event-calendar__wrapper']">
      <div :class="attr['event-calendar__table']">

        <nav>
          <div class="row">
            <div class="col">
              <h5 :class="attr['event-calendar__header']">{{ currentMonth.concat(' ', currentYear) }}</h5>
            </div>
            <div class="col-auto">
              <div :class="attr['event-calendar__hbtn']">
                <button :class="attr['event-calendar__hbtn--prev']">&#8249;</button>
                <button :class="attr['event-calendar__hbtn--next']">&#8250;</button>
              </div>
            </div>
          </div>
        </nav>
        <table>

        </table>


      </div>
      <div :class="attr['event-calendar__form']">
        <h3>Add Event</h3>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: {
      params: {
        type: Object / Array,
        default: {}
      }
    },
    data: () => ({
      today: null,
      currentYear: null,
      currentMonth: null,
      currentDay: null,
      currentDate: null,
      listOfDays: [
        'Sunday',
        'Monday',
        'Tuesday',
        'Thursday',
        'Friday',
        'Saturday'
      ],
      listOfMonths: [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December'
      ]
    }),
    methods: {
      renderCalendar() {
        const dateNow = new Date()
        this.today = dateNow
        this.currentMonth = this.listOfMonths[dateNow.getMonth()]
        this.currentYear = dateNow.getFullYear()
      }
    },
    mounted() {
      this.renderCalendar()
    },
  }
</script>

<style lang="stylus" module="attr">
  .event-calendar
    margin: 3rem 0
    flex-direction: column
    min-width: 0
    word-wrap: break-word
    background-color: #fff
    background-clip: border-box
    border: 1px solid rgba(0,0,0,.125)
    border-radius: 0.25rem
    display: flex
    position: relative
    &__wrapper
      flex: 1 1 auto
      padding: 1.25rem
      & ^[0]__table-wrapper,
      & ^[0]__form-wrapper
        position: relative
        width: 100%
        min-height: 1px
        padding-right: 15px
        padding-left: 15px
      & ^[0]__table-wrapper
        nav
          position: relative
          padding: 0.75rem 1.25rem
          margin-bottom: 1rem
          border: 1px solid transparent
          border-radius: 0.25rem
      & ^[0]__form-wrapper
        h4
          display: block
          margin: 0
          font-family: inherit
          font-weight: 500
          line-height: 1.2
          color: inherit
          font-size: 1.5rem
          text-align: center!important
</style>