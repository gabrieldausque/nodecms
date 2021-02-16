<script>
    import {afterUpdate, beforeUpdate, onMount, setContext} from "svelte";
    import {getBackendClient, NodeCMSClient} from "../../api/NodeCMSClient";
    import {v4} from 'uuid';

    import LoadingAttachment from "./Attachments/LoadingAttachment.svelte";
    import ImageAttachment from "./Attachments/ImageAttachment.svelte";
    import DownloadAttachment from "./Attachments/DownloadAttachment.svelte";
    import VideoAttachment from "./Attachments/VideoAttachment.svelte";
    import AudioAttachment from "./Attachments/AudioAttachment.svelte";
    import {AttachmentHelpers} from "../../api/AttachmentHelpers";
    import {writable} from "svelte/store";
    import {globalFEService} from "../../FEServices";

    export let post

    function createHtmlContent(content) {
        const element = document.createElement('div');
        element.innerHTML = content;
        return element.outerHTML;
    }

    function getAttachmentComponent(attachmentMediaType) {
        if(attachmentMediaType.indexOf('image') >= 0){
            return ImageAttachment;
        } else if (attachmentMediaType.indexOf('video') >= 0) {
            return VideoAttachment;
        } else if (attachmentMediaType.indexOf('audio') >= 0) {
            return AudioAttachment;
        } else {
            return DownloadAttachment;
        }
    }

    afterUpdate(() => {
        window.setTimeout(() => {
            if(post && typeof post.id === 'number'){
                const postView = document.getElementById(`post-${post.id}`);
                const tempCache = globalFEService.getService('TempCache');
                if(postView){
                    const webThumbnails = postView.querySelectorAll('a[data-link=true]')
                    for(const link of webThumbnails){
                        const setInnerLink = () => {
                            const newInnerHTML = tempCache.get(link.getAttribute('href'));
                            if(newInnerHTML)
                            {
                                link.innerHTML = newInnerHTML;
                            }
                            window.setTimeout(()=> {
                                const channelContent = document.querySelector('.channelContent')
                                channelContent.scrollTop = channelContent.scrollHeight
                            })
                        }
                        window.setTimeout(setInnerLink, 500);
                    }
                }
            }
        },100);

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

<div id={ (post && typeof post.id === 'number')?`post-${post.id}`:null } class="post">
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

            .link-preview {
                display: flex;
            }

            .link-preview > div {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: flex-start;
            }

            .link-preview img {
                max-width: 25%;
                margin-right: 15px;
                width: auto;
                height: auto;
            }

        </style>
        <div>{(new Date(post.creationDate)).toLocaleDateString()} {(new Date(post.creationDate)).toLocaleTimeString()}</div>
        {@html createHtmlContent(post.content)}
        {#if Array.isArray(post.attachments) && post.attachments.length > 0}
            {#each post.attachments as attachmentKey}
                <svelte:component this={getAttachmentComponent(attachmentKey.mediaType)} attachment={attachmentKey.key}/>
            {/each}
        {/if}
    </div>
</div>
