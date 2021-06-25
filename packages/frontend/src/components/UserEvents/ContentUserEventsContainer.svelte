<script>

    import {onMount} from 'svelte';
    import ContentDayContainer from "./ContentDayContainer.svelte";
    import {Helpers} from "../../helpers/Helpers";
    import CreateUserEventModal from "./CreateUserEventModal.svelte";
    import {UserEventsStore} from "../../stores/UserEventsStore";
    import {UserStore} from "../../stores/UserStore";
    import ContentUserEventContainer from "./ContentUserEventContainer.svelte";

    let today = new Date()
    let startDate = new Date(today.getFullYear(), today.getMonth(), 1);
    let endDate = new Date(today.getFullYear(), today.getMonth() + 1, 0);
    let days = [];

    function fillDays() {
        const newDays = [];
        let row = [];
        newDays.push(row);
        for (let index = 0; index < endDate.getDate() - 1; index++) {
            row = row.length < 4 ? row : []
            if (row.length === 0)
                newDays.push(row);
            const nextDay = new Date(startDate.getFullYear(), startDate.getMonth(), startDate.getDate() + index);
            row.push(nextDay);
        }
        row.push(endDate);
        days = newDays;
        const updateEventsStore = new Promise(async (resolve) => {
            $UserEventsStore.startDate = startDate;
            $UserEventsStore.endDate = endDate;
            const services = getBackendClient();
            for (const login in $UserEventsStore.eventsByUser) {
                if ($UserEventsStore.eventsByUser.hasOwnProperty(login)) {
                    $UserEventsStore.eventsByUser[login] = await services.userService.findUserEvents(login, startDate, endDate);
                }
            }
            UserEventsStore.update(ues => {
                return ues
            })
            resolve();
        });
        updateEventsStore.then(() => {
        }).catch(console.error);
    }

    onMount(() => {
        fillDays();
    })

    function lookBackward() {
        startDate = new Date(startDate.getFullYear(), startDate.getMonth() - 1, 1);
        endDate = new Date(startDate.getFullYear(), startDate.getMonth() + 1, 0);
        fillDays();
    }

    function lookForward() {
        startDate = new Date(startDate.getFullYear(), startDate.getMonth() + 1, 1);
        endDate = new Date(startDate.getFullYear(), startDate.getMonth() + 1, 0);
        fillDays();
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
    <div class="userevents-calendar container">
        {#each days as row}
            <div class="row">
                {#each row as day}
                    <div class="col">
                        <ContentDayContainer currentDay={day} login={$UserStore.login}></ContentDayContainer>
                    </div>
                {/each}
            </div>
        {/each}
    </div>
</main>
<CreateUserEventModal></CreateUserEventModal>