<script>

    import Editor from "cl-editor/src/Editor.svelte";
    import {afterUpdate, onMount} from "svelte";
    import {getBackendClient} from "@nodecms/backend-client";
    import * as uuid from 'uuid';
    import AttachmentAtCreation from "./Attachment.svelte";
    import _ from 'underscore';
    import {MediaService} from "@nodecms/backend-client";

    export let channelKey;
    export let parentPost;
    export let targetId;
    let attachments = [];

    const authorizedMimeTypes = MediaService.AuthorizedMimeTypes;

    async function customPaste(file, label) {
        const backEndService = await getBackendClient();
        const keyAndLabel = uuid.v4()
        const channel = await backEndService.channelsService.getChannel(channelKey);
        attachments.push({
            key: keyAndLabel,
            label: label?label:keyAndLabel,
            visibility: channel.visibility,
            file: file,
            uploaded: false
        });
        attachments = attachments;
    }

    const scanText = _.debounce(() => {
        console.log('scanning text ...')
        const messageContent = document.querySelector('.cl-content')
        const urlRegexp = /(https*?:\/\/[^\s<>"]+)/g
        const urlGroups = messageContent.innerHTML.match(urlRegexp);
        if(Array.isArray(urlGroups)){
            for(const u of urlGroups){
                messageContent.innerHTML = messageContent.innerHTML.replace(u, `<a data-link="true" href="${u.trim()}" target="_blank">${u.trim()}</a>`)
            }
        }
    }, 1000, false);

    async function pasteEventHandler(event) {
        event.preventDefault();
        event.stopPropagation();
        for (const i of event.clipboardData.items) {
            if (i.kind === 'file') {
                const f = i.getAsFile();
                await customPaste(f);
            } else if (i.kind === 'string') {
                let paste = (event.clipboardData || window.clipboardData).getData('text');
                const selection = window.getSelection();
                if (!selection.rangeCount) return false;
                const urlRegexp = /^(https*?:\/\/[^\s]+$)/g
                const urlGroups = paste.match(urlRegexp);
                if (Array.isArray(urlGroups)) {
                    for (const u of urlGroups) {
                        const d = document.createElement("div");
                        d.innerHTML = `<a data-link="true" href="${u.trim()}" target="_blank">${u.trim()}</a>`
                        selection.deleteFromDocument();
                        selection.getRangeAt(0).insertNode(d.firstChild);
                        selection.collapseToEnd();
                    }
                } else {
                    selection.deleteFromDocument();
                    selection.getRangeAt(0).insertNode(document.createTextNode(paste));
                    selection.collapseToEnd();
                }
            }
        }
    }
    
    afterUpdate(() => {
        window.setTimeout(() => {
            if(targetId){
                const messageContent = document.getElementById(targetId);
                if(messageContent.childElementCount === 0) {
                    messageContent.addEventListener('paste', pasteEventHandler, true);
                    let editor = new Editor({
                        target: messageContent,
                        props: {
                            height: '54px',
                            actions: ['b', 'i', 'u', 'strike', 'ul', 'ol', 'viewHtml',
                                {
                                    name: 'paste',
                                    icon: '<i class="fas fa-paste"></i>',
                                    title: 'Coller',
                                    result: async () => {
                                        const read = await navigator.clipboard.read()
                                        if (read && read.length > 0) {
                                            const item = read[0];
                                            if (Array.isArray(item.types) && item.types.length > 0) {
                                                const type = item.types[0];
                                                console.log(type);
                                                const blob = await item.getType(type);
                                                if (type.indexOf('image') >= 0) {
                                                    const file = new File([blob], 'image');
                                                    await customPaste(file);
                                                } else if (type.indexOf('text') >= 0) {
                                                    const reader = new FileReader()
                                                    reader.onload = (e) => {
                                                        const content = messageContent.querySelector('.cl-content');
                                                        content.append(reader.result.toString());
                                                        content.focus();
                                                        document.execCommand('selectAll', false, null);
                                                        document.getSelection().collapseToEnd();
                                                        content.scrollTop = content.scrollHeight;
                                                    }
                                                    reader.readAsText(blob);
                                                }
                                            }
                                        }
                                    }
                                },
                                {
                                    name: 'attach',
                                    icon: '<i class="fas fa-paperclip"></i>',
                                    title: 'Ajouter une pièce jointe',
                                    result: async () => {
                                        const input = document.createElement('input');
                                        input.type = 'file';
                                        input.accept = authorizedMimeTypes.join(',');
                                        input.onchange = (e) => {
                                            if (input.files) {
                                                for (const file of input.files) {
                                                    customPaste(file, file.name);
                                                }
                                            }
                                        }
                                        input.click();
                                    }
                                }
                            ]
                        }
                    });
                    messageContent.addEventListener('keyup', async (event) => {
                        const backEndService = await getBackendClient();
                        if (event.key === 'Enter') {
                            event.preventDefault();
                            event.stopPropagation();
                            if (!event.ctrlKey) {
                                if (!document.querySelectorAll('.attachment-upload').length) {
                                    messageContent.querySelector('br')?.remove();
                                    await backEndService.postService.createPost(channelKey, editor.getHtml(false), attachments, parentPost);
                                    editor.setHtml('');
                                    attachments = [];
                                }
                            } else {
                                window.setTimeout(() => {
                                    const carriageReturn = document.createElement('div');
                                    carriageReturn.innerHTML = '<br>'
                                    const content = messageContent.querySelector('.cl-content');
                                    content.append(carriageReturn);
                                    content.focus();
                                    document.execCommand('selectAll', false, null);
                                    document.getSelection().collapseToEnd();
                                    content.scrollTop = content.scrollHeight;
                                }, 150)
                            }
                        }
                    })
                }
            }
        }, 150)
    })

</script>

<style>

    .postCreation {
        border: solid lightgray 1px;
        position : sticky;
        bottom : 5px;
        margin: 5px;
        height:auto;
        width: calc(100% - 10px);
        top: calc(100vh - 100px);
    }

    .attachments {
        overflow-y: auto;
        display: flex;
        flex-wrap: wrap;
        width:100%;
        max-height: 60px;
    }

    .cl-content,
    .cl-actionbar {
        text-align: start;
    }

    div {
        text-align: start;
    }

</style>

<div class="postCreation">

    <div id="{targetId}">

    </div>

    <div class="attachments">
        {#each attachments as attachment}
            <AttachmentAtCreation visibility={attachment.visibility} key={attachment.key} label={attachment.label} file="{attachment.file}" associatedChannel={channelKey} ></AttachmentAtCreation>
        {/each}
    </div>

</div>