<script lang="ts">

    import {UserEvent} from "@nodecms/backend-data";
    import {ShowUpdateUserEventStore} from "../../stores/ShowCreateUserEventStore";

    export let userEvent:UserEvent;
    export let day:Date;
    export let index:number;

    let isStart = userEvent.startDate.getFullYear() === day.getFullYear() &&
        userEvent.startDate.getMonth() === day.getMonth() &&
        userEvent.startDate.getDate() === day.getDate();
    let isEnd = userEvent.endDate.getFullYear() === day.getFullYear() &&
        userEvent.endDate.getMonth() === day.getMonth() &&
        userEvent.endDate.getDate() === day.getDate();

    $: {
        isStart = userEvent.startDate.getFullYear() === day.getFullYear() &&
            userEvent.startDate.getMonth() === day.getMonth() &&
            userEvent.startDate.getDate() === day.getDate();
        isEnd = userEvent.endDate.getFullYear() === day.getFullYear() &&
            userEvent.endDate.getMonth() === day.getMonth() &&
            userEvent.endDate.getDate() === day.getDate();
    }

</script>

<style>
    .user-event-container {
        width:100%;
        height: 25px;
        margin-bottom: 2px;
        position:absolute;
        color: white;
    }

    .user-event-container.user-event-start {
        margin-left: 30px;
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
        width: calc(100% - 30px);
    }

    .user-event-container.user-event-end {
        margin-right: 30px;
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
        width: calc(100% - 30px);
    }

    .user-event-container.user-event-one-day {
        margin-right:0 !important;
        margin-left:0 !important;
        width:100%;
    }
</style>

<div class="user-event-container" style="background: {userEvent.color}; top: {(index * 25) + (index * 1)}px;"
     class:user-event-end={isEnd}
     class:user-event-start={isStart}
     class:user-event-one-day={isStart && isEnd}
     class:user-event-start-before={day.getMonth() !== userEvent.startDate.getMonth() && day.getDate() === 1}
     class:user-event-end-after={day.getMonth() !== userEvent.endDate.getMonth() && day.getDate() >= (new Date(day.getFullYear(), day.getMonth() + 1, 0)).getDate()}
     on:dblclick={(event) => {
         event.stopPropagation();
         ShowUpdateUserEventStore.update(sues => {
             sues.shown = true;
             sues.userEvent = userEvent;
             return sues
         })
     }}
     title={`${userEvent.category} : ${userEvent.label} `}
>
    {#if isStart || day.getMonth() !== userEvent.startDate.getMonth() && day.getDate() === 1}
        {userEvent.label}
    {/if}
</div>