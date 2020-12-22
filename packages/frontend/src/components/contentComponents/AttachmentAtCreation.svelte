<script>

    import {getBackendClient} from "../../NodeCMSClient";

    export let key;
    export let label;
    export let visibility;
    export let file;

    let backendClient;
    let uploaded = false;

    function initBackendClient() {
        if(!backendClient)
            backendClient = getBackendClient()
    }

    $: async () => {
         initBackendClient();
         let alreadyExists = await backendClient.getMedia(key)
    }

</script>

<div>

</div>