<script>

    import Editor from "cl-editor";
    import {onMount} from "svelte";
    import {getBackendClient} from "../../api/NodeCMSClient";
    import * as uuid from 'uuid';
    import AttachmentAtCreation from "./Attachment.svelte";
    import _ from 'underscore';

    export let channelKey;
    let attachments = [];
    const authorizedMimeTypes = [
        'image/gif',
        'image/png',
        'image/jpeg',
        'image/bmp',
        'image/webp',
        'image/svg+xml',
        'audio/mp3',
        'audio/mpeg',
        'audio/webm',
        'audio/ogg',
        'audio/aac',
        'audio/wav',
        'video/webm',
        'video/ogg',
        'video/mp4',
        'video/x-msvideo',
        'application/pdf'
    ]
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
        const urlRegexp = /(?!<a>)(https*?:\/\/[^\s<>]+)(?!<\/a>)/g
        const urlGroups = messageContent.innerHTML.match(urlRegexp);
        console.log(urlGroups);
        if(Array.isArray(urlGroups)){
            for(const u of urlGroups){
                console.log('replacing u');
                const index = messageContent.innerHTML.indexOf(u);
                messageContent.innerHTML = messageContent.innerHTML.replace(u, `<a href="${u}" target="_blank">${u}</a>`)
            }
        }
    }, 1000, false);

    onMount(async () => {
        const backEndService = await getBackendClient();
        window.setTimeout(async () => {
            const messageContent = document.getElementById('message');
            messageContent.addEventListener('paste', async (event) => {
                event.preventDefault();
                event.stopPropagation();
                for (const i of event.clipboardData.items) {
                    if (i.kind === 'file') {
                        const f = i.getAsFile();
                        await customPaste(f);
                    }
                }
            })
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
                                if(read && read.length > 0) {
                                    const item = read[0];
                                    if(Array.isArray(item.types) && item.types.length > 0){
                                        const type = item.types[0];
                                        console.log(type);
                                        const blob = await item.getType(type);
                                        if(type.indexOf('image') >= 0){
                                            const file = new File([blob], 'image');
                                            await customPaste(file);
                                        } else if(type.indexOf('text') >= 0){
                                            const reader = new FileReader()
                                            reader.onload = (e) => {
                                                const content = messageContent.querySelector('.cl-content');
                                                content.append(reader.result.toString());
                                                content.focus();
                                                document.execCommand('selectAll',false, null);
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
                            result: async() => {
                                const input = document.createElement('input');
                                input.type = 'file';
                                input.accept = authorizedMimeTypes.join(',');
                                input.onchange = (e) => {
                                    console.log(input.files);
                                    if(input.files) {
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

            messageContent.removeAttribute('onpaste');
            messageContent.addEventListener('keyup', async (event) => {
                if (event.key === 'Enter' ) {
                    event.preventDefault();
                    event.stopPropagation();
                    if (!event.ctrlKey) {
                        if(!document.querySelectorAll('.attachment-upload').length){
                            messageContent.querySelector('br')?.remove();
                            await backEndService.postService.createPost(channelKey, editor.getHtml(false), attachments);
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
                            document.execCommand('selectAll',false, null);
                            document.getSelection().collapseToEnd();
                            content.scrollTop = content.scrollHeight;
                        }, 150)
                    }
                }
                scanText();
            })
            document.querySelector('.cl-textarea').addEventListener('change', async(event) => {

            })
        }, 100)
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

    <div id="message">

    </div>

    <div class="attachments">
        {#each attachments as attachment}
            <AttachmentAtCreation visibility={attachment.visibility} key={attachment.key} label={attachment.label} file="{attachment.file}" associatedChannel={channelKey} ></AttachmentAtCreation>
        {/each}
    </div>

</div>