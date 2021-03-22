<script>
    import {getBackendClient} from "../../../api/NodeCMSClient";
    import { afterUpdate, beforeUpdate, onMount} from "svelte";
    import PostEditor from "./PostEditor.svelte";
    import Post from "./Post.svelte";
    import {ChannelStore} from "../../../stores/ChannelStore";
    import {ActivePostStore} from "../../../stores/ActivePostStore";
    import {Helpers} from "../../../helpers/Helpers";

    let editor = null;

    $ChannelStore;
    $ActivePostStore;

    function isRightPanelVisible() {
        console.log('channelstore')
        console.log($ChannelStore);
        console.log('activepoststore')
        console.log($ActivePostStore);
        const b = $ActivePostStore &&
            $ActivePostStore.parentPost &&
            $ActivePostStore.parentPost.channelKey === $ChannelStore.key;
        console.log(b)
        return b;
    }

    function hideRightPanel() {
        console.log('toto');
        ActivePostStore.set(undefined);
    }

    beforeUpdate(async() => {
        if($ChannelStore.channel){
            const backendClient = await getBackendClient();
            await backendClient.channelsService.subscribeToChannel($ChannelStore.channel.key, (async (mc) => {
                if(mc.content){
                    await Helpers.preloadContentPreview(mc.content)
                }
                if(Array.isArray(mc.attachments) && mc.attachments.length > 0){
                    const attachmentsMetadata = [];
                    for(const a of mc.attachments){
                        const m = await backendClient.mediaService.getMediaMetadata(a);
                        attachmentsMetadata.push(m);
                    }
                    mc.attachments = attachmentsMetadata;
                }
                if(typeof mc.parentPost === 'number'){
                    const parentPost = $ChannelStore.posts.find(p => p.id === mc.parentPost);
                    if(parentPost){
                        parentPost.answerCount = parentPost.answerCount?parentPost.answerCount+1:1;
                        if($ActivePostStore && $ActivePostStore.parentPost && $ActivePostStore.parentPost.id === mc.parentPost){
                            ActivePostStore.update(aps => {
                                aps.parentPost = parentPost;
                                return aps;
                            })
                        }
                    }
                }
                ChannelStore.update(cs => {
                    cs.posts.unshift(mc);
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

    async function onScrollForChildren(event) {
        if((event.target.scrollHeight - event.target.clientHeight) === event.target.scrollTop){
            console.log('bottom reach')
            //TODO : get last children message if needed (number of children post === answerCount of it)
            if($ActivePostStore && $ActivePostStore.parentPost){
                const sortAscend = (p1, p2) => {
                    if(p1.id < p2.id)
                        return 1
                    if(p1.id > p2.id)
                        return -1
                    return  0
                }
                let currentChildren = $ChannelStore.posts.filter(p => p.parentPost === $ActivePostStore.parentPost.id)
                currentChildren.sort(sortAscend)
                const lastId = currentChildren[currentChildren.length - 1].id;
                const backendClient = await getBackendClient();
                const otherChildrenPage = await backendClient.channelsService.getChildrenPosts($ActivePostStore.parentPost.channelKey,
                    $ActivePostStore.parentPost.id,
                    lastId
                );
                console.log(otherChildrenPage);
                if(otherChildrenPage.length){
                    ChannelStore.update(cs => {
                        for(const ocp of otherChildrenPage) {
                            if(!cs.posts.find(p => p.id === ocp.id)){
                                cs.posts.push(ocp);
                            }
                        }
                        cs.posts.sort(sortAscend)
                        return cs;
                    })
                }
            }
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
        max-height: 100%;
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
        display: flex;
        flex-direction: column;
        background: white;
        height: 100%;
        position: relative;
        right:0;
        width:33vw;
        box-shadow: -2px 0px 5px lightgray;
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
                {#if typeof post.parentPost !== 'number'}
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
{#if $ChannelStore.channel && $ActivePostStore && $ActivePostStore.parentPost}
    <div class="channel-right-panel" in:slideIn>
        <div class="header" >
            <div>
                <h6>Fil de discussion</h6>
                <p>#{$ChannelStore.key}</p>
            </div>
            <i on:click={hideRightPanel} class="fal fa-window-close"></i>
        </div>
        <div class="{$ChannelStore.isContributor ? 'channelContent': 'channelContent tall'}" on:scroll={onScrollForChildren}>
            {#each $ChannelStore.posts as post}
                {#if post.parentPost === $ActivePostStore.parentPost.id  }
                    <Post post={post}></Post>
                {/if}
            {/each}
            <Post post="{$ActivePostStore.parentPost}"></Post>
        </div>
        {#if $ChannelStore.channel && !$ChannelStore.notAuthorized && $ChannelStore.channel.isContributor}
            <PostEditor channelKey={$ChannelStore.channel.key} parentPost="{$ActivePostStore.parentPost.id}" targetId="messageInThread"></PostEditor>
        {/if}
    </div>
{/if}

