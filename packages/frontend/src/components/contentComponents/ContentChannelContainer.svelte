<script>
    import {getBackendClient} from "../../api/NodeCMSClient";
    import {afterUpdate, beforeUpdate, onDestroy, onMount} from "svelte";
    import PostEditor from "./PostEditor.svelte";
    import Post from "./Post.svelte";
    import {ChannelContent, ChannelStore} from "../../stores/ChannelStore";

    export let channel;

    let editor = null;
    let channelPosts = [];

    const unsubscribe = ChannelStore.subscribe((value) => {
        if(value && Array.isArray(value.posts)){
            channelPosts.splice(0,channelPosts.length);
            for(const p of value.posts){
                if(channelPosts.findIndex((i) => {
                    return p.id === i.id;
                }) < 0){
                    channelPosts.push(p);
                }
            }
        }
        channelPosts = channelPosts;
    })

    async function loadPosts() {
        if (channel && channel.key &&
            channel.key !== $ChannelStore.key) {
            console.log('update store');
            const backEndService = await getBackendClient();
            try{
                const channelContent = new ChannelContent();
                channelContent.key = channel.key;
                channelContent.posts = await backEndService.channelsService.getChannelPosts(channel.key);
                ChannelStore.set(channelContent);
            }catch(error){
                console.error(error);
            }
            const channelContent = document.querySelector('.channelContent')
            const currentChannelKey = channel.key;
            await backEndService.channelsService.subscribeToChannel(currentChannelKey, async (m) => {
                ChannelStore.update(value => {
                    value.posts.push(m);
                    return value;
                })
                window.setTimeout(() => {
                    channelContent.scrollTop = channelContent.scrollHeight;
                })
            })
        }
    }

    onMount(async () => {
        await loadPosts();
    })

    beforeUpdate(async() => {
        await loadPosts();
    })

    onDestroy(unsubscribe)

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
        {#if channelPosts}
            {#each channelPosts as post}
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

