<template>
  <div :class="attr['event-calendar']">
    <div :class="attr['event-calendar__wrapper']">
      <div :class="attr['event-calendar__table-wrapper']">
        <div :class="attr['event-calendar__table-nav']">
          <div :class="attr['event-calendar__table-nav-wrapper']">
            <h3 :class="attr['event-calendar__table-nav-title']">{{ currentMonth.concat(' ', currentYear) }}</h3>
            <nav id="event-calendar-navigation" :class="attr['table-nav-btn']">
              <button :class="attr['table-nav-btn-left']" data-dir="next">&#8249</button>
              <button :class="attr['table-nav-btn-right']" data-dir="prev">&#8250</button>
            </nav>
          </div>
        </div>
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
      today: new Date(),
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
      initDateTime() {
        this.currentMonth = this.listOfMonths[this.today.getMonth()]
        this.currentYear = this.today.getFullYear()
      },
      populateCalendarGrid(){
        console.log('asdfas')
      },
      initButtons() {
        document.querySelector('#event-calendar-navigation > [data-dir="prev"]')
          .addEventListener('click', () => {
            this.currentMonth.setMonth(this.today.getMonth() - 1)
            this.renderCalendar()
        });
        document.querySelector('#event-calendar-navigation > [data-dir="next"]')
          .addEventListener('click', () => {
            this.currentMonth.setMonth(this.today.getMonth() + 1)
            this.renderCalendar()
        });
      }
    },
    async mounted() {
      this.initDateTime()
      this.initButtons()
      this.populateCalendarGrid()
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
        position: relative
        padding: 0.75rem 1.25rem
        margin-bottom: 1rem
        border: 1px solid transparent
        border-radius: 0.25rem
        & ^[0]__table-nav
          position: relative
          padding: 0.75rem 1.25rem
          margin-bottom: 1rem
          border: 1px solid transparent
          border-radius: 0.25rem
          color: #383d41
          background-color: #e2e3e5
          border-color: #d6d8db
          & ^[0]__table-nav-wrapper
            box-sizing: border-box
            flex-wrap: wrap
            margin-right: -15px
            margin-left: -15px
            display: flex!important
            align-items: center!important
            & ^[0]__table-nav-title
              display: block
              box-sizing: border-box
              font-family: inherit
              font-weight: 500
              line-height: 1.2
              color: inherit
              font-size: 1.75rem
              position: relative
              width: 100%
              min-height: 1px
              padding-right: 15px
              padding-left: 15px  
              flex-basis: 0
              flex-grow: 1
              max-width: 100%
              margin: 0!important
            & ^[0]__table-nav-btn
              box-sizing: border-box
              min-height: 1px
              padding-right: 15px
              padding-left: 15px
              flex: 0 0 auto
              width: auto
              max-width: none
              display: inline-flex
              vertical-align: middle
              position: relative
              & ^[0]__table-nav-btn-left
                align-items: flex-start
                text-indent: 0px
                text-shadow: none
                letter-spacing: normal
                word-spacing: normal
                text-rendering: auto
                box-sizing: border-box
                margin: 0
                font-family: inherit
                overflow: visible
                text-transform: none
                transition: all .15s ease-in-out
                user-select: none
                border: 1px solid transparent
                display: inline-block
                font-weight: 400
                text-align: center
                white-space: nowrap
                vertical-align: middle
                color: #fff
                background-color: #6c757d
                border-color: #6c757d
                padding: 0.25rem 0.5rem
                font-size: .875rem
                line-height: 1.5
                border-radius: 0.2rem
                -webkit-appearance: button
                flex: 0 1 auto
                position: relative
                cursor: pointer




      & ^[0]__form-wrapper
        h4
          display: block
          margin: 0
          font-family: inherit
          font-weight: 500
          line-height: 1.2
          color: inherit
          font-size: 1.5rem
          text-align: center
</style>