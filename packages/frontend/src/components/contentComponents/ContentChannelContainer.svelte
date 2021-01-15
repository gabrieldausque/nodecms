<script>
    import {getBackendClient} from "../../api/NodeCMSClient";
    import {afterUpdate, beforeUpdate, onDestroy, onMount} from "svelte";
    import PostEditor from "./PostEditor.svelte";
    import Post from "./Post.svelte";
    import {ChannelContent, ChannelStore} from "../../stores/ChannelStore";

    export let channel;

    let editor = null;
    $ChannelStore;

    async function loadPosts() {
        if (channel && channel.key &&
            channel.key !== $ChannelStore.key) {
            const backEndService = await getBackendClient();
            try{
                const channelContent = new ChannelContent();
                channelContent.key = channel.key;
                channelContent.posts = await backEndService.channelsService.getChannelPosts(channel.key);
                for(const p of channelContent.posts) {
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
            }catch(error){
                console.error(error);
            }
            const channelContent = document.querySelector('.channelContent')
            const currentChannelKey = channel.key;
            await backEndService.channelsService.subscribeToChannel(currentChannelKey, async (m) => {
                if(Array.isArray(m.attachments) && m.attachments.length > 0){
                    const attachmentsMetadata = [];
                    for(const a of m.attachments){
                        const media = await backEndService.mediaService.getMediaMetadata(a);
                        attachmentsMetadata.push(media);
                    }
                    m.attachments = attachmentsMetadata;
                }
                ChannelStore.update(value => {
                    value.posts.push(m);
                    return value;
                })
                window.setTimeout(() => {
                    channelContent.scrollTop = channelContent.scrollHeight;
                }, 300)
            })
            window.setTimeout(() => {
                channelContent.scrollTop = channelContent.scrollHeight;
            }, 300)
        }
    }

    onMount(async () => {
        await loadPosts();
    })

    beforeUpdate(async() => {
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
    </div>
    <div class="channelContent">
        {#if $ChannelStore}
            {#each $ChannelStore.posts as post}
                <Post post={post}></Post>
            {/each}
        {:else}
            <div>No Posts</div>
        {/if}
    </div>
    {#if channel}
        <PostEditor channelKey={channel.key}></PostEditor>
    {/if}
</div>

