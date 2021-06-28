<script lang="ts">
    import ContentDayContainer from "./ContentDayContainer.svelte";
    export let days:Date[];
    export let login:string;

</script>

<style>
    .userevents-calendar {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        width: calc(80vw + 1px);
        border-left: solid 1px lightgray;
        margin-bottom: 5px;
        z-index: 2;
    }
</style>

<div class="userevents-calendar">
    {#each days as day}
        <ContentDayContainer currentDay={day} login={login}></ContentDayContainer>
    {/each}
</div>