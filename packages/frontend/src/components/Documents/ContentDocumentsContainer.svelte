<script>

    import {observableGenericDataStore} from "../../stores/ObservableGenericDataStore";
    import {Helpers} from "../../helpers/Helpers";
    import {EditableDocumentStore} from "../../stores/EditableDocumentStore";
    import {getBackendClient} from "@nodecms/backend-client";
    import {onMount, afterUpdate, onDestroy} from 'svelte';
    import {documentsEventName} from "@nodecms/backend-client";
    import { fade } from 'svelte/transition';
    import {BlockEditorComponentStore} from "../../stores/BlockEditorComponentStore";

    let documents = $observableGenericDataStore.data;
    const unsubscribe = observableGenericDataStore.subscribe((ogd) => {
        documents = ogd.data;
    })

    async function displayDocument(event){
        await Helpers.displayDocument(event.currentTarget.getAttribute("data-document-key"))
    }

    async function editDocument(event) {
        const services = await getBackendClient();
        const documentKey = event.currentTarget.getAttribute("data-document-key")
        const documentContent = await services.documentService.getDocument(documentKey)
        BlockEditorComponentStore.update(becs => {
            becs.component = undefined;
            becs.zone = undefined;
            becs.layout = undefined;
            return becs;
        })
        EditableDocumentStore.update(eds => {
            eds.key = documentKey;
            eds.document = documentContent;
            return eds;
        })
        await Helpers.displayDocument("documentEditor");
    }

    function showCreateDocument(event) {
        jQuery('#CreateDocumentModal').modal('show');
    }

    async function onDocumentKeyChanged(event) {
        const services = await getBackendClient();
        const keyInput = document.getElementById('documentKey');
        if(!keyInput){
            keyInput.classList.add('is-invalid');
        } else {
            if(await services.documentService.exists(keyInput.value)) {
                keyInput.classList.remove('is-valid');
                keyInput.classList.add('is-invalid');
            } else {
                keyInput.classList.remove('is-invalid');
                keyInput.classList.add('is-valid')
            }
        }
    }

    onMount(() => {
        Helpers.subscribeToDocumentEvent(documentsEventName.documentsActions,
            async(documentActionEvent) =>{
                const services = await getBackendClient();
                const document = await services.documentService.getDocument(documentActionEvent.detail.document);
                observableGenericDataStore.update(ds => {
                    console.log("pushing to store");
                    ds.data.push(document);
                    return ds
                })
        })
    })

    afterUpdate(() => {
        const rows = Array.from(document.querySelectorAll('#documents-table tbody > tr'));;
        rows.sort((r1,r2) => {
            const r1Id = parseInt(r1.getAttribute('data-document-id'));
            const r2Id = parseInt(r2.getAttribute('data-document-id'));
            if(r1Id < r2Id)
                return 1;
            if(r1Id > r2Id)
                return -1;
            return 0;
        })
        const tableBody = document.querySelector('#documents-table tbody');
        for(const row of rows){
            row.remove();
            tableBody.append(row);
        }
    })

    onDestroy(() => {
        unsubscribe();
    })

    async function validateNewDocument() {
        const services = await getBackendClient();
        const key = document.getElementById('documentKey').value;
        return key && !(await services.documentService.exists(key));
    }

    async function createDocument(event) {
        const errorAlertContent = document.getElementById('errorOnCreatingDocumentContent');
        const errorAlert = document.getElementById('errorOnCreatingDocument');
        if(await validateNewDocument()) {
            try {
                const backendService = await getBackendClient();
                const data = {
                    key: document.getElementById('documentKey').value,
                    visibility: document.getElementById('documentVisibility').value,
                    content: {}
                }
                await backendService.documentService.createDocument(data);
                jQuery('#CreateDocumentModal').modal('hide');
                document.getElementById('documentKey').value = null;
                document.getElementById('documentVisibility').value = 'private';
            }catch(error){
                console.log(error);
                errorAlertContent.innerText = error.message;
                errorAlert.classList.add('show');
            }
        } else {
            errorAlertContent.innerText = 'Impossible de créer le Document. Vérifier ses paramètres';
            errorAlert.classList.add('show');
        }
    }

    async function displayNextDocuments() {
        const services = await getBackendClient();
        const indexes = $observableGenericDataStore.data.map(d => d.id);
        const minIndexes = Math.min(...indexes);
        const nextDocuments = await services.documentService.findDocument({
            lastIndex: minIndexes
        })
        const lastIndex = Math.min(...(nextDocuments.map(d => d.id)));
        const hasNext = (await services.documentService.findDocument({
            lastIndex
        })).length > 0;
        observableGenericDataStore.update(ds => {
            for(const nd of nextDocuments){
                if(!ds.data.find(d => d.key === nd.key)){
                    ds.data.push(nd)
                }
            }
            ds.hasNext = hasNext;
            return ds
        })
    }

</script>

<style>
    .documentsPanel {
        display: flex;
        height:100%;
    }
    .documentsMenu {
        flex-grow: 1;
        min-width: 10vw;
    }
    .documentsMenu li.list-group-item-action {
        display: flex;
        align-items: center;
        text-align: start;
    }
    .documentsAction > span {
        margin-left: 5px;
    }
    .documentsList {
        flex-grow: 3;
        height:100%;
        max-height: 100%;
        min-height:100%;
        overflow: hidden;
        background: white;
    }
    .documents {
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

    #documentVisibility {
        width:100%;
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

<main class="documentsPanel">
    <div class="documentsMenu">
        <ul class="list-group">
            <li class="documentsAction list-group-item list-group-item-dark list-group-item-action"
                id="show-create-document" on:click={showCreateDocument}>
                <i class="fas fa-2x fa-plus-circle"></i><span>Créer un document</span>
            </li>
        </ul>
    </div>
    <div class="documentsList">
        <h1>Documents</h1>
        <div class="table-wrapper">
            <table id="documents-table" class="documents table table-striped table-fixed">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Clé</th>
                    <th scope="col">Auteur</th>
                    <th scope="col">Date de création</th>
                    <th scope="col">Date de mise à jour</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                {#if Array.isArray($observableGenericDataStore.data)}
                    {#each $observableGenericDataStore.data as document}
                        <tr data-document-id="{document.id}" transition:fade>
                            <th scope="row">{document.id}</th>
                            <th scope="row">{document.key}</th>
                            <th>{document.author.login}</th>
                            <th>{new Date(document.creationDate).toLocaleString()}</th>
                            <th>{new Date(document.updateDate).toLocaleString()}</th>
                            <th>
                                {#if document.isReader}
                                    <button data-document-key="{document.key}" type="button" class="btn btn-secondary" title="Voir le document" on:click={displayDocument}><i class="fas fa-book-reader"></i></button>
                                {/if}
                                {#if document.isEditor}
                                    <button data-document-key="{document.key}" type="button" class="btn btn-secondary" title="Editer le document" on:click={editDocument}><i class="fas fa-edit"></i></button>
                                {/if}
                        </tr>
                    {/each}
                {/if}
                </tbody>
            </table>
            {#if $observableGenericDataStore.hasNext}
            <div class="next-documents-wrapper">
                <button type="button" class="btn btn-danger" on:click={displayNextDocuments}>Afficher les data suivants</button>
            </div>
            {/if}
        </div>
    </div>
</main>

<div id="CreateDocumentModal" class="modal fade" data-keyboard="false">
    <style>
        label {
            text-align: start;
        }
    </style>

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="create-channel-modal-title" class="modal-title">Créer un Document</h5>
                <button id="ErrorClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="CreateDocumentForm" class="">
                    <div class="mb-3">
                        <label for="documentKey">Clé</label>
                        <input on:blur={onDocumentKeyChanged}
                               class="form-control"
                               id="documentKey" name="documentKey" type="text" required>
                        <div class="invalid-feedback">
                            La clé ne peut pas être vide et doit être unique.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="documentVisibility">Visibilité</label>
                        <select on:blur={() => {
                            const visibility = document.getElementById('documentVisibility');
                            visibility.title = Helpers.visibilityTooltips[visibility.value];
                        }} class="form-select"
                                id="documentVisibility" name="documentVisibility"
                                required title="Un document privé n'est accessible et visible que par ses lecteurs et les administrateurs">
                            <option value="private" >Privé</option>
                            <option value="protected" >Protégé</option>
                            <option value="public">Public</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-createChannel">
                <div id="errorOnCreatingDocument" class="alert alert-danger fade">
                    <div id="errorOnCreatingDocumentContent"></div>
                </div>
                <button on:click={createDocument} type="button" class="btn action btn-danger " >
                    <span id="creating-document-loading" class="spinner-border"></span>Créer le Document
                </button>
            </div>
        </div>
    </div>
</div>

