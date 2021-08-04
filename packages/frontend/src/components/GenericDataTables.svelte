<script>

    import {onMount} from "svelte";
    import {fade} from "svelte/transition";
    import {observableGenericDataStore} from "../stores/ObservableGenericDataStore";
    import {Helpers} from "../helpers/Helpers";
    import {ModalStore, FooterAction} from "../stores/ModalStore";

    export let properties;

    let dataType = properties.dataType;
    let columns = [];
    let data = [];
    let title = properties.title?properties.title:Helpers.getInterfaceLabel(dataType);

    const unsubscribe = observableGenericDataStore.subscribe((ogd) => {
        data = ogd.data;
    })

    onMount(() => {
        console.log('Mounting ...');
        columns = Helpers.getDefaultFields(dataType);
        const p = new Promise(async(resolve) => {
            console.log('executing promise ....')
            const services = await getBackendClient();
            const dataService = services.getDataService(dataType);
            console.log(dataService);
            const initialData = await dataService.find()
            console.log(initialData);
            observableGenericDataStore.update(ogds => {
                ogds.data = initialData;
                return ogds;
            })
            resolve(undefined);
        })
        p.catch(console.error);
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
    <h1>{title}</h1>
    <div class="table-wrapper">
        <table id="data-table" class="data table table-striped table-fixed">
            <thead>
            <tr>
                {#each columns as column}
                    {#if column.visible}
                        <th scope="col">{column.label}</th>
                    {/if}
                {/each}
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            {#if Array.isArray(data)}
                {#each data as entity}
                    <tr data-document-id="{entity.id}" transition:fade>
                        {#each columns as column}
                            {#if column.visible}
                                <th scope="row">{entity[column.name]}</th>
                            {/if}
                        {/each}
                        <th scope="row">
                            {#if entity.isEditor}
                                <button data-id="{entity.id}"
                                        type="button"
                                        class="btn btn-secondary"
                                        title="Editer"
                                        on:click={
                                        () => {
                                            ModalStore.update(ms => {

                                                ms.title = 'Edition'
                                                ms.close = false;
                                                ms.bodyControlProperties = entity;

                                                const saveAction = new FooterAction();
                                                saveAction.label = 'Enregistrer';
                                                saveAction.cssClasses = ['btn-secondary'];
                                                saveAction.action = async (event) => {
                                                    const services = await getBackendClient();
                                                    const dataService = services.getDataService(dataType);
                                                    await dataService.update(entity);
                                                    ModalStore.update(ms => {
                                                        ms.close = true;
                                                        return ms;
                                                    })
                                                }
                                                const cancelAction = new FooterAction();
                                                cancelAction.label = 'Annuler';
                                                cancelAction.cssClasses = ['btn-danger'];
                                                cancelAction.action = async (event) => {
                                                    ModalStore.update(ms => {
                                                        ms.close = true;
                                                        return ms;
                                                    })
                                                }
                                                ms.actions = [
                                                    saveAction,
                                                    cancelAction
                                                ]

                                                return ms;
                                            })
                                        }}
                                ><i class="fas fa-edit"></i></button>
                            {/if}
                        </th>
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
