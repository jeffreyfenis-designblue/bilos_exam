<template>
  <div :class="attr['event-calendar']">
    <div :class="attr['event-calendar__wrapper']">
      <div :class="attr['event-calendar__table-wrapper']">
        <nav :class="attr['event-calendar__table-nav']">
          <div>
            <h3>{{ currentMonth.concat(' ', currentYear) }}</h3>
            <div class="col-auto">
              <div :class="attr['event-calendar__buttons']">
                <button :class="attr['event-calendar__button-prev']">&#8249;</button>
                <button :class="attr['event-calendar__button-next']">&#8250;</button>
              </div>
            </div>
          </div>
        </nav>
        <table :class="attr['event-calendar__table-grid']">
          <thead>
            <tr>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>                                                            
          </tbody>
        </table>
      </div>
      <div :class="attr['event-calendar__form-wrapper']">
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
        default() {
          return {}
        }
      }
    },
    data: () => ({
      today: '',
      currentYear: '',
      currentMonth: '',
      currentDay: '',
      currentDate: '',
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
    async mounted() {
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