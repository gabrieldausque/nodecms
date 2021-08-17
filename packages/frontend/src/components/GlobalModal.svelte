<script lang="ts">

    import {onDestroy} from 'svelte';
    import {ModalContext, ModalStore} from "../stores/ModalStore";
    import {globalModalBodyComponentFactory} from "../factory/ModalBodyComponentFactory";

    let currentContext:ModalContext

    //@ts-ignore
    const unsubscribe = ModalStore.subscribe(ms => {
        if(!ms.close){
            (window as any).jQuery('#global-modal').modal('show');
            currentContext = ms;
        } else {
            (window as any).jQuery('#global-modal').modal('hide');
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
                {#if currentContext.bodyControlType}
                    <svelte:component this={globalModalBodyComponentFactory.getComponent(currentContext.bodyControlType)}
                                      properties={currentContext.bodyControlProperties}
                                      dataType={currentContext.bodyControlType}
                    ></svelte:component>
                {/if}
            </div>
            <div class="modal-footer">
                {#each currentContext.actions as action}
                    <button type="button" class="btn {action.cssClasses.join(' ')}" on:click={action.action}>{action.label}</button>
                {/each}
            </div>
        </div>
    </div>
</div>