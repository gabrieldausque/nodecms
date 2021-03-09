<script>
    import {AttachmentHelpers} from "../../../../api/AttachmentHelpers";
    import {beforeUpdate, onMount} from "svelte";
    import {writable} from 'svelte/store';
    import LoadingAttachment from "./LoadingAttachment.svelte";
    import {getBackendClient} from "../../../../api/NodeCMSClient";

    export let attachment
    let media;
    const mediaStore = writable({});
    mediaStore.subscribe((value) => {
        if(!media || media.id !== value.id)
            media = value;
    })

    async function loadMedia() {
        if(!media || media.key !== attachment){
            const backendClient = await getBackendClient();
            const m = await backendClient.mediaService.getMedia(attachment);
            mediaStore.set(m);
        }
    }

    onMount(async() => {
        await loadMedia();
    })

    beforeUpdate(async() => {
        await loadMedia();
    })

</script>

<style>
    .attachment-image {
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        width:100% !important;
        height:100%;
        min-height: 25vh;
        max-height:30vh;
    }
</style>

{#if !media}
    <LoadingAttachment attachment={attachment}></LoadingAttachment>
{:else if typeof media.id === 'number'}
    <div id="image-{attachment}" class="attachment-image" style="background-image: {AttachmentHelpers.getImageUrl(media)}"></div>
{/if}
