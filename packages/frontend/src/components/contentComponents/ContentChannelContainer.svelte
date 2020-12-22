<script>
    import {getBackendClient} from "../../NodeCMSClient";
    import {afterUpdate, beforeUpdate, onMount} from "svelte";
    import PostEditor from "./PostEditor.svelte";
    import Post from "./Post.svelte";

    let backEndService = null;

    export let channel;
    export let channelPosts;
    let editor = null;
    let attachments = []

    window.addEventListener('backend-ready', () => {
        backEndService = getBackendClient();
    })

    onMount(async () => {
        if (!backEndService)
            backEndService = getBackendClient();
        window.setTimeout(async () => {
            if (channel && channel.key) {
                channelPosts = await backEndService.getChannelPosts(channel.key);
                const channelContent = document.querySelector('.channelContent')
                await backEndService.subscribeToChannel(channel.key, async (m) => {
                    channelPosts.push(m);
                    channelPosts = channelPosts;
                    window.setTimeout(() => {
                        channelContent.scrollTop = channelContent.scrollHeight;
                    })
                })
            }
        }, 100)

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
        {#if channelPosts}
            {#each channelPosts as post}
                <Post post={post} ></Post>
            {/each}
        {/if}
    </div>
    {#if channel}
        <PostEditor channelKey={channel.key}></PostEditor>
    {/if}
</div>

