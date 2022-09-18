<template>
  <div id="evtCalendarWidget" :class="attr['event-calendar']">
    <div :class="attr['event-calendar__wrapper']">
      <div :class="attr['groupbox']">
        <div :class="attr['box']">
          <div :class="attr['calendar-header']">
            <div :class="attr['calendar-header__wrapper']">
              <h2 :class="attr['calendar-header__title']"> {{ currentYear }}</h2>
              <div :class="attr['calendar-header__btngroup']">
                <button id="evtMonthPrev">&#8249;</button>
                <button id="evtMonthNow">&#8226;</button>
                <button id="evtMonthNext">&#8250;</button>
              </div>
            </div>
          </div>
          <div :class="attr['calendar-grid']">
            <table id="calendar-grid">
              <thead>
                <tr>
                  <th>S</th>
                  <th>M</th>
                  <th>T</th>
                  <th>W</th>
                  <th>Th</th>
                  <th>F</th>
                  <th>S</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <!-- <p>8</p>
                    <span>Notes Here</span> -->
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td>
                    <!-- <p>8</p>
                    <span>Notes Here</span> -->
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td>
                    <!-- <p>8</p>
                    <span>Notes Here</span> -->
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td>
                    <!-- <p>8</p>
                    <span>Notes Here</span> -->
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td>
                    <!-- <p>8</p>
                    <span>Notes Here</span> -->
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td>
                    <!-- <p>8</p>
                    <span>Notes Here</span> -->
                  </td>
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
        </div>
        <div :class="attr['box']">
          <div :class="attr['form-header']">
            <div :class="attr['form-header__wrapper']">
              <button :class="attr['form-header__btn']">&#8249;</button>
              <h4 :class="attr['form-header__title']">Create Event</h4>
            </div>
          </div>

          <form :class="attr['form-main']">
            <div :class="attr['form-main__wrapper']">
              <label>Event Title</label>
              <input type="text" name="evt-title" placeholder="Event Title">
            </div>
            <div :class="attr['form-main__wrapper']">
              <label>Event Description</label>
              <input type="text" name="evt-description" placeholder="Event Description">
            </div>
            <div :class="attr['form-main__wrapper-row']">
              <div :class="attr['form-main__wrapper-col']">
                <label for="evt-date-from">Date From</label>
                <input id="evt-date-from" type="date" name="bevt-date-from">
              </div>
              <div :class="attr['form-main__wrapper-col']">
                <label for="bevt-date-to">Date To</label>
                <input id="bevt-date-to" type="date" name="bevt-date-to">
              </div>
            </div>
            <div :class="attr['form-main__wrapper-row']">
              <div :class="attr['form-main__wrapper-col']">
                <button>Add</button>
              </div>
              <div :class="attr['form-main__wrapper-col']">
                <button disabled="disabled">Override</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: {
      option: {
        type: Object / Array,
        default() {
          return {
            lang: 'en',
            calendarOnly: false,
          }
        }
      }
    },
    data: () => ({
      calendarId: null,
      monthOffset: 0,
      currentYear: '1970',
      currentMonth: 0,
      currentDay: 0,
      currentDate: 1,
      listOfDays: {
        'en': [
          'S',
          'M',
          'T',
          'W',
          'Th',
          'F',
          'S'
        ]
      },
      listOfMonths: {
      'en': [
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
      }
    }),
    methods: {
      initCalendarGrid(){
        // this.calendarId = 'evtcalendar-'.concat((Math.random() + 1).toString(36).substring(7))
        // document.getElementById('evtcalendar').setAttribute('id', this.calendarId);
        const currentUserDate = new Date()
        if (this.monthOffset !== 0) {
          currentUserDate.setMonth(new Date().getMonth() + this.monthOffset)
        }
        this.currentYear = currentUserDate.getFullYear()
        this.currentMonth = currentUserDate.getMonth()
        this.currentDay = currentUserDate.getDay()
        this.currentDate = currentUserDate.getDate()

        let calendarArray = [
          [null, null, null, null, null, null, null],
          [null, null, null, null, null, null, null],
          [null, null, null, null, null, null, null],
          [null, null, null, null, null, null, null],
          [null, null, null, null, null, null, null],
          [null, null, null, null, null, null, null],
        ]

        let firstDayOfMonth = new Date(this.currentYear, this.currentMonth, 1).getDay()
        let lastDayOfMonth = new Date(this.currentYear, this.currentMonth + 1, 0).getDay()
        let daysInMonth = new Date(this.currentYear, this.currentMonth + 1, 0).getDate()
        
        // get the padding days from previous months
        currentUserDate.setMonth(new Date().getMonth() - 1)
        let daysInPrevMonth = new Date(this.currentYear, this.currentMonth, 0).getDate()
        
        // plot this into array
        let gridday = 1;
        for (let row = 0; row < 6; row++) {
          for(let col = 0; col < 7; col++){
            if(row === 0){
              if(col >= firstDayOfMonth)
              {
                calendarArray[row][col] = gridday++
              }
              else
              {
                calendarArray[row][col] = daysInPrevMonth - (firstDayOfMonth - 1) + col
              }
            }
            else {
              if(gridday > daysInMonth)
              {
                gridday = 1
              }
              calendarArray[row][col] = gridday++;
            }
          }
        }

        //populate the calendar grid
        const table = document.getElementById('calendar-grid')
        for (let i = 1; i < table.rows.length; i++) {
          for (let j = 0; j < table.rows[i].cells.length; j++) {
            table.rows[i].cells[j].innerHTML = (typeof calendarArray[i - 1][j] === 'undefined') ?
              null : `<p>` + calendarArray[i - 1][j] + `</p>`;
          }
        }


      },
      initButtons(){
        document.getElementById('evtMonthPrev').addEventListener('click', () => {
          this.monthOffset--;
          this.initCalendarGrid();
        });
        document.getElementById('evtMonthNow').addEventListener('click', () => {
          this.monthOffset = 0;
          this.initCalendarGrid();
        });
        document.getElementById('evtMonthNext').addEventListener('click', () => {
          this.monthOffset++;
          this.initCalendarGrid();
        });
      }
    },
    async mounted() {
      this.initCalendarGrid()
      this.initButtons()
    },
  }
</script>

<style lang="stylus" module="attr">
  .event-calendar
    flex-direction: column
    min-width: 0
    word-wrap: break-word
    background-color: #fff
    background-clip: border-box
    border: 1px solid rgba(0,0,0,.125)
    border-radius: 0.25rem
    display: flex
    position: relative
    margin: 3rem 0
    &__wrapper
      display: block
      flex: 1 1 auto
      padding: 1.25rem
  .calendar-header
    display: block
    position: relative
    padding: 0.75rem 1.25rem
    margin-bottom: 1rem
    border: 1px solid transparent
    border-radius: 0.25rem
    color: #383d41
    background-color: #e2e3e5
    border-color: #d6d8db
    &__wrapper
      flex-wrap: wrap
      margin-right: -15px
      margin-left: -15px
      display: flex!important
      align-items: center!important
      & ^[0]__title
        display: block
        font-weight: 500
        line-height: 1.2
        font-size: 1.25rem
        position: relative
        width: 100%
        min-height: 1px
        padding-right: 15px
        padding-left: 15px
        flex-grow: 1
        max-width: 100%
        flex-basis: 0
        margin: 0
      & ^[0]__btngroup
        min-height: 1px
        padding-right: 15px
        padding-left: 15px
        flex: 0 0 auto
        width: auto
        max-width: none
        display: inline-flex
        vertical-align: middle
        position: relative
        button
          color: #fff
          background-color: #6c757d
          border-color: #6c757d
          border-radius: 0
          &:active
            color: #fff
            background-color: #545b62
            border-color: #4e555b
          &:hover
            color: #fff
            background-color: #5a6268
            border-color: #545b62
          &:first-child
            border-top-left-radius: 0.2rem
            border-bottom-left-radius: 0.2rem
          &:last-child
            border-top-right-radius: 0.2rem
            border-bottom-right-radius: 0.2rem
  .calendar-grid
    display: block
    width: 100%
    overflow-x: auto
    margin-bottom: 1.5rem
    table
      text-indent: initial
      border-spacing: 2px
      display: table
      border-collapse: collapse
      width: 100%
      margin-bottom: 1rem
      background-color: transparent
      border: 0
      thead
        display: table-header-group
        vertical-align: middle
        border-color: inherit
        tr
          display: table-row
          vertical-align: inherit
          border-color: inherit
          th
            font-weight: bold
            display: table-cell
            text-align: center
            padding: 0.75rem
            border: 1px solid #dee2e6
            vertical-align: bottom
            border-bottom: 2px solid #dee2e6
            border-bottom-width: 2px
            white-space: nowrap
            &:first-child
              color: #dc3545
      tbody
        display: table-row-group
        vertical-align: middle
        border-color: inherit
        tr
          display: table-row
          vertical-align: inherit
          border-color: inherit
          td
            display: table-cell
            text-align: center
            padding: 0.75rem
            vertical-align: top
            border: 1px solid #dee2e6
            &:first-child
              color: #dc3545
            span
              display: block
              padding: 0.25em 0.4em
              margin: 0.25rem
              font-size: 75%
              font-weight: 700
              line-height: 1
              text-align: center
              white-space: nowrap
              vertical-align: baseline
              border-radius: 0.25rem
              color: #fff
              background-color: #007bff
  .form-header
    flex-wrap: wrap
    margin-right: -15px
    margin-left: -15px
    display: flex
    &__wrapper
      display: block
      position: relative
      width: 100%
      min-height: 1px
      padding-right: 15px
      padding-left: 15px
      flex-grow: 1
      max-width: 100%
      flex-basis: 0
      & ^[0]__btn
        float: left
      & ^[0]__title
        display: block
        margin-top: 0
        font-family: inherit
        font-weight: 500
        line-height: 1.2
        color: inherit
        font-size: 1.5rem
        margin-bottom: 0.75rem
        text-align: center
  .form-main
    display: block
    margin-top: 0em
    &__wrapper
      display: block
      margin-bottom: 1rem
      label
        cursor: default
        display: inline-block
        margin-bottom: 0.5rem
      input[type="text"]
        cursor: text
        text-align: start
        text-transform: none
        text-indent: 0px
        text-shadow: none
        letter-spacing: normal
        word-spacing: normal
        text-rendering: auto
        margin: 0
        font-family: inherit
        overflow: visible
        display: block
        width: 100%
        height: calc(2.25rem + 2px)
        padding: 0.375rem 0.75rem
        font-size: 1rem
        line-height: 1.5
        color: #495057
        background-color: #fff
        background-clip: padding-box
        border: 1px solid #ced4da
        border-radius: 0.25rem
        transition: all .15s ease-in-out
    &__wrapper-row
      flex-wrap: wrap
      margin-right: -5px
      margin-left: -5px
      display: flex
    &__wrapper-col
      display: block
      position: relative
      width: 100%
      min-height: 1px
      flex-grow: 1
      max-width: 100%
      flex-basis: 0
      margin-bottom: 1rem
      padding-right: 5px
      padding-left: 5px
    &__wrapper-col label
      cursor: default
      display: inline-block
      margin-bottom: 0.5rem
    &__wrapper-col input[type="date"]
      cursor: text
      text-align: start
      text-transform: none
      text-indent: 0px
      text-shadow: none
      letter-spacing: normal
      word-spacing: normal
      text-rendering: auto
      margin: 0
      font-family: inherit
      overflow: visible
      display: block
      width: 100%
      height: calc(2.25rem + 2px)
      padding: 0.375rem 0.75rem
      font-size: 1rem
      line-height: 1.5
      color: #495057
      background-color: #fff
      background-clip: padding-box
      border: 1px solid #ced4da
      border-radius: 0.25rem
      transition: all .15s ease-in-out
    &__wrapper-col button
      color: #fff
      background-color: #007bff
      border-color: #007bff
      display: block
      width: 100%
      &:hover
        background-color: #0069d9
        border-color: #0062cc
  button
    margin: 0
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
    padding: 0.25rem 0.5rem
    font-size: .875rem
    line-height: 1.5
    border-radius: 0.2rem
    -webkit-appearance: button
    flex: 0 1 auto
    position: relative
    cursor: pointer
  .groupbox
    flex-wrap: wrap
    margin-right: -15px
    margin-left: -15px
    display: flex
    .box
      display: block
      position: relative
      width: 100%
      min-height: 1px
      padding-right: 15px
      padding-left: 15px
      flex: 0 0 100%
      max-width: 100%
  @media (min-width: 1024px)
    .groupbox
      .box
        &:first-child
          flex: 0 0 66.66%
          max-width: 66.66%
        &:last-child
          flex: 0 0 33.33%
          max-width: 33.33%
</style>