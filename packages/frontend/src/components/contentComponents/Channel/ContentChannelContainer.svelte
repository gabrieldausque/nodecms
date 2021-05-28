<script>
    import {getBackendClient} from "@nodecms/backend-client";
    import { afterUpdate, beforeUpdate, onMount} from "svelte";
    import PostEditor from "./PostEditor.svelte";
    import Post from "./Post.svelte";
    import {ChannelStore} from "../../../stores/ChannelStore";
    import {ActivePostStore} from "../../../stores/ActivePostStore";
    import {Helpers} from "../../../helpers/Helpers";

    let editor = null;
    let tailActivated = true;
    let tailForChildrenActivated = true;

    $ChannelStore;
    $ActivePostStore;

    function isRightPanelVisible() {
        const b = $ActivePostStore &&
            $ActivePostStore.parentPost &&
            $ActivePostStore.parentPost.channelKey === $ChannelStore.key;
        console.log(b)
        return b;
    }

    function hideRightPanel() {
        ActivePostStore.set(undefined);
    }

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
        if(event.target.scrollTop === 0){
            console.log('bottom reach')
            //TODO : get last children message if needed (number of children post === answerCount of it)
            if($ActivePostStore && $ActivePostStore.parentPost){
                let currentChildren = $ChannelStore.posts.filter(p => p.parentPost === $ActivePostStore.parentPost.id)
                const lastId = currentChildren[0].id;
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
                        cs.posts.sort((p1, p2) => {
                            if(p1.id > p2.id)
                                return 1;
                            if(p1.id < p2.id)
                                return -1;
                            return 0;
                        })
                        return cs;
                    })
                }
            }
        }

        const channelContentView = document.querySelector('.channel-right-panel div.channelContent');
        if(channelContentView) {
            const top = channelContentView.clientHeight - channelContentView.scrollHeight;
            tailForChildrenActivated = channelContentView.scrollTop === top;
        }
    }

    async function onScrollForCurrentChannel(event) {
        if(event.target.scrollTop === 0){
            let posts = $ChannelStore.posts.filter(p => typeof p.parentPost !== "number")
            const lastId = posts[0].id;
            const backendClient = await getBackendClient();
            const nextPage = await backendClient.channelsService.getChannelPosts($ChannelStore.key,
                undefined,
                lastId
            );
            if(nextPage.length){
                ChannelStore.update(cs => {
                    for(const ocp of nextPage) {
                        if(!cs.posts.find(p => p.id === ocp.id)){
                            cs.posts.push(ocp);
                        }
                    }
                    cs.posts.sort((p1, p2) => {
                        if(p1.id > p2.id)
                            return 1;
                        if(p1.id < p2.id)
                            return -1;
                        return 0;
                    })
                    return cs;
                })
            }
        }

        const channelContentView = document.querySelector('#current-channel div.channelContent');
        if(channelContentView) {
            const top = channelContentView.clientHeight - channelContentView.scrollHeight;
            tailActivated = channelContentView.scrollTop === top;
        }

    }

    function isThereNewMessage() {
        const newMessage = $ChannelStore.posts.findIndex(p => {
            if(typeof p.isNew === 'boolean' && p.isNew){
                return true;
            }
            return false
        }) >= 0
        return newMessage;
    }

    function isThereNewAnswer() {
        const newAnswer = $ChannelStore.posts.findIndex(p => {
            if($ActivePostStore &&
                $ActivePostStore.parentPost &&
                typeof p.isNew === 'boolean' && p.isNew && p.parentPost === $ActivePostStore.parentPost.id)
            {
                return true;
            }
            return false;
        })
        return newAnswer;
    }

    afterUpdate(() => {
        if(isThereNewMessage()){
            document.getElementById('newMessage')?.classList.remove('hidden');
        } else {
            document.getElementById('newMessage')?.classList.add('hidden');
        }

        if(tailActivated){
            const channelContentView = document.querySelector('#current-channel div.channelContent');
            if(channelContentView) {
                channelContentView.scrollTop = channelContentView.clientHeight - channelContentView.scrollHeight ;
            }
        }

        if(tailForChildrenActivated) {
            const rightPanel = document.querySelector('.channel-right-panel > .channelContent')
            if(rightPanel) {
                rightPanel.scrollTop = rightPanel.clientHeight - rightPanel.scrollHeight;
            }
        }

    })

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
        flex-direction: column-reverse;
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

    #newMessage {
        font-weight: bold;
    }

    #newMessage.hidden {
        display:none;
    }

    .hidden-channel {
        margin-top: 25px;
    }

 </style>

<div id="current-channel" class="channel">
    <div class="channelInfo">
        <div class="channelHeader">
            {#if $ChannelStore.channel && $ChannelStore.channel.label}
                <strong><h6>{$ChannelStore.channel.label}</h6></strong>
                <div>
                    <span>#{$ChannelStore.key}</span>
                    <span id="newMessage" class="{isThereNewMessage()?'':'hidden'}">Nouveau message !</span>
                </div>
            {/if}
        </div>
        <div id="test"></div>
    </div>
    <div class="channelContent" id="current-posts" on:scroll={onScrollForCurrentChannel}>
        {#if $ChannelStore && $ChannelStore.channel && $ChannelStore.channel.isReader}
            {#each $ChannelStore.posts as post}
                {#if typeof post.parentPost !== 'number'}
                    <Post post={post}></Post>
                {/if}
            {/each}
        {:else if $ChannelStore && $ChannelStore.channel && !$ChannelStore.channel.isReader}
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
                <div>
                    <span>#{$ChannelStore.key}</span>
                    <span id="newAnswer" class="{isThereNewAnswer()?'':'hidden'}">Nouvelle réponse !</span>
                </div>
            </div>
            <i on:click={hideRightPanel} class="fal fa-window-close"></i>
        </div>
        <div class="{$ChannelStore.isContributor ? 'channelContent': 'channelContent tall'}" on:scroll={onScrollForChildren}>
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

