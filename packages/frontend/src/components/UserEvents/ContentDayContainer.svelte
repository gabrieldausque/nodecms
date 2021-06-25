<script>

    import {Helpers} from "../../helpers/Helpers";
    import {ShowCreateUserEventStore} from "../../stores/ShowCreateUserEventStore";
    import {UserEventsStore} from "../../stores/UserEventsStore";
    import {onDestroy} from 'svelte';
    import ContentUserEventContainer from "./ContentUserEventContainer.svelte";

    export let currentDay;
    export let login;
    let userEvents = $UserEventsStore.eventsByUser[login];

    const unsubscribe = UserEventsStore.subscribe(ues => {
        userEvents = ues.eventsByUser[login]
    })

    function displayCreateUserEventModal() {
        ShowCreateUserEventStore.update(m => {
            m.shown = true;
            m.startDate = new Date(currentDay.getFullYear(), currentDay.getMonth(), currentDay.getDate(), 0, 0);
            m.endDate = new Date(currentDay.getFullYear(), currentDay.getMonth(), currentDay.getDate(), 23, 59);
            return m;
        })
    }


    onDestroy(() => {
        unsubscribe()
    })

</script>

<style>
    .day {
        width:20vw;
        min-height: 150px;
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

    .events-container {
        width: 100%;
        height: calc(100% - 25px);
        position: relative;
        overflow-x: hidden;
        overflow-y: auto;
    }
</style>

<div class="day" on:dblclick={displayCreateUserEventModal}>
    <div class="day-title">{`${Helpers.getShortDayOfWeekLabel(currentDay)} ${currentDay.getDate()} `} {#if currentDay.getDate() === new Date().getDate() &&
    currentDay.getMonth() === new Date().getMonth() &&
    currentDay.getFullYear() === new Date().getFullYear()}<div class="today-mark"></div>{/if}</div>
    <div class="events-container">
        {#if Array.isArray(userEvents)}
            {#each userEvents.filter(ue => ue.startDate.getTime() <= currentDay.getTime() && currentDay.getTime() <= ue.endDate.getTime()) as userEvent}
                <ContentUserEventContainer userEvent={userEvent} day={currentDay} index={userEvents.indexOf(userEvent)}></ContentUserEventContainer>
            {/each}
        {/if}
    </div>

</div>
