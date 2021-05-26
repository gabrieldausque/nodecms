<script>
    import { createEventDispatcher } from 'svelte';

    const dispatch = createEventDispatcher();

    export let component;
    export let isBefore;
    export let zone;


    //TODO : raise helper ....
</script>

<div class="drop-zone"
     data-zone="{zone}"
     data-order="{typeof component.order === 'number'? (isBefore?component.order - 1:component.order + 1):0}"
     on:dragenter={(event) => dispatch('dragenter', event)}
     on:dragleave={(event) => dispatch('dragleave', event)}
     on:drop={(event) => dispatch('drop', event)}
     on:dragover={(event) => { event.preventDefault(); return false;}}
></div>