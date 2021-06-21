<script>
    import {ShowCreateUserEventStore, ShowCreateUserEvent} from "../../stores/ShowCreateUserEventStore";
    import {fly} from "svelte/transition"

    function doCreateUserEvent() {
        console.log('coucou ...');
    }

</script>

<style>
    #create-userevent-background {
        position: fixed;
        top:0;
        left:0;
        height: 100vh;
        width: 100vw;
        background: rgba(0, 0, 0, 0.2);
        display: none;
    }

    #create-userevent-background.show {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .modal.fade.show {
        display: block;
    }

    #create-userevent-form div.mb-3 {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
    }

</style>

<div id="create-userevent-background" class="modal-background" class:show={$ShowCreateUserEventStore.shown}>
    {#if $ShowCreateUserEventStore.shown}
        <div id="create-userevent-modal" class="modal fade"
             transition:fly="{{ y: -250, duration: 500  }}"
             class:show={$ShowCreateUserEventStore.shown}
             data-keyboard="false">
            <style>
                label {
                    text-align: start;
                }
            </style>

            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="create-userevent-modal-title" class="modal-title">Créer un évènement</h5>
                        <button id="create-userevent-close" type="button" class="close" data-dismiss="modal" aria-label="Close" on:click={
                    () => {
                        ShowCreateUserEventStore.set(new ShowCreateUserEvent());
                    }}>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="create-userevent-form" class="">
                            <div class="mb-3">
                                <label for="userevent-label">Label</label>
                                <input
                                        class="form-control"
                                        id="userevent-label" name="userevent-label" type="text" required>
                                <div class="invalid-feedback">
                                    Le label ne peut pas être vide.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="userevent-description">Description</label>
                                <textarea
                                        class="form-control"
                                        id="userevent-description" name="userevent-label" type="text" required>
                                </textarea>
                                <div class="invalid-feedback">
                                    Le label ne peut pas être vide.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="userevent-visibility">Visibilité</label>
                                <select class="form-select"
                                        id="userevent-visibility" name="userevent-visibility"
                                        required title="Un évènement protégé n'est accessible et visible que par des utilisateurs identifiés">
                                    <option value="protected" >Protégé</option>
                                    <option value="public">Public</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="userevent-availability">Disponibilité</label>
                                <select class="form-select"
                                        id="userevent-availability" name="userevent-availability"
                                        required title="Occupé">
                                    <option value="busy" >Occupé</option>
                                    <option value="available">Disponible</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="userevent-location">Localisation</label>
                                <input class="form-select"
                                        id="userevent-location" name="userevent-location"
                                        required title="Localisation">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer modal-footer-upload-footer">
                        <div id="error-creating-userevents" class="alert alert-danger fade">
                            <div id="error-creating-userevents-content"></div>
                        </div>
                        <button id="do-create-userevents" type="button" class="btn action btn-danger " disabled on:click={doCreateUserEvent}>
                            <span id="create-userevents-loading" class="spinner-border"></span><span id="do-create-userevents-text">Enregistrer</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    {/if}
</div>