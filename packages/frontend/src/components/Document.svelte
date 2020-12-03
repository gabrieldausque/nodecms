<script>
    import {getBackendClient} from '../NodeCMSClient';
    import { onMount } from 'svelte';

    let backEndService = null;
    export let documentKey = 'welcome';
    let document = null;
    window.addEventListener('backend-ready', () => {
        backEndService = getBackendClient();
    })

    onMount(async () => {
        // document =  await backEndService.getDocument(documentKey);
    })

</script>

<div class="document">

</div>