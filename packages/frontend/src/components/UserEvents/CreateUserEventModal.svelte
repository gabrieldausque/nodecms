<script lang="ts">
    import {ShowCreateUserEventStore, ShowCreateUserEvent} from "../../stores/ShowCreateUserEventStore";
    import {fly} from "svelte/transition"
    import {UserEvent, UserAvailabilityStatus, UserEventVisibility} from "@nodecms/backend-data";
    import {onMount, onDestroy, afterUpdate} from 'svelte';

    let startDate;
    let startTime;
    let endDate;
    let endTime;

    //@ts-ignore
    const unsubscribe = ShowCreateUserEventStore.subscribe(v => {
        initStartAndEnd();
    })

    function fromDateToString(d:Date):string{
        const date = d.getDate();
        const month = d.getMonth() + 1;
        const year = d.getFullYear();
        return [year,(month < 10?'0' + month:month), (date < 10?'0' + date:date)].join('-');
    }

    function fromTimeToString(d:Date):string{
        const hour = d.getHours();
        const minutes = d.getMinutes();
        return [hour<10?'0' + hour:hour, minutes<10?'0' + minutes:minutes].join(':');
    }

    function fromStringToDate(dateAsString:string, timeAsString:string):Date {
        const splittedDate = dateAsString.split('-');
        const splittedTime = timeAsString.split(':')
        return new Date(parseInt(splittedDate[0]),parseInt(splittedDate[1]) - 1,
            parseInt(splittedDate[2]), parseInt(splittedTime[0]), parseInt(splittedTime[1]));
    }

    function fromStringToTime(dateAsString:string):Date {
        const splitted = dateAsString.split(':');
        return new Date(parseInt(splitted[0]),parseInt(splitted[1]) - 1, parseInt(splitted[2]))
    }

    async function validateUserEvent() {
        if(getEndDate() < getStartDate()){
            return false;
        }
    }

    function getEndDate():Date {
        return fromStringToDate(endDate, endTime);
    }

    function getStartDate():Date {
        return fromStringToDate(startDate, startTime)
    }

    function onStartDateChange() {
        if(getEndDate() < getStartDate()){
            ShowCreateUserEventStore.update((s) => {
                const d = getStartDate();
                s.startDate = new Date(d.getFullYear(), d.getMonth(), d.getDate(), 0,0);
                s.endDate = new Date(s.startDate.getFullYear(), s.startDate.getMonth(), s.startDate.getDate(), 23, 59);
                return s;
            })
        }
    }

    function onEndDateChange() {
        console.log('#');
        console.log(getEndDate());
        console.log(getStartDate());
        console.log('#');
        if(getEndDate() < getStartDate()){
            ShowCreateUserEventStore.update((s) => {
                const d = getEndDate();
                s.endDate = new Date(d.getFullYear(), d.getMonth(), d.getDate(), 23, 59);
                s.startDate = new Date(s.endDate.getFullYear(), s.endDate.getMonth(), s.endDate.getDate(), 0, 0);
                return s;
            })
        }
    }

    async function doCreateUserEvent() {

    }

    function initStartAndEnd(){
        startDate = fromDateToString($ShowCreateUserEventStore.startDate);
        startTime = fromTimeToString($ShowCreateUserEventStore.startDate);
        endDate = fromDateToString($ShowCreateUserEventStore.endDate);
        endTime = fromTimeToString($ShowCreateUserEventStore.endDate);
    }

    onMount(() => {
        initStartAndEnd()
    })

    onDestroy(unsubscribe);

    function test() {
            console.log('toto');
            document.getElementById('userevent-category').value = 'Vacances';
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

    #create-userevent-form div.mb-3, .field {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
    }

    .date-field, .fieldrow {
        display: flex;
        justify-content: flex-start !important;
        flex-direction: row !important;
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

    #create-userevents-loading {
        display: none;
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

            <div class="modal-dialog modal-dialog-centered modal-lg">
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
                                <label for="userevent-startdate-field">Début</label>
                                <div id="userevent-startdate-field" class="date-field">
                                    <input
                                            class="form-control datetime"
                                            id="userevent-startdate" name="userevent-startdate" type="date" required
                                            on:blur={onStartDateChange}
                                            bind:value={startDate}
                                    >
                                    <input
                                            class="form-control datetime"
                                            id="userevent-starttime" name="userevent-starttime" type="time" required
                                            on:blur={onStartDateChange}
                                            bind:value={startTime}
                                    >
                                    <div class="invalid-feedback">
                                        La date de début ne peut pas être vide et doit être inférieur à la date de fin.
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="userevent-enddate-field">Fin</label>
                                <div id="userevent-enddate-field" class="date-field">
                                    <input
                                            class="form-control datetime"
                                            id="userevent-enddate" name="userevent-enddate"
                                            type="date" required
                                            on:blur={onEndDateChange}
                                            bind:value={endDate}
                                    >
                                    <input
                                            class="form-control datetime"
                                            id="userevent-endtime" name="userevent-endtime"
                                            type="time" required
                                            on:blur={onEndDateChange}
                                            bind:value={endTime}
                                    >
                                    <div class="invalid-feedback">
                                        La date de fin ne peut pas être vide et doit être supérieur à la date de début.
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 fieldrow" >
                                <div class="field">
                                    <label for="userevent-label">Label</label>
                                    <input
                                            class="form-control"
                                            id="userevent-label" name="userevent-label" type="text">
                                </div>
                                <div class="field">
                                    <label for="userevent-color">Couleur</label>
                                    <input  class="form-control input-color"
                                            id="userevent-color" name="userevent-color" type="color">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="userevent-description">Description</label>
                                <textarea
                                        class="form-control"
                                        id="userevent-description" name="userevent-label" type="text">
                                </textarea>
                            </div>
                            <div class="mb-3">
                                <label for="userevent-category">Catégorie</label>
                                <div class="fieldrow">
                                    <input  class="form-control category"
                                            id="userevent-category" name="userevent-category" type="text">
                                    <div class="dropdown">
                                        <button type="button"
                                                class="btn btn-secondary dropdown-toggle"
                                                data-toggle="dropdown"
                                                aria-expanded="false"
                                        ></button>
                                        <div id="categories" class="dropdown-menu dropdown-menu-right">
                                            <button on:click={test} type="button" class="dropdown-item">Vacances</button>
                                        </div>
                                    </div>
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
                                        title="Localisation">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer modal-footer-upload-footer">
                        <div id="error-creating-userevents" class="alert alert-danger fade">
                            <div id="error-creating-userevents-content"></div>
                        </div>
                        <button id="do-create-userevents" type="button" class="btn action btn-danger " on:click={doCreateUserEvent}>
                            <span id="create-userevents-loading" class="spinner-border"></span><span id="do-create-userevents-text">Enregistrer</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    {/if}
</div>