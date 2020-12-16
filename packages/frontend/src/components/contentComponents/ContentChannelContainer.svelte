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
                const messageContent = document.getElementById('message');
                messageContent.addEventListener('paste', async (event) => {
                    console.log(event);
                    // TODO : convert the data to the right type, and paste it as wanted to the editor :
                    // maybe use a factory to create the right items regarding the type : string, url, file
                    for(const i of event.clipboardData.items){
                        console.log(i);
                        const b = i.getAsFile();
                        console.log(b);
                    }

                    event.preventDefault();
                    event.stopPropagation();
                    messageContent.querySelector('pre')?.remove();
                    await customPaste();
                })
                editor = new Editor({
                    target: messageContent,
                    props: {
                        height: '54px',
                        actions: ['b','i','u','strike','ul','ol','viewHtml',
                            {
                                name: 'paste',
                                icon: '<i class="fas fa-paste"></i>',
                                title: 'Paste',
                                result: () => {
                                    customPaste()
                                }
                            }
                        ]
                    }
                })
                messageContent.removeAttribute('onpaste');
                messageContent.addEventListener('keyup', async (event) => {
                    if(event.key === 'Enter') {
                        event.preventDefault();
                        event.stopPropagation();
                        if(!event.ctrlKey) {
                            messageContent.querySelector('br')?.remove();
                            await backEndService.createPost(channel.key, editor.getHtml(false));
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

    async function customPaste() {
        let text;
        const messageEdit = document.querySelector('.cl-content');
        try{
            text = await navigator.clipboard.readText()
        }catch(error){
            text = undefined;
        }
        console.log(text);
        console.log(text.indexOf('file://'));
        if(!text){
            const ci = await navigator.clipboard.read()
            console.log(ci);
        } else if(text.indexOf('file://') >=0) {
            window.setTimeout(() => {
                document.querySelector('.cl-content').innerHTML = messageEdit.innerHTML.replace(text.toString(),'');
            });
        }
    }

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

