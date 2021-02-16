<script>
    import {getBackendClient} from "../../api/NodeCMSClient";
    import {afterUpdate, beforeUpdate, onDestroy, onMount} from "svelte";
    import PostEditor from "./PostEditor.svelte";
    import Post from "./Post.svelte";
    import {ChannelContent, ChannelStore} from "../../stores/ChannelStore";
    import {globalFEService} from "../../FEServices";
    import {AttachmentHelpers} from "../../api/AttachmentHelpers";

    export let channel;

    let editor = null;
    $ChannelStore;

    async function preloadContentPreview(content){
        const contentElement = document.createElement('div');
        contentElement.innerHTML = content;
        const backendService = await getBackendClient();
        const webThumbnails = contentElement.querySelectorAll('a[data-link=true]')
        const tempCache = globalFEService.getService('TempCache');
        for(const link of webThumbnails){
            const URL = link.getAttribute('href');
            console.log('getting tw for ' + URL);
            if(!tempCache.get(URL)) {
                const linkPreview = await backendService.utilsService.getWebsiteThumbnail(URL.trim())
                if(linkPreview) {
                    const media = await backendService.mediaService.getMedia(linkPreview.mediaId);
                    const mediaUrl = AttachmentHelpers.getDownloadUrl(media);
                    link.innerHTML = `
                                        <div class="link-preview">
                                            <img src="${mediaUrl}"><div><h6>${linkPreview.title}</h6><br><p>${linkPreview.description}</p></div>
                                        </div>
                                    `
                    tempCache.put(link.getAttribute('href'),link.innerHTML)
                }
            }
        }
    }

    async function loadPosts() {
        if (channel && channel.key &&
            channel.key !== $ChannelStore.key
        ) {
            let channelAuthorized = true;
            const backEndService = await getBackendClient();
            try{
                const channelContent = new ChannelContent();
                channelContent.key = channel.key;
                try{
                    channelContent.posts = await backEndService.channelsService.getChannelPosts(channel.key);
                    for(const p of channelContent.posts) {
                        if(p.content){
                            await preloadContentPreview(p.content)
                        }
                        if(Array.isArray(p.attachments) && p.attachments.length > 0){
                            const attachmentsMetadata = [];
                            for(const a of p.attachments){
                                const m = await backEndService.mediaService.getMediaMetadata(a);
                                attachmentsMetadata.push(m);
                            }
                            p.attachments = attachmentsMetadata;
                        }
                    }
                    ChannelStore.set(channelContent);
                }catch (e) {
                    console.log(e);
                    const cc = new ChannelContent();
                    cc.key = channel.key;
                    cc.posts = [];
                    cc.notAuthorized = true;
                    ChannelStore.set(cc);
                    channelAuthorized = false;
                }
            }catch(error){
                console.error(error);
            }
            if(channelAuthorized){
                const channelContent = document.querySelector('.channelContent')
                const currentChannelKey = channel.key;
                await backEndService.channelsService.subscribeToChannel(currentChannelKey, async (newPost) => {
                    if(Array.isArray(newPost.attachments) && newPost.attachments.length > 0){
                        const attachmentsMetadata = [];
                        for(const a of newPost.attachments){
                            const media = await backEndService.mediaService.getMediaMetadata(a);
                            attachmentsMetadata.push(media);
                        }
                        newPost.attachments = attachmentsMetadata;
                    }
                    if(newPost.content){
                        await preloadContentPreview(newPost.content);
                    }
                    ChannelStore.update(value => {
                        value.posts.push(newPost);
                        return value;
                    })

                    window.setTimeout(() => {
                        channelContent.scrollTop = channelContent.scrollHeight;
                    }, 100)
                })
                window.setTimeout(() => {
                    channelContent.scrollTop = channelContent.scrollHeight;
                }, 100)
            }
        }
    }

    onMount(async () => {
        // await loadPosts();
    })

    beforeUpdate(async() => {
        // document.getElementById('current-posts').innerHTML = '';
        await loadPosts();
    })

</script>

<style>
    .channel {
        background: white;
        display: flex;
        flex-direction: column;
        height:100%;
        width:100%;
        flex-grow: 4;
        position: relative;
    }

    .channelInfo {
        position:sticky;
        top:0px;
        left:0px;
        width: 100%;
        height: 60px;
        display: flex;
        align-items: center;
        border-bottom: solid lightgray 1px;
        background: white;
    }

    .channelHeader {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        margin-left: 15px;
    }

    .channelHeader > h6 {
        margin-bottom: 0px;
    }

    .channelContent {
        height: auto;
        overflow-y: auto;
        position: relative;
        display: flex;
        flex-direction: column;
        padding-top: 5px;
    }

 </style>

<div class="channel">
    <div class="channelInfo">
        <div class="channelHeader">
            {#if channel && channel.label}
                <strong><h6>{channel.label}</h6></strong>
                <span>#{channel.key}</span>
            {/if}
        </div>
        <div id="test"></div>
    </div>
    <div class="channelContent" id="current-posts">
        {#if $ChannelStore && !$ChannelStore.notAuthorized}
            {#each $ChannelStore.posts as post}
                <Post post={post}></Post>
            {/each}
        {:else if $ChannelStore && $ChannelStore.notAuthorized}
            <div class="hidden-channel" >
                <i class="fas fa-10x fa-eye-slash"></i>
                <div class="hidden-channel-label">
                    Ceci est un canal privé ou protégé<br>
                    veuillez en demander l'accès à son administrateur
                </div>
            </div>
        {/if}
    </div>
    {#if channel && !$ChannelStore.notAuthorized && channel.isContributor}
        <PostEditor channelKey={channel.key}></PostEditor>
    {/if}
</div>

