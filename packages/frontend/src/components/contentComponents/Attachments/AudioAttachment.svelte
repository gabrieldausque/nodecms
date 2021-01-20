<script>
    import {AttachmentHelpers} from "../../../api/AttachmentHelpers";
    import {writable} from "svelte/store";
    import {getBackendClient} from "../../../api/NodeCMSClient";
    import {beforeUpdate, onMount} from "svelte";
    import LoadingAttachment from "./LoadingAttachment.svelte";

    export let attachment;
    let media;

    console.log(media);

    const mediaStore = writable({});
    mediaStore.subscribe((value) => {
        if (!media || media.id !== value.id)
            media = value;
    })

    async function loadMedia() {
        if (!media || media.key !== attachment) {
            const backendClient = await getBackendClient();
            const m = await backendClient.mediaService.getMedia(attachment);
            console.log('getting media');
            console.log(m);
            mediaStore.set(m);
        }
    }

    onMount(async () => {
        await loadMedia();
    })

    beforeUpdate(async () => {
        await loadMedia();
    })

    function handleVideoClick(event) {
        if (event.target && event.target.play) {
            event.target.play();
        }
    }

</script>

<style>
    .postAudio {
        max-height: 50vh;
    }
</style>

{#if !media || typeof media.id === 'undefined'}
    <LoadingAttachment attachment={attachment}></LoadingAttachment>
{:else if typeof media.id === 'number'}
    <audio id="{`video-${media.key}`}"
           on:click={handleVideoClick}
           controls
           class="postAudio"
           src="{AttachmentHelpers.getDownloadUrl(media)}"
           type="{media.mediaType}" >
        <track kind="captions">
        Your browser doesn't support audio tag. Please update your browser.
    </audio>
{/if}