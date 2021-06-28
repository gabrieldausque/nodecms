<script>
    import {Helpers} from "../../helpers/Helpers";
    import {createEventDispatcher} from 'svelte'

    const dispatch = createEventDispatcher();

    let today = new Date()
    let startDate = new Date(today.getFullYear(), today.getMonth(), 1, 0, 0, 0);
    let endDate = new Date(today.getFullYear(), today.getMonth() + 1, 0, 23, 59, 59);

    async function lookBackward() {
        startDate = new Date(startDate.getFullYear(), startDate.getMonth() - 1, 1, 0, 0, 0);
        endDate = new Date(startDate.getFullYear(), startDate.getMonth() + 1, 0, 23, 59, 59);
        dispatch('dateChanged', {
            startDate: startDate,
            endDate: endDate
        })
    }

    async function lookForward() {
        startDate = new Date(startDate.getFullYear(), startDate.getMonth() + 1, 1, 0, 0, 0);
        endDate = new Date(startDate.getFullYear(), startDate.getMonth() + 1, 0, 23, 59, 59);
        dispatch('dateChanged', {
            startDate: startDate,
            endDate: endDate
        })
    }



</script>

<style>
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

<div class="userevents-navbar">
    <div class="current-period">{`${Helpers.getLongLabelMonth(startDate)} ${(startDate).getFullYear()}`}</div>
    <div id="change-display-period">
        <button type="button" class="btn btn-secondary change-period-btn" on:click={lookBackward}><i class="fas fa-chevron-left"></i></button>
        <button type="button" class="btn btn-secondary change-period-btn" on:click={lookForward}><i class="fas fa-chevron-right"></i></button>
    </div>
</div>