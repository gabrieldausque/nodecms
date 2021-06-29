<script lang="ts">
    import CalendarNavBar from "./CalendarNavBar.svelte";
    import {UserEventsStore} from "../../stores/UserEventsStore";
    import {Helpers} from "../../helpers/Helpers";
    import ContentUserCalendarContainer from "./ContentUserCalendarContainer.svelte";
    import {getBackendClient} from "@nodecms/backend-client";
    import {afterUpdate, onMount} from 'svelte';

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
        for (const login of properties.userNames) {
            $UserEventsStore.eventsByUser[login] = await services.userService.findUserEvents(login, startDate, endDate);
        }
        UserEventsStore.update(ues => {
            return ues
        })
    }

    async function loadEventsForLogin(login:string, startDate: Date, endDate: Date) {
        $UserEventsStore.startDate = startDate;
        $UserEventsStore.endDate = endDate;
        const services = await getBackendClient();
        $UserEventsStore.eventsByUser[login] = await services.userService.findUserEvents(login, startDate, endDate);
        UserEventsStore.update(ues => {
            return ues
        })
    }

    onMount(async () => {
        const services = await getBackendClient();
        await loadEvents(startDate, endDate);
        for(let login of properties.userNames){
            await services.userService.subscribeToUserEvents(login, async (m:any) => {
                await loadEventsForLogin(m.owner, startDate, endDate);
            })
        }
    })

    afterUpdate(() => {
        const userCols = document.querySelectorAll('.user-col');
        for(let u of userCols){
            u.style.height = `${u.parentElement.clientHeight}px`;
        }
    })

</script>

<style>

    .userevents-panel {
        height: calc(100vh - 72px);
    }

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
        overflow-x: hidden;
        width: 100%;
        margin-right: 0;
        margin-left: 0;
        display: flex;
        flex-direction: row;
    }

    .calendar-col {
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        border-right: solid 1px lightgray;
        border-bottom: solid 1px lightgray;
        width: 90%;
        margin-left: 10%;
        overflow: hidden;
        scrollbar-width: none;
    }

    .calendar-col::-webkit-scrollbar {
        display: none;
    }

    .calendar-col:focus {
        outline:none;
    }

    :global(.calendar-col .userevents-calendar) {
        flex-wrap: nowrap !important;
        margin-bottom: 0 !important;
        border-bottom: none !important;
        border-top: none !important;
        width:100% !important;
        flex-grow: 1;
    }

    :global(.calendar-row .day) {
        min-width: 12.5vw;
        border-top: none !important;
        border-bottom: none !important;
        border-right: solid 1px lightgray !important;
        border-left: none !important;

    }

    .user-col {
        width: 10%;
        position: fixed;
        background: white;
        min-height: 150px;
        z-index: 5;
        border-right: solid 1px lightgray;
        border-bottom: solid 1px lightgray;
        display: flex;
        justify-content: center;
        align-items: center;
    }

</style>

<main class="userevents-panel" on:keypress={(event) => {
                    console.log(event)
                }}>
    <CalendarNavBar on:dateChanged={(event)=> {
        startDate = event.detail.startDate;
        endDate = event.detail.endDate;
        fillDays(startDate, endDate);
        loadEvents(startDate, endDate);
    }}></CalendarNavBar>
    <div class="calendars">
        {#each properties.userNames as login}
            <div class="calendar-row" >
                <div class="user-col">
                    {login}
                </div>
                <div class="calendar-col" tabindex="0" on:keydown={(event) => {
                    const calendars = document.querySelectorAll('.calendar-col');
                    let movement = 0;
                    if(event.key === "ArrowRight")
                        movement = 50;
                    else if(event.key === "ArrowLeft")
                        movement = -50;
                    for(let c of calendars){
                        c.scrollLeft = c.scrollLeft + movement;
                    }
                }}>
                    <ContentUserCalendarContainer days={days} login={login}></ContentUserCalendarContainer>
                </div>
            </div>
        {/each}
    </div>
</main >
