<script>
    import {afterUpdate, createEventDispatcher} from "svelte";
    import {globalFEService} from "../../../FEServices";
    import {PostWithChildren} from "../../../stores/ActivePostStore";
    import {Helpers} from "../../../helpers/Helpers";
    import { fade } from 'svelte/transition';

    export let post;

    const dispatch = createEventDispatcher();

    function createHtmlContent(content) {
        const element = document.createElement('div');
        element.innerHTML = content;
        return element.outerHTML;
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
                        }
                        window.setTimeout(setInnerLink, 500);
                    }
                }
            }
        },100);
    })

    let mouseHover = false;

    async function onAnswerClick(event){
        const postWithChildren = new PostWithChildren();
        postWithChildren.parentPost = post;
        post.isNew = false;
        const backendClient = await getBackendClient();
        const children = await backendClient.channelsService.getChildrenPosts(post.channelKey, post.id);
        for(const p of children){
            if(p.content){
                await Helpers.preloadContentPreview(p.content)
            }
            if(Array.isArray(p.attachments) && p.attachments.length > 0){
                const attachmentsMetadata = [];
                for(const a of p.attachments){
                    const m = await backendClient.mediaService.getMediaMetadata(a);
                    attachmentsMetadata.push(m);
                }
                p.attachments = attachmentsMetadata;
            }
        }
        postWithChildren.posts = children;
        dispatch('answer-clicked', postWithChildren);
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
        margin-right: 10px;
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

    .post-actions {
        position: absolute;
        right: 15px;
        border: solid gray 1px;
        padding: 5px;
        border-radius: 25px;
        opacity: 0;
    }

    .postContent:hover > .post-actions {
        opacity: 1;
    }

    .channel-right-panel > .post {
        max-width: calc(100% - 15px);
    }

    .new-post {
        font-weight:bold;
    }

</style>

<div id={ (post && typeof post.id === 'number')?`post-${post.id}`:null } class="post" class:new-post={post.isNew} in:fade>
    <div class="author">
        <i class="fas fa-user-circle fa-3x"></i>
        <span>{post.author.login}</span>
    </div>
    <div class="postContent">
        {#if typeof post.parentPost !== 'number'}
            <div class="post-actions">
                <div class="post-action" on:click={onAnswerClick} title="Montrer les réponses">
                    <i class="fa fa-comment-lines"></i>
                </div>
            </div>
        {/if}
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
                <svelte:component this={Helpers.getAttachmentComponent(attachmentKey.mediaType)} attachment={attachmentKey.key}/>
            {/each}
        {/if}
        <div class="postMetadata">
            {#if post.answerCount}
                <div class="metadata" title="Nombre de réponses">
                    <span>{post.answerCount}</span>
                    <i class="fas fa-comment-lines"></i>
                </div>
            {/if}
        </div>
    </div>
</div>
