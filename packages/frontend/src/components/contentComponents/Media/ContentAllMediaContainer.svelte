<script>

    import {AllMediaStores} from "../../../stores/AllMediaStores";
    import {MediaService} from "../../../api/MediaService";

    $AllMediaStores;

    function showUploadMedia(event) {
        console.log('click');
        jQuery('#UploadMediaModal').modal('show');
    }

    async function onKeyOrLabelChange(event){
        const key = document.getElementById('mediaKey');
        const label = document.getElementById('mediaLabel');

        if((!key.value) && (label.value)) {
            key.value = label.value;
        }

        if((!label.value) && (key.value))
        {
            label.value = key.value;
        }

        await validateUploadForm();
    }

    async function validateUploadForm() {
        const services = await getBackendClient();
        const key = document.getElementById('mediaKey');
        const label = document.getElementById('mediaLabel');
        const mediaFile = document.getElementById('mediaFile');

        let isInvalid = false;

        if((!key.value) ||
            (await services.mediaService.mediaExists(key.value))) {
            key.classList.remove('is-valid');
            key.classList.add('is-invalid');
            isInvalid = true;
        } else {
            key.classList.remove('is-invalid');
            key.classList.add('is-valid');
        }

        if(!label.value){
            label.classList.remove('is-valid');
            label.classList.add('is-invalid');
            isInvalid = true;
        } else {
            label.classList.add('is-valid');
            label.classList.remove('is-invalid');
        }

        if(mediaFile.files.length === 0){
            mediaFile.classList.add('is-invalid');
            mediaFile.classList.remove('is-valid');
            isInvalid = true;
        } else {
            mediaFile.classList.add('is-valid');
            mediaFile.classList.remove('is-invalid');
        }

        if(isInvalid) {
            document.getElementById('do-upload-media').setAttribute('disabled', '');
        } else {
            document.getElementById('do-upload-media').removeAttribute('disabled');
        }
    }

</script>

<style>
    .all-media-panel {
        display: flex;
        height:100%;
    }
    .media-menu {
        flex-grow: 1;
        min-width: 10vw;
    }
    .media-menu li.list-group-item-action {
        display: flex;
        align-items: center;
        text-align: start;
    }
    .media-action > span {
        margin-left: 5px;
    }
    .all-media-list {
        flex-grow: 3;
        height:100%;
        max-height: 100%;
        min-height:100%;
        overflow: hidden;
        background: white;
    }

    .media-search-bar-container {
        width: calc(100% - 10px);
        position: relative;
        margin: 5px;
        display: flex;
        justify-content: flex-start;
        align-items: center;
    }

    .media-search-bar {
        width: calc(100% - 44px);
        border-bottom-right-radius: 0 ;
        border-top-right-radius: 0;
        margin:0;
    }

    .media-search-bar:focus-visible {
        border-bottom-right-radius: 0 ;
        border-top-right-radius: 0;
    }

    .do-search {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 39px;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
        margin: 0;
    }

    #UploadMediaForm div.mb-3 {
        display:flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
    }

    #uploading-media-loading {
        display: none;
    }

</style>

<main class="all-media-panel">
    <div class="media-menu">
        <ul class="list-group">
            <li class="media-action list-group-item list-group-item-dark list-group-item-action" on:click={showUploadMedia}>
                <i class="fas fa-2x fa-upload"></i><span>Ajouter un media</span>
            </li>
        </ul>
    </div>
    <div class="all-media-list">
        <div class="media-search-bar-container">
            <input class="media-search-bar" type="text" id="search-media-keyword" placeholder="Taper le mot clé">
            <button type="button" class="do-search btn btn-dark"><i class="fas fa-search"></i></button>
        </div>
    </div>
</main>

<div id="UploadMediaModal" class="modal fade" data-keyboard="false">
    <style>
        label {
            text-align: start;
        }
    </style>

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="create-channel-modal-title" class="modal-title">Upload un Media</h5>
                <button id="ErrorClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="UploadMediaForm" class="">
                    <div class="mb-3">
                        <label for="mediaKey">Clé</label>
                        <input
                                on:change={onKeyOrLabelChange}
                                class="form-control"
                                id="mediaKey" name="mediaKey" type="text" required>
                        <div class="invalid-feedback" >
                            La clé ne peut pas être vide et doit être unique.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="mediaLabel">Label</label>
                        <input
                                on:change={onKeyOrLabelChange}
                               class="form-control"
                               id="mediaLabel" name="mediaLabel" type="text" required>
                        <div class="invalid-feedback">
                            Le label ne peut pas être vide.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="mediaVisibility">Visibilité</label>
                        <select class="form-select"
                                id="mediaVisibility" name="mediaVisibility"
                                required title="Un media protégé n'est accessible et visible que par des utilisateurs identifiés">
                            <option value="protected" >Protégé</option>
                            <option value="public">Public</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="mediaFile">Fichier</label>
                        <input type="file"
                               accept="{MediaService.AuthorizedMimeTypes.join(',')}"
                               id="mediaFile" name="mediaFile" on:change={validateUploadForm}>
                    </div>
                    <div class="mb-3">
                        <label for="mediaTags">Tags</label>
                        <input type="text"
                           class="form-control"
                           id="mediaTags" name="mediaTags">
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-createChannel">
                <div id="errorOnUploadingMedia" class="alert alert-danger fade">
                    <div id="errorOnUploadingMediaContent"></div>
                </div>
                <button id="do-upload-media" type="button" class="btn action btn-danger " disabled>
                    <span id="uploading-media-loading" class="spinner-border"></span> Upload Media
                </button>
            </div>
        </div>
    </div>
</div>
