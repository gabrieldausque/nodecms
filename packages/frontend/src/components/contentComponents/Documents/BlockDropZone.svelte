<script>
    import { createEventDispatcher } from 'svelte';

    const dispatch = createEventDispatcher();

    export let isBefore = false;
    export let zone;
    export let row;
    export let col;
    export let layout;
    export let order

</script>

<style>

    .drop-zone {
        min-height:20px;
        min-width:10px;
        border: dashed 1px;
    }

    :global(.drop-zone.on-hover) {
        background: red;
    }

</style>

<div class="drop-zone"
     data-zone="{zone}"
     data-order="{order}"
     data-row="{row}"
     data-col="{col}"
     data-layout="{layout}"
     on:dragenter={(event) => {
        event.preventDefault();
        if(event.target)
            event.target.classList.add('on-hover');
        dispatch('dragenter', event)
     }}
     on:dragleave={(event) => {
        event.preventDefault();
        if(event.target)
            event.target.classList.remove('on-hover');
        dispatch('dragleave', event)
     }}
     on:drop={(event) => dispatch('drop', event)}
     on:dragover={(event) => { event.preventDefault(); return false;}}
></div>