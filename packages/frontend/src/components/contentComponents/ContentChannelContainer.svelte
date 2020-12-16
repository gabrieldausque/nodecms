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
        window.setTimeout(async () => {
            if(channel && channel.key) {
                channelPosts = await backEndService.getChannelPosts(channel.key);
                const channelContent = document.querySelector('.channelContent')
                for(const post of channelPosts) {
                    post.author
                }
                await backEndService.subscribeToChannel(channel.key, async (m) => {
                    channelPosts.push(m);
                    channelPosts = channelPosts;
                    window.setTimeout(() => {
                        channelContent.scrollTop = channelContent.scrollHeight;
                    })
                })
                editor = new Editor({
                    target: document.getElementById('message'),
                    props: {
                        height: '54px',
                        actions: ['b','i','u','strike','ul','ol','viewHtml']
                    }
                })
                const messageContent = document.getElementById('message');
                messageContent.addEventListener('keyup', async (event) => {
                    if(event.key === 'Enter') {
                        if(!event.ctrlKey) {
                            event.stopPropagation();
                            messageContent.querySelector('br')?.remove();
                            //TODO : send the message to the service + add publication on realtime
                            await backEndService.createPost(channel.key, editor.getHtml(false))
                            editor.setHtml('');
                        } else {
                            window.setTimeout(() => {
                                const carriageReturn = document.createElement('div');
                                carriageReturn.innerHTML = '<br>'
                                const content = messageContent.querySelector('.cl-content');
                                content.append(carriageReturn);
                                const sel = document.getSelection();
                                const range = sel.getRangeAt(0);
                                range.setStart(carriageReturn, 0)
                                range.collapse(true)
                                sel.removeAllRanges();
                                sel.addRange(range);
                                sel.collapseToEnd();
                                content.scrollTop = content.scrollHeight;
                            },150)

                        }
                    }
                })
                channelContent.scrollTop = channelContent.scrollHeight;
            }
        }, 100)

    })

    function createHtmlContent(content) {
        const element = document.createElement('div');
        element.innerHTML = content;
        return element.outerHTML;
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
        height: calc(100% - 100px);
        overflow-y: auto;
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
        position : sticky;
        top:calc(100% - 105px);
        bottom : 5px;
        margin: 5px;
        height: 100px;
        width: calc(100% - 10px);
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

                            .cl-content,
                            .cl-actionbar {
                                text-align: start;
                            }

                            div {
                                text-align: start;
                            }
                        </style>
                        <div>{(new Date(post.creationDate)).toLocaleDateString()} {(new Date(post.creationDate)).toLocaleTimeString()}</div>
                        {@html createHtmlContent(post.content)}
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

