<script>
    import {getBackendClient} from "../../api/NodeCMSClient";
    import {afterUpdate, beforeUpdate, onMount} from "svelte";
    import PostEditor from "./PostEditor.svelte";
    import Post from "./Post.svelte";

    let backEndService = null;

    export let channel;
    let channelPosts;
    let editor = null;
    let attachments = []

    onMount(async () => {
        backEndService = await getBackendClient();
        await backEndService.userService.checkAuthentication();
        window.setTimeout(async () => {
            console.log(channel);
            if (channel && channel.key) {
                try{
                    channelPosts = await backEndService.channelsService.getChannelPosts(channel.key);
                }catch(error){
                    console.error(error);
                }
                console.log(channelPosts);
                const channelContent = document.querySelector('.channelContent')
                const currentChannelKey = channel.key;
                await backEndService.channelsService.subscribeToChannel(currentChannelKey, async (m) => {
                    channelPosts.push(m);
                    channelPosts = channelPosts;
                    window.setTimeout(() => {
                        channelContent.scrollTop = channelContent.scrollHeight;
                    })
                })
            }
        }, 100)
    })

    $:{
        getBackendClient().then(async (service) => {
            if(channel && channel.key)
                channelPosts = await service.channelsService.getChannelPosts(channel.key);
        })
    }

    $:{
        if(channel && channel.key) {
            const channelContent = document.querySelector('.channelContent');
            window.setTimeout(async() => {
                await backEndService.channelsService.subscribeToChannel(channel.key, async (m) => {
                    console.log('a message !!!');
                    channelPosts.push(m);
                    channelPosts = channelPosts;
                    window.setTimeout(() => {
                        channelContent.scrollTop = channelContent.scrollHeight;
                    })
                })
            }, 100)
        }
    }

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

