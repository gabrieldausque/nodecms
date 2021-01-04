<script>
    import {getContext, setContext} from "svelte";
    import {globalFEService} from "../FEServices";

    export let errorTitle;
    export let errorMessage;

    function displayError(title, message) {
        errorTitle = title;
        errorMessage = message;
        window.jQuery('#ErrorModal').modal('show');
    }

    globalFEService.registerService('displayError', {
        displayError
    });

</script>

<div id="ErrorModal" class="modal fade" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="error-modal-title" class="modal-title">Error</h5>
                <button id="ErrorClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>{errorTitle}</h6>
                <div class="error-msg">
                    {errorMessage}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>