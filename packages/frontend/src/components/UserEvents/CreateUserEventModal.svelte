<script lang="ts">
    import {ShowCreateUserEventStore, ShowCreateUserEvent} from "../../stores/ShowCreateUserEventStore";
    import {fly} from "svelte/transition"
    import {UserEvent, UserAvailabilityStatus, UserEventVisibility} from "@nodecms/backend-data";
    import {onMount, onDestroy, afterUpdate} from 'svelte';

    let startDate;
    let startTime;
    let endDate;
    let endTime;

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
        const startDateAsString = (document.getElementById<HTMLInputElement>('userevent-startdate') as HTMLInputElement).value;
        const startTimeAsString = (document.getElementById<HTMLInputElement>('userevent-starttime') as HTMLInputElement).value;
        const endDateAsString = (document.getElementById<HTMLInputElement>('userevent-enddate') as HTMLInputElement).value;
        const endTimeAsString = (document.getElementById<HTMLInputElement>('userevent-endtime') as HTMLInputElement).value;
        const startDate = fromStringToDate(startDateAsString, startTimeAsString);
        const endDate = fromStringToDate(endDateAsString, endTimeAsString);
        if(endDate < startDate){
            ShowCreateUserEventStore.update((s) => {
                s.startDate = new Date(endDate.getFullYear(), endDate.getMonth(), endDate.getDate() - 1, 0, 0);
                s.endDate = endDate;
                return s;
            })
        }

    }

    async function doCreateUserEvent() {

    }

    function initStartAndEnd(){
        startDate = fromDateToString($ShowCreateUserEventStore.startDate);
        console.log(startDate)
        startTime = fromTimeToString($ShowCreateUserEventStore.startDate);
        endDate = fromDateToString($ShowCreateUserEventStore.endDate);
        endTime = fromTimeToString($ShowCreateUserEventStore.endDate);
    }

    onMount(() => {
        initStartAndEnd()
    })

    onDestroy(unsubscribe);

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

    .modal-body {
        max-height: calc(100vh - 250px);
        overflow-y: auto;
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
                                <label for="userevent-startdate">Début</label>
                                <input
                                        class="form-control"
                                        id="userevent-startdate" name="userevent-startdate" type="date" required
                                        on:change={validateUserEvent}
                                        bind:value={startDate}
                                >
                                <input
                                        class="form-control"
                                        id="userevent-starttime" name="userevent-starttime" type="time" required
                                        on:change={validateUserEvent}
                                        bind:value={startTime}
                                >
                                <div class="invalid-feedback">
                                    La date de début ne peut pas être vide et doit être inférieur à la date de fin.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="userevent-enddate">Fin</label>
                                <input
                                        class="form-control"
                                        id="userevent-enddate" name="userevent-enddate"
                                        type="date" required
                                        on:change={validateUserEvent}
                                        bind:value={endDate}
                                >
                                <input
                                        class="form-control"
                                        id="userevent-endtime" name="userevent-endtime"
                                        type="time" required
                                        on:change={validateUserEvent}
                                        bind:value={endTime}
                                >
                                <div class="invalid-feedback">
                                    La date de fin ne peut pas être vide et doit être supérieur à la date de début.
                                </div>
                            </div>
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