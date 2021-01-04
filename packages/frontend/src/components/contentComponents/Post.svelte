<script>


    import {onMount} from "svelte";
    import {getBackendClient, NodeCMSClient} from "../../api/NodeCMSClient";
    import {v4} from 'uuid';

    export let post

    let attachments = [];

    let icons = {
        'application/pdf':'fa-file-pdf'
    }

    function createHtmlContent(content) {
        const element = document.createElement('div');
        element.innerHTML = content;
        return element.outerHTML;
    }

    function getImageUrl(media) {
        return `url(${getDownloadUrl(media)})`;
    }

    function getDownloadUrl(media) {
        const localBuffer = new Uint8Array(media.blob.data);
        const blob = new Blob([localBuffer], { type: media.mediaType});
        return URL.createObjectURL(blob)
    }

    onMount(async() => {
        if(Array.isArray(post.attachments)){
            for(const mediaKey of post.attachments){
                const loadingMedia = {
                    id: v4(),
                    mediaType: 'loading',
                    loading: true
                }
                attachments.push(loadingMedia);
                attachments = attachments;
                const media = await getBackendClient().mediaService.getMedia(mediaKey);
                attachments.push(media);
                const loading = document.getElementById(loadingMedia.id);
                if(loading)
                    loading.remove();
            }
            // for reseting display
            attachments = attachments;
        }
    })

    function handleVideoClick(event) {
        if(event.target && event.target.play) {
            event.target.play();
        }
    }

</script>

<style>
    .post {
        display: flex;
        margin-left:15px;
        margin-bottom:15px;
    }

    .postContent {
        display: flex;
        flex-direction: column;
        width: 100%;
        margin-left: 10px;
    }

    .postContent div {
        width: fit-content;
    }

    .author > i {
        height:50px;
        width:50px;
        display:flex;
        flex-direction: column;
        margin-right: 15px;
    }

    .attachment-image {
        background-size: contain;
        background-repeat: no-repeat;
        background-position: left;
        width:100% !important;
        height:100%;
        min-height: 25vh;
    }

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

    .loading-container {
        border: solid 1px lightgray;
        width:250px !important;
        height:150px !important;
        border-radius: 5px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .spinner-loading {
        width:75px !important;
        height:75px !important;
        z-index: 3;
    }

    .medias-loading {
        position: absolute;
        color: lightgray;
        z-index: 0;
    }

    .postVideo {
        height: 250px;
        width: 300px;
        border: solid 2px lightgray;
    }

</style>

<div class="post">
    <div class="author">
        <i class="fas fa-user-circle fa-3x"></i>
        <span>{post.author.login}</span>
    </div>
    <div class="postContent">
        <style>
            .postContent h1 {
                text-align: start;
                font-size: 25px;
            }

            .cl-content,
            .cl-actionbar {
                text-align: start;
            }

            div {
                text-align: start;
            }

        </style>
        <div>{(new Date(post.creationDate)).toLocaleDateString()} {(new Date(post.creationDate)).toLocaleTimeString()}</div>
        {@html createHtmlContent(post.content)}
        {#if Array.isArray(attachments) && attachments.length > 0}
            {#each attachments as attachment}
                {#if attachment && attachment.mediaType}
                    {#if attachment.mediaType.indexOf('image') >= 0}
                        <div class="attachment-image" style="background-image: {getImageUrl(attachment)}"></div>
                    {:else if attachment.mediaType.indexOf('video') >= 0}
                        <video id="{`video-${attachment.key}`}" on:click={handleVideoClick} class="postVideo" src="{getDownloadUrl(attachment)}" type="{attachment.mediaType}" ></video>
                    {:else if attachment.loading}
                        <div class="loading-container" id="{attachment.id}" title="Chargement ...">
                            <div class="spinner-border spinner-loading text-danger" ></div>
                            <div class="medias-loading">
                                <i class="fas fa-3x fa-video"></i>
                                <i class="fas fa-3x fa-volume-up"></i>
                                <i class="fas fa-3x fa-image"></i>
                            </div>
                        </div>
                    {:else}
                        <a class="attachment-download" href="{getDownloadUrl(attachment)}" >
                            <div class="attachment-download">
                                <i class="fas fa-2x {icons[attachment.mediaType]}"></i>
                                <label>{attachment.label}</label>
                            </div>
                        </a>
                    {/if}
                {/if}
            {/each}
        {/if}
    </div>
</div>
