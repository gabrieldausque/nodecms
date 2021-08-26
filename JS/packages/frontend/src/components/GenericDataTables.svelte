<script lang="ts">

    import {onMount} from "svelte";
    import {fade} from "svelte/transition";
    import {observableGenericDataStore} from "../stores/ObservableGenericDataStore";
    import {Helpers} from "../helpers/Helpers";
    import {ModalStore, FooterAction} from "../stores/ModalStore";
    import {getBackendClient} from "@nodecms/backend-client";
    import {leftPanelContext, PanelContext} from "../stores/PanelStores";
    import {ComponentMetadata} from "../helpers/ComponentMetadata";
    import {MenuAction} from "../helpers/MenuAction";

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
            const services = await getBackendClient();
            const dataService = services.getDataService(dataType);
            const initialData = await dataService.find()
            let hasNext = false;
            if(Array.isArray(initialData) && initialData.length > 0){
                if(Helpers.isDescending(dataType)){
                    const nextData = await dataService.find({
                        lastIndex: initialData[0].id
                    });
                    hasNext = Array.isArray(nextData) && nextData.length > 0;
                } else {
                    const nextData = await dataService.find({
                        lastIndex: initialData[initialData.length - 1].id
                    });
                    hasNext = Array.isArray(nextData) && nextData.length > 0;
                }
            }
            observableGenericDataStore.update(ogds => {
                ogds.data = initialData;
                ogds.hasNext = hasNext;
                return ogds;
            })
            resolve(undefined);
        })
        p.catch(console.error);
        leftPanelContext.update((pc:PanelContext) => {
            pc.clearComponents();
            const menuComponentMetadata = new ComponentMetadata('action-menu', {
                actions: [
                    new MenuAction(`Créer ${dataType}`, async() => {
                        ModalStore.update(ms => {
                            ms.title = 'Creation'
                            ms.close = false;
                            ms.bodyControlType = dataType;
                            ms.bodyControlProperties = {}
                            const saveAction = new FooterAction();
                            saveAction.label = 'Enregistrer';
                            saveAction.cssClasses = ['btn-secondary'];
                            saveAction.action = async (event) => {
                                const services = await getBackendClient();
                                const dataService = services.getDataService(dataType);
                                try{
                                    await dataService.create(ms.bodyControlProperties);
                                    ModalStore.update(ms => {
                                        ms.title = '';
                                        ms.bodyControlType = '';
                                        ms.actions = [];
                                        ms.bodyControlProperties = undefined
                                        ms.close = true;
                                        ms.lastActionError = undefined;
                                        return ms;
                                    })
                                }catch(error){
                                    console.log(error);
                                    ModalStore.update(ms => {
                                        ms.lastActionError = error;
                                        return ms;
                                    })
                                }
                            }
                            const cancelAction = new FooterAction();
                            cancelAction.label = 'Annuler';
                            cancelAction.cssClasses = ['btn-danger'];
                            cancelAction.action = async (event) => {
                                ModalStore.update(ms => {
                                    ms.title = '';
                                    ms.bodyControlType = '';
                                    ms.actions = [];
                                    ms.bodyControlProperties = undefined
                                    ms.close = true;
                                    ms.lastActionError = undefined;
                                    return ms;
                                })
                            }
                            ms.actions = [
                                saveAction,
                                cancelAction
                            ]
                            return ms;
                        })
                    })
                ]
            });
            pc.addComponent(menuComponentMetadata)
            return pc;
        })
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
                                                ms.bodyControlType = dataType;
                                                ms.bodyControlProperties = entity
                                                const saveAction = new FooterAction();
                                                saveAction.label = 'Enregistrer';
                                                saveAction.cssClasses = ['btn-secondary'];
                                                saveAction.action = async (event) => {
                                                    const services = await getBackendClient();
                                                    const dataService = services.getDataService(dataType);
                                                    try{
                                                        await dataService.update(entity);
                                                        ModalStore.update(ms => {
                                                            ms.title = '';
                                                            ms.bodyControlType = '';
                                                            ms.actions = [];
                                                            ms.bodyControlProperties = undefined
                                                            ms.close = true;
                                                            ms.lastActionError = undefined;
                                                            return ms;
                                                        })
                                                    }catch(error){
                                                        console.log(error);
                                                        ModalStore.update(ms => {
                                                            ms.lastActionError = error;
                                                            return ms;
                                                        })
                                                    }
                                                }
                                                const cancelAction = new FooterAction();
                                                cancelAction.label = 'Annuler';
                                                cancelAction.cssClasses = ['btn-danger'];
                                                cancelAction.action = async (event) => {
                                                    ModalStore.update(ms => {
                                                        ms.title = '';
                                                        ms.bodyControlType = '';
                                                        ms.actions = [];
                                                        ms.bodyControlProperties = undefined
                                                        ms.close = true;
                                                        ms.lastActionError = undefined;
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
                <button type="button" class="btn btn-danger">Afficher les {Helpers.getInterfaceLabel(dataType)} suivants</button>
            </div>
        {/if}
    </div>
</div>
