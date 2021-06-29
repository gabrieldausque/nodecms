<script lang="ts">
    import CalendarNavBar from "./CalendarNavBar.svelte";
    import {UserEventsStore} from "../../stores/UserEventsStore";
    import {Helpers} from "../../helpers/Helpers";
    import CreateUserEventModal from "./CreateUserEventModal.svelte";
    import UpdateUserEventModal from "./UpdateUserEventModal.svelte";
    import ContentUserCalendarContainer from "./ContentUserCalendarContainer.svelte";
    import {getBackendClient} from "@nodecms/backend-client";

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

    async function loadEvents(startDate: Date, endDate: Date) {
        $UserEventsStore.startDate = startDate;
        $UserEventsStore.endDate = endDate;
        const services = await getBackendClient();
        for (const login in $UserEventsStore.eventsByUser) {
            if ($UserEventsStore.eventsByUser.hasOwnProperty(login)) {
                $UserEventsStore.eventsByUser[login] = await services.userService.findUserEvents(login, startDate, endDate);
            }
        }
        UserEventsStore.update(ues => {
            return ues
        })
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
        overflow-x: auto;
    }

    .calendar-row {
        display: flex;
        flex-direction: row;
        min-width: 100%;
        justify-content: space-between;
        min-height: 124px;
        position: relative;
        height: 100%;
    }

    .calendar-col {
        margin-right: 20vw;
    }

    :global(.calendar-col .userevents-calendar) {
        flex-wrap: nowrap !important;
    }

    :global(.calendar-row .day) {
        min-width: 20vw;
    }

    .user-col {
        position: fixed;
        left: 0;
        display: flex;
        background: white;
        align-items: center;
        justify-content: center;
        min-height: 150px;
        width: 20vw;
        flex-grow: 1;
        z-index: 3;
        border-bottom: solid 1px lightgray;
        border-right: solid 1px lightgray;
    }


</style>

<main class="userevents-panel">
    <CalendarNavBar on:dateChanged={(event)=> {
        startDate = event.detail.startDate;
        endDate = event.detail.endDate;
        fillDays(startDate, endDate);
        loadEvents(startDate, endDate);
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
