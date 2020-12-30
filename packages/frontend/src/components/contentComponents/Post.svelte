<script>


import {onMount} from "svelte";
    import {getBackendClient, NodeCMSClient} from "../../api/NodeCMSClient";

    export let post

    let attachments = [];

    function createHtmlContent(content) {
        const element = document.createElement('div');
        element.innerHTML = content;
        return element.outerHTML;
    }

    function getAttachmentBackgroundImageString(media) {
        const localBuffer = new Uint8Array(media.blob.data);
        const blob = new Blob([localBuffer], { type: media.mediaType});
        return `url(${URL.createObjectURL(blob)})`;
    }

    onMount(async() => {
        if(Array.isArray(post.attachments)){
            for(const mediaKey of post.attachments){
                const media = await getBackendClient().mediaService.getMedia(mediaKey);
                attachments.push(media);
            }
            // for reseting display
            attachments = attachments;
        }
    })

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
        background-position: center;
        width:100% !important;
        height:100%;
        min-height: 25vh;
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
                <div class="attachment-image" style="background-image: {getAttachmentBackgroundImageString(attachment)}"></div>
            {/each}
        {/if}
    </div>
</div>