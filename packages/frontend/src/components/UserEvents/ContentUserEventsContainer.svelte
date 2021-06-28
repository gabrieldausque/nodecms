<script lang="ts">

    import {onMount, onDestroy} from 'svelte';
    import ContentDayContainer from "./ContentDayContainer.svelte";
    import CreateUserEventModal from "./CreateUserEventModal.svelte";
    import {UserEventsStore} from "../../stores/UserEventsStore";
    import {UserStore} from "../../stores/UserStore";
    import {ShowCreateUserEventStore, ShowUpdateUserEventStore} from "../../stores/ShowCreateUserEventStore";
    import UpdateUserEventModal from "./UpdateUserEventModal.svelte";
    import CalendarNavBar from './CalendarNavBar.svelte';
    import {getBackendClient} from "@nodecms/backend-client";
    import {Helpers} from "../../helpers/Helpers";

    let days = [];
    let today = new Date()
    let startDate = new Date(today.getFullYear(), today.getMonth(), 1, 0, 0, 0);
    let endDate = new Date(today.getFullYear(), today.getMonth() + 1, 0, 23, 59, 59);

    const unsubscribeUserEventsStore = UserEventsStore.subscribe(() => {
        fillDays(startDate, endDate);
    })

    const unsubscribeShowCreateModal = ShowCreateUserEventStore.subscribe(() => {
        loadEvents(startDate, endDate);
    })

    const unsubscribeShowUpdateModal = ShowUpdateUserEventStore.subscribe(() => {
        loadEvents(startDate, endDate);
    })

    function fillDays(startDate:Date, endDate:Date) {
        days = Helpers.getAllDaysBetween(startDate, endDate);
    }

    async function loadEvents(startDate:Date, endDate:Date) {
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

    onMount(async () => {
        await loadEvents(startDate, endDate);
    })


    onDestroy(() => {
        unsubscribeShowCreateModal();
        unsubscribeUserEventsStore();
    })

    $: {
        fillDays(startDate, endDate);
        loadEvents(startDate, endDate);
    }

</script>

<style>
    .userevents-panel {
        background: white;
        display: flex;
        flex-direction: column;
        height: calc(100vh - 71px);
        align-items: center;
        overflow-y: auto;
    }

</style>

<main class="userevents-panel">
    <CalendarNavBar on:dateChanged={(event)=> {
        startDate = event.detail.startDate;
        endDate = event.detail.endDate;
    }}></CalendarNavBar>
    <<div class="userevents-calendar">
        {#each days as day}
            <ContentDayContainer currentDay={day} login={$UserStore.login}></ContentDayContainer>
        {/each}
    </div>>
</main>
<CreateUserEventModal></CreateUserEventModal>
<UpdateUserEventModal></UpdateUserEventModal>