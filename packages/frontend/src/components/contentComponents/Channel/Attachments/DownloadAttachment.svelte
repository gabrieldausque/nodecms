<script>
    import {AttachmentHelpers} from "../../../../../../backend-client/src/AttachmentHelpers";
    import {writable} from "svelte/store";
    import {getBackendClient} from "@nodecms/backend-client";
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

    let icons = {
        'application/pdf': 'fa-file-pdf'
    }

    onMount(async () => {
        await loadMedia();
    })

    beforeUpdate(async () => {
        await loadMedia();
    })

</script>

<style>
    .attachment-download {
        display: flex;
        min-width: 50px;
        max-width: 150px;
        white-space: nowrap;
        height: 50px;
        overflow-x: hidden;
        overflow-y: hidden;
    }

    .attachment-download > label {
        margin-bottom: 0;
        margin-left: 5px;
    }
</style>

{#if !media || typeof media.id === 'undefined'}
    <LoadingAttachment attachment={attachment}></LoadingAttachment>
{:else if typeof media.id === 'number'}
    <a id="download-{media.id}"
       data-media-key="{media.key}"
       class="attachment-download"
       href="{AttachmentHelpers.getDownloadUrl(media)}" target="_blank">
        <div class="attachment-download">
            <i class="fas fa-2x {icons[media.mediaType]}"></i>
            <label>{media.label}</label>
        </div>
    </a>
{/if}