<script>
    import {getBackendClient} from "../../api/NodeCMSClient";
    import {afterUpdate, beforeUpdate, onMount} from "svelte";
    import PostEditor from "./PostEditor.svelte";
    import Post from "./Post.svelte";
    import {ChannelContent, ChannelStore} from "../../stores/ChannelStore";
    import {ActivePostStore} from "../../stores/ActivePostStore";
    import {globalFEService} from "../../FEServices";
    import {AttachmentHelpers} from "../../api/AttachmentHelpers";
    import {slide} from 'svelte/transition';

    let editor = null;
    $ChannelStore;
    $ActivePostStore;


    function isLeftPanelVisible() {
        return $ActivePostStore && $ActivePostStore.parentPost && $ActivePostStore.parentPost.channelKey === $ChannelStore.key;
    }

    function hideLeftPanel() {
        console.log('toto');
        ActivePostStore.set(undefined);
    }

    onMount(async () => {
    })

    beforeUpdate(async() => {
        if($ChannelStore.channel){
            const backendClient = await getBackendClient();
            await backendClient.channelsService.subscribeToChannel($ChannelStore.channel.key, (mc => {
                ChannelStore.update(cs => {
                    cs.posts.push(mc);
                    return cs;
                })
            }))
        }
    })

    function slideIn(node, {
        delay=0,
        duration=100
    }) {
        let p = getComputedStyle(node).width;
        p = parseInt(p.replace('px',''));
        return {
            delay,
            duration,
            css: t => `width: ${t*p}px;`
        }
    }

    function slideOut(node, {
        delay=0,
        duration=100
    }) {
        let p = getComputedStyle(node).width;
        p = parseInt(p.replace('px',''));
        return {
            delay,
            duration,
            css: t => `width: ${(1 - t)*p}px;`
        }
    }

</script>

<style>
    .channel {
        background: white;
        display: flex;
        flex-direction: column;
        height:100%;
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

    .hidden-channel {
        margin-top: 5px;
    }

    .channel-right-panel {
        background: white;
        height: 100%;
        position: relative;
        right:0;
        width:33vw;
        box-shadow: -2px 0px 5px lightgray
    }

    .channel-right-panel > .header {
        width: 100%;
        display: flex;
        justify-content: space-between;
        flex-wrap: nowrap;
        overflow: hidden;
        padding: 5px;
        min-height: 60px;
        align-items: flex-start;
        border-bottom: solid 1px lightgray;
    }

    .channel-right-panel > .header > div > h6,
    .channel-right-panel > .header > div >p {
        margin-bottom: 0;
    }

 </style>

<div class="channel">
    <div class="channelInfo">
        <div class="channelHeader">
            {#if $ChannelStore.channel && $ChannelStore.channel.label}
                <strong><h6>{$ChannelStore.channel.label}</h6></strong>
                <span>#{$ChannelStore.key}</span>
            {/if}
        </div>
        <div id="test"></div>
    </div>
    <div class="channelContent" id="current-posts">
        {#if $ChannelStore && !$ChannelStore.notAuthorized}
            {#each $ChannelStore.posts as post}
                {#if !post.parentPost}
                    <Post post={post}></Post>
                {/if}
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
    {#if $ChannelStore.channel && !$ChannelStore.notAuthorized && $ChannelStore.channel.isContributor}
        <PostEditor channelKey={$ChannelStore.channel.key} targetId="message"></PostEditor>
    {/if}
</div>
{#if $ChannelStore.channel && isLeftPanelVisible()}
    <div class="channel-right-panel" in:slideIn>
        <div class="header" >
            <div>
                <h6>Fil de discussion</h6>
                <p>#{$ChannelStore.key}</p>
            </div>
            <i  on:click={hideLeftPanel} class="fal fa-window-close"></i>
        </div>
        <div>
            <Post post="{$ActivePostStore.parentPost}"></Post>
            {#each $ChannelStore.posts as post}
                {#if post.parentPost === $ActivePostStore.parentPost.id  }
                    <Post post={post}></Post>
                {/if}
            {/each}
        </div>
        {#if $ChannelStore.channel && !$ChannelStore.notAuthorized && $ChannelStore.channel.isContributor}
            <PostEditor channelKey={$ChannelStore.channel.key} parentPost="{$ActivePostStore.parentPost.id}" targetId="messageInThread"></PostEditor>
        {/if}
    </div>
{/if}

