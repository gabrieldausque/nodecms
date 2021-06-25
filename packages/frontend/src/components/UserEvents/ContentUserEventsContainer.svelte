<script>

    import {onMount, onDestroy} from 'svelte';
    import ContentDayContainer from "./ContentDayContainer.svelte";
    import {Helpers} from "../../helpers/Helpers";
    import CreateUserEventModal from "./CreateUserEventModal.svelte";
    import {UserEventsStore} from "../../stores/UserEventsStore";
    import {UserStore} from "../../stores/UserStore";
    import {ShowCreateUserEventStore} from "../../stores/ShowCreateUserEventStore";

    let today = new Date()
    let startDate = new Date(today.getFullYear(), today.getMonth(), 1, 0,0,0);
    let endDate = new Date(today.getFullYear(), today.getMonth() + 1, 0,23,59,59);
    let days = [];

    const unsubscribeUserEventsStore = UserEventsStore.subscribe(() => {
        fillDays();
    })

    const unsubscribeShowCreateModal = ShowCreateUserEventStore.subscribe(() => {
        loadEvents();
    })

    function fillDays() {
        const newDays = [];
        newDays.push(startDate);
        while (newDays.length < endDate.getDate() - 1) {
            const nextDay = new Date(startDate.getFullYear(), startDate.getMonth(), startDate.getDate() + newDays.length);
            if (!newDays.find(d => d === nextDay.getTime()) && nextDay) {
                newDays.push(nextDay);
            }
        }
        newDays.push(endDate);
        days = newDays;
    }

    async function loadEvents() {
        console.log('updating')
        $UserEventsStore.startDate = startDate;
        $UserEventsStore.endDate = endDate;
        console.log($UserEventsStore);
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
        await loadEvents();
    })

    async function lookBackward() {
        startDate = new Date(startDate.getFullYear(), startDate.getMonth() - 1, 1,0,0,0);
        endDate = new Date(startDate.getFullYear(), startDate.getMonth() + 1, 0,23,59,59);
        fillDays();
        await loadEvents();
    }

    async function lookForward() {
        startDate = new Date(startDate.getFullYear(), startDate.getMonth() + 1, 1,0,0,0);
        endDate = new Date(startDate.getFullYear(), startDate.getMonth() + 1, 0,23,59,59);
        fillDays();
        await loadEvents();
    }

    onDestroy(() => {
        unsubscribeShowCreateModal();
        unsubscribeUserEventsStore();
    })

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

    .userevents-navbar {
        min-height: 60px;
        max-height: 60px;
        height:60px;
        width: 100%;
        border-bottom: solid 1px lightgray;
        display: flex;
        justify-content: center;
        align-items: center;
        position: sticky;
        top: 0;
        left: 0;
        background: white;
        z-index: 3;
    }

    .userevents-calendar {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        width: calc(80vw + 1px);
        border-left: solid 1px lightgray;
        margin-bottom: 5px;
        z-index: 2;
    }

    #change-display-period {
        margin-right: 5px;
        margin-left: auto;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .change-period-btn {
        margin-left: 5px;
        margin-bottom: 0;
    }

    .current-period {
        margin-left:auto;
        margin-right:0;

    }
</style>

<main class="userevents-panel">
    <div class="userevents-navbar">
        <div class="current-period">{`${Helpers.getLongLabelMonth(startDate)} ${(startDate).getFullYear()}`}</div>
        <div id="change-display-period">
            <button type="button" class="btn btn-secondary change-period-btn" on:click={lookBackward}><i class="fas fa-chevron-left"></i></button>
            <button type="button" class="btn btn-secondary change-period-btn" on:click={lookForward}><i class="fas fa-chevron-right"></i></button>
        </div>
    </div>
    <div class="userevents-calendar">
        {#each days as day}
            <ContentDayContainer currentDay={day} login={$UserStore.login}></ContentDayContainer>
        {/each}
    </div>
</main>
<CreateUserEventModal></CreateUserEventModal>