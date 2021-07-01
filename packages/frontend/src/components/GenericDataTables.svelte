<script>

    import {onMount} from "svelte";
    import {fade} from "svelte/transition";
    import {observableGenericDataStore} from "../stores/ObservableGenericDataStore";
    import {Helpers} from "../helpers/Helpers";

    export let properties;

    let dataType = properties.dataType;
    let columns = [];
    let data = $observableGenericDataStore.data;

    const unsubscribe = observableGenericDataStore.subscribe((ogd) => {
        data = ogd.data;
    })

    onMount(async () => {
        columns = Helpers.getDefaultFields(dataType);
    })

</script>

<style>
    .data-list {
        flex-grow: 3;
        height:100%;
        max-height: 100%;
        min-height:100%;
        overflow: hidden;
        background: white;
    }

    .data {
        overflow-y: auto;
    }

    .btn.action {
        display: flex;
        align-items: center;
    }

    .btn.action span.spinner-border {
        margin-right:5px;
        display: none;
    }

    .btn.action span.spinner-border.show {
        margin-right:5px;
        display: block;
    }

    .table-wrapper {
        height: calc(100% - 56px);
        overflow-y: auto;
        overflow-x: hidden;
    }

    .next-documents-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<div class="data-list">
    <h1>Documents</h1>
    <div class="table-wrapper">
        <table id="data-table" class="data table table-striped table-fixed">
            <thead>
            <tr>
                <th scope="col">Id</th>
            </tr>
            </thead>
            <tbody>
            {#if Array.isArray(data)}
                {#each data as entity}
                    <tr data-document-id="{entity.id}" transition:fade>

                    </tr>
                {/each}
            {/if}
            </tbody>
        </table>
        {#if $observableGenericDataStore.hasNext}
            <div class="next-documents-wrapper">
                <button type="button" class="btn btn-danger">Afficher les data suivants</button>
            </div>
        {/if}
    </div>
</div>
