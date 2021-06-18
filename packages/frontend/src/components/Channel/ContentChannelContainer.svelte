<!--
    properties.channelKey = will define the Channel to be displayed
-->

<script>
    import {getBackendClient} from "@nodecms/backend-client";
    import {Helpers} from '../../helpers/Helpers';
    import {v4 as uuid} from 'uuid';
    import { onMount, beforeUpdate, afterUpdate, onDestroy } from "svelte";
    import PostEditor from "./PostEditor.svelte";
    import Post from "./Post.svelte";
    import {observableChannelCache} from "../../stores/ChannelStore";

    let editor = null;
    let tailActivated = true;
    let tailForChildrenActivated = true;
    let Channel;
    const id = uuid();
    $observableChannelCache

    export let properties;
    export let ActivePost;

    function isRightPanelVisible() {
        const b = Channel &&
            ActivePost &&
            ActivePost.parentPost &&
            ActivePost.parentPost.channelKey === properties.channelKey;
        console.log( `Testing if right panel must be shown : ${b}`);
        return b;
    }

    function hideRightPanel() {
        ActivePost = undefined;
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
        const channelContentView = document.querySelector('.channel-right-panel div.channelContent');

        if(channelContentView) {
            const bottom = channelContentView.scrollHeight - channelContentView.clientHeight;
            if(event.target.scrollTop === bottom){
                if(ActivePost && ActivePost.parentPost && $observableChannelCache[properties.channelKey]){
                    const lastId = ActivePost.posts[ActivePost.posts.length - 1].id;
                    const backendClient = await getBackendClient();
                    const otherChildrenPage = await backendClient.channelsService.getChildrenPosts(ActivePost.parentPost.channelKey,
                        ActivePost.parentPost.id,
                        lastId
                    );
                    let toUpdate = false
                    if(otherChildrenPage.length){
                        for(const ocp of otherChildrenPage) {
                            if(!ActivePost.posts.find(p => p.id === ocp.id)){
                                if(ocp.content){
                                    await Helpers.preloadContentPreview(ocp.content)
                                }
                                if(Array.isArray(ocp.attachments) && ocp.attachments.length > 0){
                                    const attachmentsMetadata = [];
                                    for(const a of ocp.attachments){
                                        const m = await backendClient.mediaService.getMediaMetadata(a);
                                        attachmentsMetadata.push(m);
                                    }
                                    ocp.attachments = attachmentsMetadata;
                                }
                                ActivePost.posts.push(ocp);
                                toUpdate = true;
                            }
                        }
                        if(toUpdate){
                            ActivePost.posts.sort((p1, p2) => {
                                if(p1.id > p2.id)
                                    return -1;
                                if(p1.id < p2.id)
                                    return 1;
                                return 0;
                            })
                            ActivePost = ActivePost;
                        }
                    }
                }
            }
            tailForChildrenActivated = channelContentView.scrollTop === 0;
        }
    }

    async function onScrollForCurrentChannel(event) {

        const channelContentView = document.querySelector(`#channel-${properties.channelKey} div.channelContent`);

        if(channelContentView) {
            const bottom = channelContentView.scrollHeight - channelContentView.clientHeight;
            if(event.target.scrollTop === bottom){
                let posts = $observableChannelCache[properties.channelKey].posts.filter(p => typeof p.parentPost !== "number")
                const lastId = posts[posts.length - 1].id;
                const backendClient = await getBackendClient();
                const nextPage = await backendClient.channelsService.getChannelPosts(properties.channelKey,
                    undefined,
                    lastId
                );
                if(nextPage.length){
                    let toUpdate = false;
                    for(const ocp of nextPage) {
                        if(!$observableChannelCache[properties.channelKey].posts.find(p => p.id === ocp.id)){
                            if(ocp.content){
                                await Helpers.preloadContentPreview(ocp.content)
                            }
                            if(Array.isArray(ocp.attachments) && ocp.attachments.length > 0){
                                const attachmentsMetadata = [];
                                for(const a of ocp.attachments){
                                    const m = await backendClient.mediaService.getMediaMetadata(a);
                                    attachmentsMetadata.push(m);
                                }
                                ocp.attachments = attachmentsMetadata;
                            }
                            $observableChannelCache[properties.channelKey].posts.push(ocp);
                            toUpdate = true;
                        }
                    }
                    if(toUpdate) {
                        console.log('update after scroll down')
                        observableChannelCache.update(occ => {
                            return occ;
                        })
                    }

                }
            }
            tailActivated = channelContentView.scrollTop === 0;
        }
    }

    function isThereNewMessage() {
        if($observableChannelCache[properties.channelKey]){
            const newMessage = $observableChannelCache[properties.channelKey].posts.findIndex(p => {
                if( (typeof p.parentPost === 'undefined' ||
                     p.parentPost === null) &&
                    typeof p.isNew === 'boolean' &&
                    p.isNew) {
                    return true;
                }
                return false
            }) >= 0
            return newMessage;
        }
        return false;
    }

    function isThereNewAnswer() {
        if($observableChannelCache[properties.channelKey]){
            const newAnswer = $observableChannelCache[properties.channelKey].posts.findIndex(p => {
                if(ActivePost &&
                   ActivePost.parentPost &&
                   p.parentPost === ActivePost.parentPost.id &&
                   typeof p.isNew === 'boolean' &&
                   p.isNew)
                {
                    return true;
                }
                return false;
            }) >= 0;
            return newAnswer;
        }
        return false;
    }

    async function createChannelFromKey() {
        if(properties && properties.channelKey &&
            (!$observableChannelCache[properties.channelKey])
        )  {
           await Helpers.getChannelContentAndSubscribe(properties.channelKey);
        }
    }

    onMount(async () => {
        await createChannelFromKey()
    })

    beforeUpdate(() => {
        if(isThereNewAnswer()){
            const newAnswers = $observableChannelCache[properties.channelKey].posts.filter(p => p.parentPost === ActivePost.parentPost.id);
            if(newAnswers && newAnswers.length > 0){
                for(const p of ActivePost.posts){
                    p.isNew = false;
                }
                for(const a of newAnswers){
                    $observableChannelCache[properties.channelKey].posts.splice(
                        $observableChannelCache[properties.channelKey].posts.indexOf(a), 1);
                    ActivePost.posts.push(a);
                }
                ActivePost.posts.sort((p1,p2) => {
                    if(p1.id > p2.id)
                        return -1;
                    if(p1.id < p2.id)
                        return 1;
                    return 0;
                })
                ActivePost = ActivePost;
            }
        }
    })

    afterUpdate(async () => {

        await createChannelFromKey()



        if(isThereNewMessage()){
            document.getElementById(`new-message-for-${properties.channelKey}`)?.classList.remove('hidden');
        } else {
            document.getElementById(`new-message-for-${properties.channelKey}`)?.classList.add('hidden');
        }

        if(isThereNewAnswer()){
            document.getElementById(`new-answer-for-${properties.channelKey}`)?.classList.remove('hidden');
        } else {
            document.getElementById(`new-answer-for-${properties.channelKey}`)?.classList.add('hidden');
        }

        if($observableChannelCache.hasChannel(properties.channelKey) && tailActivated){
            const channelContentView = document.querySelector(`#channel-${properties.channelKey} div.channelContent`);
            if(channelContentView) {
                channelContentView.scrollTop = channelContentView.clientHeight - channelContentView.scrollHeight ;
            }
        }

        if($observableChannelCache.hasChannel(properties.channelKey) && tailForChildrenActivated) {
            const rightPanel = document.querySelector('.channel-right-panel > .channelContent')
            if(rightPanel) {
                rightPanel.scrollTop = rightPanel.clientHeight - rightPanel.scrollHeight;
            }
        }

        if($observableChannelCache.hasChannel(properties.channelKey)){
            const messages = document.querySelector(`#channel-${properties.channelKey} > .channelContent`);
            const lastMessages = document.querySelectorAll(`#channel-${properties.channelKey} > .channelContent > .post.new-post`);
            if(lastMessages.length > 0);
            {
                const lastMessage = lastMessages[lastMessages.length - 1];
                lastMessage.remove();
                messages.prepend(lastMessage);
            }
        }

        if(ActivePost) {
            const messages = document.querySelector(`#channel-${properties.channelKey} > .channel-right-panel > .channelContent`);
            const lastMessages = document.querySelectorAll(`#channel-${properties.channelKey} > .channel-right-panel > .channelContent > .post.new-post`);
            if(lastMessages.length > 0);
            {
                const lastMessage = lastMessages[lastMessages.length - 1];
                lastMessage.remove();
                messages.prepend(lastMessage);
            }
        }

    })

</script>

<style>
    .channel {
        background: white;
        display: flex;
        flex-direction: row;
        height:100%;
        max-height:calc(100vh - 71px);
        flex-grow: 4;
        position: relative;
    }

    .channelInfo {
        position:absolute;
        top:0px;
        left:0px;
        width: 100%;
        height: 60px;
        display: flex;
        align-items: center;
        border-bottom: solid lightgray 1px;
        background: white;
        z-index: 2;
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
        flex-grow:3;
        height: auto;
        overflow-y: auto;
        position: relative;
        display: flex;
        flex-direction: column;
        padding-top: 5px;
        margin-top: 61px;
    }

    .hidden-channel {
        margin-top: 5px;
    }

    .channel-right-panel {
        display: flex;
        flex-direction: column;
        background: white;
        height: calc(100% - 60px);
        position: relative;
        right:0;
        width:33vw;
        box-shadow: -2px 0px 5px lightgray;
        margin-top: 60px;
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
        position:absolute;
        top:0;
        max-height: 60px;
    }

    .channel-right-panel > .header > div > h6,
    .channel-right-panel > .header > div >p {
        margin-bottom: 0;
    }

    .new-label
    {
        font-weight: bold;
    }

    .hidden {
        display:none;
    }

    .hidden-channel {
        margin-top: 25px;
    }

    .channel-right-panel div.channelContent {
        max-height: calc(100% - 60px);
    }

    :global(.new-post) {
        animation: 500ms linear fadeIn;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }

 </style>

{#if $observableChannelCache[properties.channelKey]}
    <div id={`channel-${properties.channelKey}`} class="channel" style="{properties.style?properties.style:''}">
        <div class="channelInfo">
            <div class="channelHeader">
                {#if $observableChannelCache[properties.channelKey].channel && $observableChannelCache[properties.channelKey].channel.label}
                    <strong><h6>{$observableChannelCache[properties.channelKey].channel.label}</h6></strong>
                    <div>
                        <span>#{properties.channelKey}</span>
                        <span id="new-message-for-{properties.channelKey}" class="new-label {isThereNewMessage()?'':'hidden'}">Nouveau message !</span>
                    </div>
                {/if}
            </div>
            <div id="test"></div>
        </div>
        <div class="channelContent" id="current-posts-for-{properties.channelKey}" on:scroll={onScrollForCurrentChannel}>
            {#if $observableChannelCache[properties.channelKey] &&
            $observableChannelCache[properties.channelKey].channel &&
            $observableChannelCache[properties.channelKey].channel.isReader}
                {#each $observableChannelCache[properties.channelKey].posts as post}
                    {#if typeof post.parentPost !== 'number'}
                        <Post post={post} on:answer-clicked={(p) => {
                            ActivePost = p.detail;
                }}></Post>
                    {/if}
                {/each}
            {:else if $observableChannelCache[properties.channelKey] &&
            $observableChannelCache[properties.channelKey].channel &&
            !$observableChannelCache[properties.channelKey].channel.isReader}
                <div class="hidden-channel" >
                    <i class="fas fa-10x fa-eye-slash"></i>
                    <div class="hidden-channel-label">
                        Ceci est un canal privé ou protégé<br>
                        veuillez en demander l'accès à son administrateur
                    </div>
                </div>
            {/if}
            {#if $observableChannelCache[properties.channelKey].channel &&
            !$observableChannelCache[properties.channelKey].notAuthorized &&
            $observableChannelCache[properties.channelKey].channel.isContributor}
                <PostEditor channelKey={properties.channelKey} targetId={id}></PostEditor>
            {/if}
        </div>
        {#if $observableChannelCache[properties.channelKey].channel &&
        ActivePost &&
        ActivePost.parentPost}
            <div class="channel-right-panel" in:slideIn>
                <div class="header" >
                    <div>
                        <h6>Fil de discussion</h6>
                        <div>
                            <span>#{properties.channelKey}</span>
                            <span id="new-answer-for-{properties.channelKey}" class="new-label {isThereNewAnswer()?'':'hidden'}"> Nouvelle réponse !</span>
                        </div>
                    </div>
                    <i on:click={hideRightPanel} class="fal fa-window-close"></i>
                </div>
                <div class="channelContent" on:scroll={onScrollForChildren}>
                    {#each ActivePost.posts as post}
                        {#if post.parentPost === ActivePost.parentPost.id  }
                            <Post post={post}></Post>
                        {/if}
                    {/each}
                    <Post post="{ActivePost.parentPost}"></Post>
                    {#if $observableChannelCache[properties.channelKey].channel &&
                    !$observableChannelCache[properties.channelKey].notAuthorized &&
                    $observableChannelCache[properties.channelKey].channel.isContributor}
                        <PostEditor channelKey={$observableChannelCache[properties.channelKey].channel.key}
                                    parentPost="{ActivePost.parentPost.id}" targetId="messageInThread"></PostEditor>
                    {/if}
                </div>
            </div>
        {/if}
    </div>

{:else}
    <div style="{properties.style?properties.style:''}">
        No Channel
    </div>
{/if}

