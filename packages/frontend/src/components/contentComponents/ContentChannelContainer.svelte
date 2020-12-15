<script>
    import {getBackendClient} from "../../NodeCMSClient";
    import {afterUpdate, beforeUpdate, onMount} from "svelte";
    import Editor from 'cl-editor';

    let backEndService = null;

    export let channel;
    export let channelPosts;
    let editor = null;

    window.addEventListener('backend-ready', () => {
        backEndService = getBackendClient();
    })

    onMount(async () => {
        if(!backEndService)
            backEndService = getBackendClient();
    })

    window.setTimeout(async () => {
        channelPosts = await backEndService.getChannelPosts(channel.key);
        for(const post of channelPosts) {
            post.author
        }
        console.log(channelPosts);

        editor = new Editor({
            target: document.getElementById('message'),
            props: {
                height: '54px',
                actions: ['b','i','u','strike','ul','ol','viewHtml']
            }
        })

        document.getElementById('message').addEventListener('keypress', (event) => {
            if(event.key === 'Enter' && event.ctrlKey) {
                console.log(editor.getHtml(true));
                event.stopPropagation();
                //TODO : send the message to the service + add publication on realtime
            }
        })


    }, 1000)

</script>

<style>
    .channel {
        background: white;
        height:100%;
        width:100%;
        overflow-y:auto;
        flex-grow: 4;
        position: relative;
        padding-top:70px;
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
    }

    .post {
        display: flex;
        margin-left:15px;
    }

    .postContent {
        display: flex;
        flex-direction: column;
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

    .postCreation {
        border: solid lightgray 1px;
        position : absolute;
        bottom : 5px;
        margin: 5px;
        height: 100px;
        width: calc(100% - 10px);
    }

    .postCreation form {
        height:50%;
        width:100%;
    }

    .postCreation form > input {
        height:100%;
        width:100%;
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
                <div class="post">
                    <div class="author">
                        <i class="fas fa-user-circle fa-3x"></i>
                        <span>{post.author.login}</span>
                    </div>
                    <div class="postContent">
                        <style>
                            .postContent h1 {
                                text-align: start;
                                font-size: 25px;
                            }
                        </style>
                        <div>{(new Date(post.creationDate)).toLocaleDateString()} {(new Date(post.creationDate)).toLocaleTimeString()}</div>
                        {@html post.content}
                    </div>
                </div>
            {/each}
        {/if}
    </div>
    {#if channel}
    <div class="postCreation">
        <div id="message">

        </div>
    </div>
    {/if}
</div>

