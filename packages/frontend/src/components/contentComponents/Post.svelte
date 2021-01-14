<script>
    import {afterUpdate, beforeUpdate, onMount, setContext} from "svelte";
    import {getBackendClient, NodeCMSClient} from "../../api/NodeCMSClient";
    import {v4} from 'uuid';

    import LoadingAttachment from "./Attachments/LoadingAttachment.svelte";
    import ImageAttachment from "./Attachments/ImageAttachment.svelte";
    import DownloadAttachment from "./Attachments/DownloadAttachment.svelte";
    import VideoAttachment from "./Attachments/VideoAttachment.svelte";
    import AudioAttachment from "./Attachments/AudioAttachment.svelte";

    export let post

    function createHtmlContent(content) {
        const element = document.createElement('div');
        element.innerHTML = content;
        return element.outerHTML;
    }

    async function getAttachmentComponent(attachmentKey) {
        const backendClient = await getBackendClient();
        const attachment = await backendClient.mediaService.getMedia(attachmentKey)
        if(attachment.loading) {
            return LoadingAttachment
        } else if(attachment.mediaType.indexOf('image') >= 0){
            return ImageAttachment;
        } else if (attachment.mediaType.indexOf('video') >= 0) {
            return VideoAttachment;
        } else if (attachment.mediaType.indexOf('audio') >= 0) {
            return AudioAttachment;
        } else {
            return DownloadAttachment;
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

            div {
                text-align: start;
            }

        </style>
        <div>{(new Date(post.creationDate)).toLocaleDateString()} {(new Date(post.creationDate)).toLocaleTimeString()}</div>
        {@html createHtmlContent(post.content)}
        {#if Array.isArray(post.attachments) && post.attachments.length > 0}
            {#each post.attachments as attachmentKey}
                {#await getAttachmentComponent(attachmentKey) then attachment}
                    <svelte:component this={attachment} attachment={attachmentKey}/>
                {/await}
            {/each}
        {/if}
    </div>
</div>
