<script>

    import {getBackendClient} from "../../NodeCMSClient";
    import {onMount} from "svelte";

    export let key;
    export let label;
    export let visibility;
    export let file;
    let src = 'defaultImageUrl';

    let uploaded = false;

    onMount(async () => {
        window.setTimeout(async () => {
            const backEndService = getBackendClient();
            if(!await backEndService.mediaExists(key)){
                await backEndService.createMedia(file, key, label, visibility);
            }
            file = await backEndService.getMedia(key);
        })
    })

</script>

<style>
    .attachment {
        height:50px;
        width:50px;
        background:red;
        margin:5px;
    }
</style>



<div class="attachment">

</div>