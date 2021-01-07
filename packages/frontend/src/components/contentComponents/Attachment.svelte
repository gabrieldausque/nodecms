<script>

    import {getBackendClient} from "../../api/NodeCMSClient";
    import {afterUpdate, getContext, onMount} from "svelte";
    import {FEServices, globalFEService} from "../../FEServices";

    export let key;
    export let label;
    export let visibility;
    export let file;
    let src = 'defaultImageUrl';
    export let media;
    let error;
    const { displayError } = globalFEService.getService('displayError');
    console.log(displayError);
    let icons = {
        default: 'fa-file',
        'application/pdf': 'fa-file-pdf',
        'audio/mp3': 'fa-file-audio',
        'audio/mpeg': 'fa-file-audio',
        'audio/webm': 'fa-file-audio',
        'audio/ogg': 'fa-file-audio',
        'audio/aac': 'fa-file-audio',
        'audio/wav': 'fa-file-audio',
        'video/webm': 'fa-file-video',
        'video/ogg': 'fa-file-video',
        'video/mp4': 'fa-file-video',
        'video/x-msvideo': 'fa-file-video'
    }

    onMount(async () => {
        window.setTimeout(async () => {
            if(!media && file && !error){
                try {
                    const backEndService = getBackendClient();
                    if(!await backEndService.mediaService.mediaExists(key)){
                        media = await backEndService.mediaService.createMedia(file, key, label, visibility);
                    }
                    media = await backEndService.mediaService.getMedia(key);
                } catch(error) {
                    const loading = document.getElementById(`loading-${key}`)
                    if(loading)
                        loading.parentNode.remove();
                }
            }
        }, 200)
    })

    afterUpdate(async() => {
        if(media) {
            const div = document.getElementById(`${media.key}`);
            console.log(media);
            if(media.mediaType.indexOf('image') >= 0) {
                const localBuffer = new Uint8Array(media.blob.data);
                const blob = new Blob([localBuffer], { type: media.mediaType});
                div.style.backgroundImage = `url(${URL.createObjectURL(blob)})`;
            } else {
                const fileIcon = document.createElement('i');
                fileIcon.classList.add('fas');
                fileIcon.classList.add('fa-2x');
                fileIcon.classList.add(icons[media.mediaType]?icons[media.mediaType]:icons.default);
                div.prepend(fileIcon);
            }
        } else if(error) {

        }
    })

</script>

<style>
    .attachment {
        height:50px;
        min-width:50px;
        max-width:150px;
        margin:5px;
        padding:5px;
        border: solid 1px lightgray;
        border-radius: 5px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .attachment-image {
        height:100%;
        width:100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
    }

    .attachment-download {
        height:100%;
        width:100%;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        white-space: nowrap;
        overflow-x:hidden;
    }

    .label {
        margin-bottom: 0;
        margin-left: 5px;
    }

</style>


{#if !error}
    <div class="attachment">
        {#if media}
            {#if media.mediaType.indexOf('image') >= 0}
                <div class="attachment-image" id="{media.key}" title="{media.label}"></div>
            {:else }
                <div class="attachment-download" id="{media.key}" title="{media.label}"><span class="label">{media.label}</span></div>
            {/if}
        {:else}
            <div id="loading-{key}" class="spinner-border text-danger" role="status" title="Chargement ...">
            </div>
        {/if}
    </div>
{/if}
