<script>

    import {MediaService} from "@nodecms/backend-client";

    async function doUploadMedia() {
        document.getElementById('uploading-media-loading').classList.add('show');
        document.getElementById('do-upload-media-text').innerText = 'Uploading ...';
        document.getElementById('do-upload-media').setAttribute('disabled', '');
        document.getElementById('error-uploading-media').classList.remove('show');
        let closeAfterAction = true;
        try {
            const services = await getBackendClient();
            await services.mediaService.createMedia(
                document.getElementById('mediaFile').files[0],
                document.getElementById('mediaKey').value,
                document.getElementById('mediaLabel').value,
                document.getElementById('mediaVisibility').value,
                document.getElementById('mediaTags').value.split(' ')
            )
        } catch (error) {
            document.getElementById('error-uploading-media-content').innerText = error.message;
            document.getElementById('do-upload-media-text').innerText = 'Upload Media';
            document.getElementById('error-uploading-media').classList.add('show');
            await validateUploadForm()
            closeAfterAction = false;
        } finally {
            document.getElementById('uploading-media-loading').classList.remove('show');
            if (closeAfterAction) {
                document.getElementById('do-upload-media-text').innerText = 'Upload OK';
                window.setTimeout(() => {
                    jQuery('#upload-media-modal').modal('hide');
                }, 2000)
            }
        }
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

</script>

<div id="upload-media-modal" class="modal fade" data-keyboard="false">
    <style>
        label {
            text-align: start;
        }
    </style>

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="upload-media-modal-title" class="modal-title">Upload un Media</h5>
                <button id="upload-media-close" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="upload-media-form" class="">
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
                        <div class="invalid-feedback">
                            Un fichier a uploader doit être sélectionné.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="mediaTags">Tags</label>
                        <input type="text"
                               class="form-control"
                               id="mediaTags" name="mediaTags">
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-upload-footer">
                <div id="error-uploading-media" class="alert alert-danger fade">
                    <div id="error-uploading-media-content"></div>
                </div>
                <button id="do-upload-media" type="button" class="btn action btn-danger " disabled on:click={doUploadMedia}>
                    <span id="uploading-media-loading" class="spinner-border"></span><span id="do-upload-media-text">Upload Media</span>
                </button>
            </div>
        </div>
    </div>
</div>