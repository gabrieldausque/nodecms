<script>
    import {AttachmentHelpers} from "../../../api/AttachmentHelpers";
    import {writable} from "svelte/store";
    import {getBackendClient} from "../../../api/NodeCMSClient";
    import {beforeUpdate, onMount} from "svelte";
    import LoadingAttachment from "./LoadingAttachment.svelte";

    export let attachment;
    let media;
    const mediaStore = writable({});
    mediaStore.subscribe((value) => {
        if (!media || media.id !== value.id)
            media = value;
    })

    async function loadMedia() {
        if (!media || media.key !== attachment) {
            const backendClient = await getBackendClient();
            const m = await backendClient.mediaService.getMedia(attachment);
            mediaStore.set(m);
        }
    }

    onMount(async () => {
        await loadMedia();
    })

    beforeUpdate(async () => {
        if(!media)
            await loadMedia();
    })

    function handleVideoClick(event) {
        if (event.target && event.target.play) {
            event.target.play();
        }
    }

</script>

<style>
    .postVideo {
        max-height: 50vh;
        max-width: 100%;
    }
</style>

{#if !media || typeof media.id === 'undefined'}
    <LoadingAttachment attachment={attachment}></LoadingAttachment>
{:else if typeof media.id === 'number'}
    <video id="{`video-${media.key}`}"
           controls
           on:click={handleVideoClick}
           class="postVideo"
           src="{AttachmentHelpers.getDownloadUrl(media)}"
           type="{media.mediaType}" >
        <track kind="captions">
        Your browser doesn't support video tag. Please update your browser.
    </video>
{/if}