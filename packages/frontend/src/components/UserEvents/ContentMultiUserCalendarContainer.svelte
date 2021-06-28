<script lang="ts">
    import CalendarNavBar from "./CalendarNavBar.svelte";
    import {UserEventsStore} from "../../stores/UserEventsStore";
    import {Helpers} from "../../helpers/Helpers";
    import CreateUserEventModal from "./CreateUserEventModal.svelte";
    import UpdateUserEventModal from "./UpdateUserEventModal.svelte";

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

</style>

<main class="userevents-panel">
    <CalendarNavBar on:dateChanged={(event)=> {
        startDate = event.detail.startDate;
        endDate = event.detail.endDate;
    }}></CalendarNavBar>
    <div class="container">
        {#each properties.userNames as login}

        {/each}
    </div>
</main>
