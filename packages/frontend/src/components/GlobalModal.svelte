<script lang="ts">

    import {onDestroy} from 'svelte';
    import {ModalContext, ModalStore} from "../stores/ModalStore";

    let currentContext:ModalContext

    const unsubscribe = ModalStore.subscribe(ms => {
        if(!ms.close){
            window.jQuery('#global-modal').modal('show');
            currentContext = ms;
        } else {
            window.jQuery('#global-modal').modal('hide');
        }

    })

    onDestroy(unsubscribe);

</script>

<div id="global-modal" class="modal fade" data-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="global-modal-title" class="modal-title">{currentContext.title}</h5>
                <button id="global-modal-close" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                TODO : kdghsdghks
            </div>
            <div class="modal-footer">
                {#each currentContext.actions as action}
                    <button type="button" class="btn {action.cssClasses.join(' ')}" on:click={action.action}>{action.label}</button>
                {/each}
            </div>
        </div>
    </div>
</div>