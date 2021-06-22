<script>

    import {Helpers} from "../../helpers/Helpers";
    import {ShowCreateUserEventStore} from "../../stores/ShowCreateUserEventStore";

    export let currentDay;

    function displayCreateUserEventModal(){
        ShowCreateUserEventStore.update(m => {
            m.shown = true;
            m.startDate = new Date(currentDay.getFullYear(), currentDay.getMonth(), currentDay.getDate(),0,0);
            m.endDate = new Date(currentDay.getFullYear(), currentDay.getMonth(), currentDay.getDate(),23,59);
            return m;
        })
    }

</script>

<style>
    .day {
        width:20vw;
        height: 150px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
        border-right: solid 1px lightgray;
        border-bottom: solid 1px lightgray;
    }

    .day-title {
        text-align: center;
        vertical-align: center;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center
    }

    .today-mark {
        background-color: cornflowerblue;
        border-radius: 25px;
        height: 15px;
        width: 15px;
        margin-left: 5px;
    }
</style>

<div class="day" on:dblclick={displayCreateUserEventModal}>
    <div class="day-title">{`${Helpers.getShortDayOfWeekLabel(currentDay)} ${currentDay.getDate()} `} {#if currentDay.getDate() === new Date().getDate() &&
    currentDay.getMonth() === new Date().getMonth() &&
    currentDay.getFullYear() === new Date().getFullYear()}<div class="today-mark"></div>{/if}</div>
</div>
