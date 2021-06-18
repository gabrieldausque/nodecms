<script>

    import {onMount, beforeUpdate} from 'svelte';
    import ContentDayContainer from "./ContentDayContainer.svelte";

    let today = new Date()
    let startDate = new Date(today.getFullYear(), today.getMonth(), 1);
    let endDate = new Date(today.getFullYear(), today.getMonth() + 1, 0);
    let days = [];

    days.push(startDate);
    while (days.length < endDate.getDate() - 1) {
        const nextDay = new Date(startDate.getFullYear(), startDate.getMonth(), startDate.getDate() + days.length);
        if (!days.find(d => d === nextDay.getTime()) && nextDay) {
            days.push(nextDay);
        }
    }
    days.push(endDate);

    onMount(() => {

    })

</script>

<style>
    .userevents-panel {
        background: white;
        display: flex;
        flex-direction: column;
        height: calc(100vh - 75px);
        align-items: center;
        overflow-y: auto;
    }

    .userevents-navbar {
        min-height: 60px;
        max-height: 60px;
        height:60px;
        width: 100%;
        border-bottom: solid 1px lightgray;
    }
    .userevents-calendar {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        width: 80vw;
    }
</style>

<main class="userevents-panel">
    <div class="userevents-navbar">

    </div>
    <div class="userevents-calendar">
        {#each days as day}
            <ContentDayContainer currentDay={day}></ContentDayContainer>
        {/each}
    </div>
</main>