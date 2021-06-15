<script>

    import {AllMediaStores} from "../../../stores/AllMediaStores";
    import {MediaService} from "@nodecms/backend-client";
    import {Helpers} from "../../../helpers/Helpers";
    import {onMount, afterUpdate} from "svelte";
    import {v4 as uuid} from 'uuid';
    import _ from 'underscore';
    import MediaSearchBar from "./MediaSearchBar.svelte";
    import UploadMediaModal from "./UploadMediaModal.svelte";
    import {ShowUploadModalStore} from "../../../stores/ShowUploadModalStore";

    $AllMediaStores;
    let mediaToEdit;

    onMount(() => {
        const updateModal = jQuery('#edit-media-modal');
        updateModal.on('hidden.bs.modal', () => {
            document.getElementById('media-tags-for-update').value = '';
            document.getElementById('media-label-for-update').value = '';
            document.getElementById('media-key-for-update').value = '';
            document.getElementById('media-visibility-for-update').value = 'protected';
            document.getElementById('do-update-media-text').innerText = 'Enregistrer';
            document.getElementById('do-update-media').removeAttribute('disabled');
            mediaToEdit = undefined;
        });
    })

    afterUpdate(() => {
        if (mediaToEdit) {
            document.getElementById('media-key-for-update').innerText = mediaToEdit.key;
            document.getElementById('media-label-for-update').value = mediaToEdit.label;
            document.getElementById('media-tags-for-update').value = mediaToEdit.tags.join(' ');
            document.getElementById('media-visibility-for-update').value = mediaToEdit.visibility;
            jQuery('#edit-media-modal').modal('show');
        }
    })

    function showUploadMedia(event) {
        ShowUploadModalStore.update(ums => {
            ums.shown = true;
            return ums;
        })
    }

    async function onKeyOrLabelChange(event) {
        const key = document.getElementById('mediaKey');
        const label = document.getElementById('mediaLabel');

        if ((!key.value) && (label.value)) {
            key.value = label.value;
        }

        if ((!label.value) && (key.value)) {
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

        if ((!key.value) ||
            (await services.mediaService.mediaExists(key.value))) {
            key.classList.remove('is-valid');
            key.classList.add('is-invalid');
            isInvalid = true;
        } else {
            key.classList.remove('is-invalid');
            key.classList.add('is-valid');
        }

        if (!label.value) {
            label.classList.remove('is-valid');
            label.classList.add('is-invalid');
            isInvalid = true;
        } else {
            label.classList.add('is-valid');
            label.classList.remove('is-invalid');
        }

        if (mediaFile.files.length === 0) {
            mediaFile.classList.add('is-invalid');
            mediaFile.classList.remove('is-valid');
            isInvalid = true;
        } else {
            mediaFile.classList.add('is-valid');
            mediaFile.classList.remove('is-invalid');
        }

        if (isInvalid) {
            document.getElementById('do-upload-media').setAttribute('disabled', '');
        } else {
            document.getElementById('do-upload-media').removeAttribute('disabled');
        }
    }

    async function doUploadMedia() {
            ShowUploadModalStore.update(ums => {
                ums.shown = true;
                return ums;
            })
    }

    function onSearchStarted() {
        document.querySelector('.searching').classList.add('show');
    }

    function onSearchEnded() {
        document.querySelector('.searching').classList.remove('show');
    }

    async function displayMediaEdit(mediaKey) {
        mediaToEdit = $AllMediaStores.media.find(m => m.key === mediaKey);
    }

    async function validateUpdateForm() {
        const label = document.getElementById('media-label-for-update');

        let isInvalid = false;

        if (!label.value) {
            label.classList.remove('is-valid');
            label.classList.add('is-invalid');
            isInvalid = true;
        } else {
            label.classList.add('is-valid');
            label.classList.remove('is-invalid');
        }

        if (isInvalid) {
            document.getElementById('do-update-media').setAttribute('disabled', '');
        } else {
            document.getElementById('do-update-media').removeAttribute('disabled');
        }
    }

    async function doUpdateMedia() {
        document.getElementById('update-media-loading').classList.add('show');
        document.getElementById('do-update-media-text').innerText = 'En cours ...';
        document.getElementById('do-update-media').setAttribute('disabled', '');
        document.getElementById('error-updating-media').classList.remove('show');
        let closeAfterAction = true;
        try {
            const services = await getBackendClient();
            await services.mediaService.updateMedia(
                document.getElementById('media-key-for-update').innerText,
                document.getElementById('media-label-for-update').value,
                document.getElementById('media-visibility-for-update').value,
                document.getElementById('media-tags-for-update').value.split(' ')
            )
        } catch (error) {
            document.getElementById('error-updating-media-content').innerText = error.message;
            document.getElementById('do-update-media-text').innerText = 'Enregistrer';
            document.getElementById('error-updating-media').classList.add('show');
            await validateUpdateForm()
            closeAfterAction = false;
        } finally {
            document.getElementById('update-media-loading').classList.remove('show');
            if (closeAfterAction) {
                document.getElementById('do-update-media-text').innerText = 'Enregistrement OK';
                window.setTimeout(() => {
                    jQuery('#edit-media-modal').modal('hide');
                    mediaToEdit = undefined;
                }, 2000)
            }
        }
    }

</script>

<style>
    .all-media-panel {
        display: flex;
        height:100%;
        width: 100%;
    }
    .media-menu {
        flex-grow: 1;
        min-width: 10vw;
        max-width: 13vw;
    }
    .media-menu li.list-group-item-action {
        display: flex;
        align-items: center;
        text-align: start;
    }
    .media-action > span {
        margin-left: 5px;
    }
    .all-media {
        flex-grow: 12;
        max-height: 100%;
        min-height: 100%;
        overflow: hidden;
        background: white;
    }

    #upload-media-form div.mb-3,
    #edit-media-form div.mb-3 {
        display:flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
    }

    #uploading-media-loading,
    #update-media-loading
    {
        display: none;
    }

    #uploading-media-loading.show,
    #update-media-loading.show
    {
        display: block;
    }

    .all-media-list {
        display: flex;
        flex-wrap: wrap;
        height: 100%;
        overflow-x: hidden;
        overflow-y: auto;
    }

    .media-container {
        height: 20vh;
        width: 20vw;
        margin: 15px;
        display: flex;
        justify-content: center;
        align-items: flex-start;
    }

    .media-container :global(.attachment-image),
    .media-container :global(.attachment-video) {
        min-height: inherit;
        max-height:100%;
        min-width: inherit;
        max-width: 100%;
    }

    .searching {
        width: 50vw;
        height: 5vh;
        align-self: center;
        justify-self: center;
        bottom: 47vh;
        left:38vw;
        position: absolute;
        font-size: 5vh;
        display: none;
    }

    .searching .first-point {
        animation: 1s linear infinite fading;
    }

    .searching .second-point {
        animation: 1s linear 250ms infinite fading;
    }

    .searching .third-point {
        animation: 1s linear 500ms infinite fading;
    }

    :global(.searching.show) {
        display: flex !important;
    }

    @keyframes fading {
        50% { opacity: 0}
    }

    .modal-footer {
        display: flex;
        justify-content: space-between;
    }

    .modal-footer .alert-danger {
        max-width: 70%;
        text-align: start;
    }

    .media-action > span {
        padding: 5px;
        font-size: 15px;
    }

</style>

<main class="all-media-panel">
    <div class="media-menu">
        <ul class="list-group">
            <li class="media-action list-group-item list-group-item-dark list-group-item-action" on:click={showUploadMedia}>
                <i class="fas fa-2x fa-upload"></i><span>Téléverser un media</span>
            </li>
        </ul>
    </div>
    <div class="all-media">
        <MediaSearchBar
                on:search-started={onSearchStarted}
                on:search-ended={onSearchEnded}
        ></MediaSearchBar>
        <div class="searching">
            <span>Recherche en cours</span>
            <div>
                <span class="first-point">.</span><span class="second-point">.</span><span class="third-point">.</span>
            </div>
        </div>

        <div class="all-media-list">
            {#each $AllMediaStores.media as media}
                <div class="media-container"
                     on:click={() => displayMediaEdit(media.key)}
                >
                    <svelte:component this={Helpers.getAttachmentComponent(media.mediaType)} attachment={media.key}/>
                </div>
            {/each}
        </div>
    </div>
</main>

<UploadMediaModal></UploadMediaModal>

<div id="edit-media-modal" class="modal fade" data-keyboard="false">
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
                {#if mediaToEdit}
                <svelte:component
                        this={Helpers.getAttachmentComponent(mediaToEdit.mediaType)}
                        attachment={mediaToEdit.key}/>
                {/if}
                <div id="edit-media-form" class="">
                    <div class="mb-3">
                        <label for="media-key-for-update">Clé</label>
                        <div id="media-key-for-update"></div>
                    </div>
                    <div class="mb-3">
                        <label for="media-label-for-update">Label</label>
                        <input
                                on:change={validateUpdateForm}
                                class="form-control"
                                id="media-label-for-update"
                                name="media-label-for-update" type="text" required
                        >
                        <div class="invalid-feedback">
                            Le label ne peut pas être vide.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="mediaVisibility">Visibilité</label>
                        <select class="form-select"
                                id="media-visibility-for-update" name="media-visibility-for-update"
                                required title="Un media protégé n'est accessible et visible que par des utilisateurs identifiés">
                            <option value="protected" >Protégé</option>
                            <option value="public">Public</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="mediaTags">Tags</label>
                        <input type="text"
                               class="form-control"
                               on:change={validateUpdateForm}
                               id="media-tags-for-update" name="media-tags-for-update">
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-update-footer">
                <div id="error-updating-media" class="alert alert-danger fade">
                    <div id="error-updating-media-content"></div>
                </div>
                <button id="do-update-media" type="button" class="btn action btn-danger " on:click={doUpdateMedia}>
                    <span id="update-media-loading" class="spinner-border"></span><span id="do-update-media-text">Enregistrer</span>
                </button>
            </div>
        </div>
    </div>
</div>