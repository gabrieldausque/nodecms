<script lang="ts">
    import CalendarNavBar from "./CalendarNavBar.svelte";
    import {UserEventsStore} from "../../stores/UserEventsStore";
    import {Helpers} from "../../helpers/Helpers";
    import CreateUserEventModal from "./CreateUserEventModal.svelte";
    import UpdateUserEventModal from "./UpdateUserEventModal.svelte";
    import ContentUserCalendarContainer from "./ContentUserCalendarContainer.svelte";

    export let properties: {
        userNames: string[]
    }

    let days = [];
    let today = new Date()
    let startDate = new Date(today.getFullYear(), today.getMonth(), 1, 0, 0, 0);
    let endDate = new Date(today.getFullYear(), today.getMonth() + 1, 0, 23, 59, 59);

    const unsubscribeUserEventsStore = UserEventsStore.subscribe(() => {
        fillDays(startDate, endDate);
    })

    function fillDays(startDate: Date, endDate: Date) {
        days = Helpers.getAllDaysBetween(startDate, endDate);
    }

</script>

<style>
    .calendars {
        height: 100%;
        width: 100%;
        margin-left: 0;
        margin-right: 0;
        background: white;
        max-width: 100%;
        position: relative;
    }

    .calendar-row {
        display: flex;
        flex-direction: row;
        min-width: 100%;
        justify-content: space-between;
        min-height: 124px;
    }

    :global(.calendar-col .userevents-calendar) {
        flex-wrap: nowrap !important;
        overflow-x: auto;
    }
</style>

<main class="userevents-panel">
    <CalendarNavBar on:dateChanged={(event)=> {
        startDate = event.detail.startDate;
        endDate = event.detail.endDate;
    }}></CalendarNavBar>
    <div class="calendars">
        {#each properties.userNames as login}
            <div class="calendar-row">
                <div class="user-col">
                    {login}
                </div>
                <div class="calendar-col">
                    <ContentUserCalendarContainer days={days} login={login}></ContentUserCalendarContainer>
                </div>
            </div>
        {/each}
    </div>
</main>
