<script>

    import {DocumentsStore} from "../../../stores/DocumentsStore";

    $DocumentsStore;


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
        justify-content: center;
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
</style>

<main class="documentsPanel">
    <div class="documentsMenu">
        <ul class="list-group">
            <li class="documentsAction list-group-item list-group-item-dark list-group-item-action" id="show-create-document">
                <i class="fas fa-2x fa-plus-circle"></i><span>Créer un document</span>
            </li>
        </ul>
    </div>
    <div class="documentsList">
        <h1>Documents</h1>
        <table class="documents table table-striped">
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
            {#each $DocumentsStore.documents as document}
                <tr>
                    <th scope="row">{document.id}</th>
                    <th scope="row">{document.key}</th>
                    <th>{document.ownerId}</th>
                    <th>{new Date(document.creationDate).toLocaleString()}</th>
                    <th>{new Date(document.updateDate).toLocaleString()}</th>
                    <th>
                    {#if document.isReader}
                        <button type="button" class="btn btn-secondary" title="Voir le document"><i class="fas fa-book-reader"></i></button>
                    {/if}
                    {#if document.isEditor}
                        <button type="button" class="btn btn-secondary" title="Editer le document"><i class="fas fa-edit"></i></button>
                    {/if}
                </tr>
            {/each}
            </tbody>

        </table>
    </div>
</main>
