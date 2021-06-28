<script lang="ts">
    import {ShowUpdateUserEventStore, ShowModalUserEvent} from "../../stores/ShowCreateUserEventStore";
    import {fly} from "svelte/transition"
    import {onMount, onDestroy, afterUpdate} from 'svelte';
    import {UserAvailabilityStatus, UserEvent, UserEventVisibility} from "@nodecms/backend-data";
    import {getBackendClient} from "@nodecms/backend-client";
    import {Helpers} from "../../helpers/Helpers";

    let startDate;
    let startTime;
    let endDate;
    let endTime;
    let userEvent:UserEvent;

    //@ts-ignore
    const unsubscribe = ShowUpdateUserEventStore.subscribe(v => {
        console.log('update on update modal');
        initStartAndEnd();
    })

    const visibilitiesDescription = {
        protected: "Un évènement protégé n'est accessible et visible que par des utilisateurs identifiés",
        private: "Un évènement privé ne laisse voir aux autres utilisateurs que la date de début, de fin et la disponibilité de son créateur"
    }

    async function validateUserEvent() {
        if(getEndDate() < getStartDate()){
            return false;
        }
    }

    function getEndDate():Date {
        return Helpers.fromStringToDate(endDate, endTime);
    }

    function getStartDate():Date {
        return Helpers.fromStringToDate(startDate, startTime)
    }

    function onStartDateChange() {
        if(getEndDate() < getStartDate()){
            const d = getStartDate();
            userEvent.startDate = new Date(d.getFullYear(), d.getMonth(), d.getDate(), 0,0);
            userEvent.endDate = new Date(userEvent.startDate.getFullYear(), userEvent.startDate.getMonth(), userEvent.startDate.getDate(), 23, 59);
        }
        userEvent.startDate = getStartDate();
    }

    function onEndDateChange() {
        if(getEndDate() < getStartDate()){
            const d = getEndDate();
            userEvent.endDate = new Date(d.getFullYear(), d.getMonth(), d.getDate(), 23, 59);
            userEvent.startDate = new Date(userEvent.endDate.getFullYear(), userEvent.endDate.getMonth(), userEvent.endDate.getDate(), 0, 0);
        }
        userEvent.endDate = getEndDate();
    }

    async function doUpdateUserEvent() {
        const doUpdateUserEventButton = document.getElementById('do-update-user-events');
        const loading = document.getElementById('update-user-events-loading');
        let closeAfterAction = true;
        try {
            const backendService = await getBackendClient();
            loading.classList.add('show');
            doUpdateUserEventButton.setAttribute('disabled','disabled');
            await backendService.userService.updateUserEvent(userEvent);
        } catch (error){
            document.getElementById('error-creating-user-events-content').innerText = error.message;
            document.getElementById('error-creating-user-events').classList.add('show');
            closeAfterAction = false;
            console.error(error);
        } finally {
            if(closeAfterAction){
                window.setTimeout(() => {
                    doUpdateUserEventButton.removeAttribute('disabled');
                    loading.classList.remove('show');
                    ShowUpdateUserEventStore.set(new ShowModalUserEvent())
                }, 2000)
            }
        }
    }

    function initStartAndEnd(){
        if($ShowUpdateUserEventStore.userEvent){
            userEvent = $ShowUpdateUserEventStore.userEvent;
            startDate = Helpers.fromDateToString(userEvent.startDate);
            startTime = Helpers.fromTimeToString(userEvent.startDate);
            endDate = Helpers.fromDateToString(userEvent.endDate);
            endTime = Helpers.fromTimeToString(userEvent.endDate);
        }
    }

    function onPredefinedCategoryClick(event) {
        showOrHidePredefinedCategories();
        const categoryInput = document.getElementById('user-event-category');
        categoryInput.value = event.target.getAttribute('data-category');
        userEvent.category = categoryInput.value;
        const e = document.createEvent("HTMLEvents");
        e.initEvent('blur',true, true);
        categoryInput.dispatchEvent(e);
    }

    function showOrHidePredefinedCategories(forceHide:boolean = false):void {
        const menu = document.getElementById('categories');
        if(menu.classList.contains('show'))
            menu.classList.remove('show');
        else
            menu.classList.add('show');
        if(forceHide)
            menu.classList.remove('show');
    }

    onMount(() => {
        initStartAndEnd()
    })

    onDestroy(unsubscribe);

</script>

<style>
    #update-user-event-background {
        position: fixed;
        top:0;
        left:0;
        height: 100vh;
        width: 100vw;
        background: rgba(0, 0, 0, 0.2);
        display: none;
        z-index: 150;
    }

    #update-user-event-background.show {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .modal.fade.show {
        display: block;
    }

    #update-user-event-form div.mb-3, .field {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
    }

    .date-field, .field-row {
        display: flex;
        justify-content: flex-start !important;
        flex-direction: row !important;
        position: relative;
    }

    .datetime {
        margin-left: 5px;
    }

    .modal-body {
        max-height: calc(100vh - 250px);
        overflow-y: auto;
    }

    .input-color {
        width: 75px;
        margin-left: 5px;
        padding: 1px;
    }

    #do-update-user-events {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #update-user-events-loading {
        display: none;
        margin-right: 5px;
    }

    :global(#update-user-events-loading.show) {
        display: block !important;
    }

    #user-event-category {
        margin-bottom: 0;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    #show-predefined-categories {
        margin-bottom: 0;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
        height: 38px;
    }

    #categories {
        position: absolute;
        display: none;
        right:0;
    }

    :global(#categories.show) {
        display: flex !important;
    }

</style>

<div id="update-user-event-background" class="modal-background" class:show={$ShowUpdateUserEventStore.shown}>
    {#if $ShowUpdateUserEventStore.shown}
        <div id="update-userevent-modal" class="modal fade"
             transition:fly="{{ y: -250, duration: 500  }}"
             class:show={$ShowUpdateUserEventStore.shown}
             data-keyboard="false">
            <style>
                label {
                    text-align: start;
                }
            </style>

            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="update-user-event-modal-title" class="modal-title">Modifier l'évènement</h5>
                        <button id="update-user-event-close" type="button" class="close" data-dismiss="modal" aria-label="Close" on:click={
                    () => {
                        ShowUpdateUserEventStore.set(new ShowModalUserEvent());
                    }}>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="update-user-event-form" class="">
                            <div class="mb-3">
                                <label for="user-event-start-date-field">Début</label>
                                <div id="user-event-start-date-field" class="date-field">
                                    <input
                                            class="form-control datetime"
                                            id="user-event-start-date" name="user-event-start-date" type="date" required
                                            on:blur={onStartDateChange}
                                            bind:value={startDate}
                                    >
                                    <input
                                            class="form-control datetime"
                                            id="user-event-start-time" name="user-event-start-time" type="time" required
                                            on:blur={onStartDateChange}
                                            bind:value={startTime}
                                    >
                                    <div class="invalid-feedback">
                                        La date de début ne peut pas être vide et doit être inférieur à la date de fin.
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="user-event-end-date-field">Fin</label>
                                <div id="user-event-end-date-field" class="date-field">
                                    <input
                                            class="form-control datetime"
                                            id="user-event-end-date" name="user-event-end-date"
                                            type="date" required
                                            on:blur={onEndDateChange}
                                            bind:value={endDate}
                                    >
                                    <input
                                            class="form-control datetime"
                                            id="user-event-end-time" name="user-event-end-time"
                                            type="time" required
                                            on:blur={onEndDateChange}
                                            bind:value={endTime}
                                    >
                                    <div class="invalid-feedback">
                                        La date de fin ne peut pas être vide et doit être supérieur à la date de début.
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 field-row" >
                                <div class="field">
                                    <label for="user-event-label">Label</label>
                                    <input
                                            class="form-control"
                                            id="user-event-label" name="user-event-label"
                                            type="text"
                                            bind:value={userEvent.label}
                                    >
                                </div>
                                <div class="field">
                                    <label for="user-event-color">Couleur</label>
                                    <input  class="form-control input-color"
                                            id="user-event-color"
                                            name="user-event-color"
                                            type="color"
                                            bind:value={userEvent.color}
                                    >
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="user-event-description">Description</label>
                                <textarea
                                        class="form-control"
                                        id="user-event-description"
                                        name="user-event-label"
                                        type="text"
                                        bind:value={userEvent.description}
                                />
                            </div>
                            <div class="mb-3">
                                <label for="user-event-category">Catégorie</label>
                                <div class="field-row">
                                    <input  class="form-control category"
                                            id="user-event-category"
                                            name="user-event-category"
                                            type="text" on:blur={() => {
                                                showOrHidePredefinedCategories(true);
                                            }}
                                            bind:value={userEvent.category}
                                    >
                                    <button type="button"
                                            class="btn btn-secondary"
                                            id="show-predefined-categories"
                                            on:click={() => {
                                             showOrHidePredefinedCategories();
                                            }}
                                    ><i class="fas fa-chevron-down"></i></button>
                                    <div id="categories" class="dropdown-menu">
                                        <button on:click={onPredefinedCategoryClick}
                                                type="button"
                                                data-category="Vacances"
                                                class="dropdown-item">Vacances</button>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="user-event-visibility">Visibilité</label>
                                <select class="form-select"
                                        id="user-event-visibility"
                                        name="user-event-visibility"
                                        title={visibilitiesDescription.protected}
                                        bind:value={userEvent.visibility}
                                        on:blur={() => {
                                            const visibilitySelected = document.getElementById('user-event-visibility');
                                            visibilitySelected.title = visibilitiesDescription[visibilitySelected.value]
                                        }}
                                >
                                    <option value="protected" title={visibilitiesDescription.protected}>Protégé</option>
                                    <option value="private" title={visibilitiesDescription.private}>Privé</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="user-event-availability">Disponibilité</label>
                                <select class="form-select"
                                        id="user-event-availability" name="user-event-availability"
                                        title="Occupé"
                                        bind:value={userEvent.ownerAvailabilityStatus}
                                >
                                    <option value="busy" >Occupé</option>
                                    <option value="available">Disponible</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="user-event-location">Localisation</label>
                                <input class="form-select"
                                        id="user-event-location"
                                        name="user-event-location"
                                        title="Localisation"
                                       bind:value={userEvent.location}
                                >
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer modal-footer-upload-footer">
                        <div id="error-creating-user-events" class="alert alert-danger fade">
                            <div id="error-creating-user-events-content"></div>
                        </div>
                        <button id="do-update-user-events" type="button" class="btn action btn-danger " on:click={doUpdateUserEvent}>
                            <span id="update-user-events-loading" class="spinner-border"></span><span id="do-update-user-events-text">Enregistrer</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    {/if}
</div>