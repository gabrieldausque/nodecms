<script>

    import Editor from "cl-editor";
    import {onMount} from "svelte";
    import {getBackendClient} from "../../NodeCMSClient";
    import * as uuid from 'uuid';
    import AttachmentAtCreation from "./Attachment.svelte";

    export let channelKey;
    let attachments = [];

    async function customPaste(event) {
        const backEndService = getBackendClient();
        for (const i of event.clipboardData.items) {
            if (i.kind === 'file') {
                const keyAndLabel = uuid.v4()
                const channel = await backEndService.getChannel(channelKey);
                attachments.push({
                    key: keyAndLabel,
                    label: keyAndLabel,
                    visibility: channel.visibility
                });
                attachments = attachments;
            }
        }
    }

    onMount(async () => {
        const backEndService = getBackendClient();
        window.setTimeout(async () => {

            const messageContent = document.getElementById('message');
            messageContent.addEventListener('paste', async (event) => {
                event.preventDefault();
                event.stopPropagation();
                await customPaste(event);
            })

            let editor = new Editor({
                target: messageContent,
                props: {
                    height: '54px',
                    actions: ['b', 'i', 'u', 'strike', 'ul', 'ol', 'viewHtml',
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
            });

            messageContent.removeAttribute('onpaste');
            messageContent.addEventListener('keyup', async (event) => {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    event.stopPropagation();
                    if (!event.ctrlKey) {
                        messageContent.querySelector('br')?.remove();
                        await backEndService.createPost(channelKey, editor.getHtml(false), attachments);
                        editor.setHtml('');
                        attachments = [];
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
                        }, 150)
                    }
                }
            })
        }, 100)
    })
</script>

<style>

    .postCreation {
        border: solid lightgray 1px;
        position : sticky;
        top:calc(100% - 105px);
        bottom : 5px;
        margin: 5px;
        min-height: 100px;
        height:auto;
        width: calc(100% - 10px);
    }

    .attachments {
        overflow-y: auto;
        display: flex;
        flex-wrap: wrap;
        width:100%;
        max-height: 60px;
    }

</style>

<div class="postCreation">

    <div id="message">

    </div>

    <div class="attachments">
        {#each attachments as attachment}
            <AttachmentAtCreation visibility={attachment.visibility} key={attachment.key} ></AttachmentAtCreation>
        {/each}
    </div>

</div>