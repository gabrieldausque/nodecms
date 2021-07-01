<script lang="ts">

    import {Helpers} from "../../helpers/Helpers";
    import {ShowCreateUserEventStore} from "../../stores/ShowCreateUserEventStore";
    import {UserEvents, UserEventsStore} from "../../stores/UserEventsStore";
    import {onDestroy} from 'svelte';
    import ContentUserEventContainer from "./ContentUserEventContainer.svelte";

    export let currentDay;
    export let login;

    let startDate = new Date(currentDay.getFullYear(), currentDay.getMonth(), currentDay.getDate(), 0,0,0);
    let endDate = new Date(currentDay.getFullYear(), currentDay.getMonth(), currentDay.getDate(), 23,59,59);
    let userEvents = [];

    const unsubscribe = UserEventsStore.subscribe( (ues:UserEvents) => {
        startDate = new Date(currentDay.getFullYear(), currentDay.getMonth(), currentDay.getDate(), 0,0,0);
        endDate = new Date(currentDay.getFullYear(), currentDay.getMonth(), currentDay.getDate(), 23,59,59);
        userEvents = ues.eventsByUser[login]?ues.eventsByUser[login].filter(ue =>
            ue.startDate.getTime() <= startDate.getTime() &&
            startDate.getTime() <= ue.endDate.getTime()):[];
    });

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
        min-height: calc(100% - 25px);
        position: relative;
        overflow-x: hidden;
        overflow-y: auto;
    }
</style>

<div class="day" on:dblclick={displayCreateUserEventModal}>
    <div class="day-title">{`${Helpers.getShortDayOfWeekLabel(currentDay)} ${currentDay.getDate()}`} {#if currentDay.getDate() === new Date().getDate() &&
    currentDay.getMonth() === new Date().getMonth() &&
    currentDay.getFullYear() === new Date().getFullYear()}<div class="today-mark"></div>{/if}</div>
    <div class="events-container" style="{Array.isArray(userEvents)?
        `height : ${$UserEventsStore.eventsByUser[login]?$UserEventsStore.eventsByUser[login].length * 26:1}px;`:
        ''}">
        {#if Array.isArray(userEvents)}
            {#each userEvents as userEvent}
                <ContentUserEventContainer userEvent={userEvent} day={currentDay} index={$UserEventsStore.eventsByUser[login].indexOf(userEvent)} ></ContentUserEventContainer>
            {/each}
        {/if}
    </div>

</div>
