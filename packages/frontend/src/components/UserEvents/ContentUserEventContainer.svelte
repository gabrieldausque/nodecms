<script lang="ts">

    import {UserEvent} from "@nodecms/backend-data";
    import {ShowUpdateUserEventStore} from "../../stores/ShowCreateUserEventStore";
    import {UserAvailabilityStatus, UserEventVisibility} from "@nodecms/backend-data";
    import {UserStore} from "../../stores/UserStore";

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
        display: flex;
        align-items: center;
        padding-left: 5px;
        overflow: hidden;
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

    .dotted {
        position: absolute;
        height:25px;
        width:4px;
    }

    .user-event-end-after {
        width: calc(100% - 16px);
    }

    .user-event-start-before {
        width: calc(100% - 16px);
        right:0;
    }

    .user-event-start.user-event-end-after {
        width: calc(100% - 46px);
    }

    .user-event-end.user-event-start-before {
        width: calc(100% - 46px);
    }

</style>

{#if day.getMonth() !== userEvent.startDate.getMonth() && day.getDate() === 1}
    <div class="dotted" style="{
userEvent.ownerAvailabilityStatus === UserAvailabilityStatus.busy?
`background: ${userEvent.color}`:
`border : solid 1px ${userEvent.color}`
}; top: {(index * 25) + (index * 1)}px; left:0;"></div>
    <div class="dotted" style="{
userEvent.ownerAvailabilityStatus === UserAvailabilityStatus.busy?
`background: ${userEvent.color}`:
`border : solid 1px ${userEvent.color}`
}; top: {(index * 25) + (index * 1)}px; left:8px;"></div>
{/if}
<div class="user-event-container" style="{
userEvent.ownerAvailabilityStatus === UserAvailabilityStatus.busy?
`background: ${userEvent.color}`:
`border : solid 1px ${userEvent.color}; color: ${userEvent.color}`
}; top: {(index * 25) + (index * 1)}px;"
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
        {#if userEvent.ownerId !== $UserStore.id && userEvent.visibility === UserEventVisibility.private}
            <span><i class="fas fa-eye-slash"></i></span>
        {:else}
            <span style="font-size: 1vw">{userEvent.label}</span>
        {/if}
    {/if}
</div>
{#if day.getMonth() !== userEvent.endDate.getMonth() && day.getDate() >= (new Date(day.getFullYear(), day.getMonth() + 1, 0)).getDate()}
    <div class="dotted" style="{
userEvent.ownerAvailabilityStatus === UserAvailabilityStatus.busy?
`background: ${userEvent.color}`:
`border : solid 1px ${userEvent.color}`
}; top: {(index * 25) + (index * 1)}px; left:calc(100% - 12px);"></div>
    <div class="dotted" style="{
userEvent.ownerAvailabilityStatus === UserAvailabilityStatus.busy?
`background: ${userEvent.color}`:
`border : solid 1px ${userEvent.color}`
}; top: {(index * 25) + (index * 1)}px; left:calc(100% - 4px);"></div>
{/if}