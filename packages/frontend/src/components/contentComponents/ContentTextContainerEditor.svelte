<script>
    import ContentTextContainer from "./ContentTextContainer.svelte";
    import Editor from "cl-editor";
    import {v4 as uuid} from 'uuid';
    import {onMount} from 'svelte';
    import {EditableDocumentStore} from "../../stores/EditableDocumentStore";
    import {ComponentEditorStore} from "../../stores/ComponentEditorStore";

    export let properties;
    let id=uuid();
    $ComponentEditorStore;

    onMount(() => {
        console.log($ComponentEditorStore);
        window.setTimeout(() => {
            const contentText = document.getElementById(`content-${id}`)
            console.log(contentText);
            const editor = new Editor({
                target: contentText,
                props:{
                    actions: [
                        'b', 'i', 'u', 'strike', 'ul', 'ol', 'viewHtml'
                    ],
                    html:properties.content
                }
            });
            editor.$on('change', (e) => {
                properties.content = editor.getHtml();
            })
        })
    })

</script>

<style>

    .text-properties-editor {
        background: white;
        position: absolute;
        height: calc(100vh - 121px);
        width: 25vw;
        left: 75vw;
        transition: left 200ms linear;
        border-left: solid 1px lightgray;
        top: 121px;
        padding: 5px;
    }

    .text-properties-editor div {
        text-align: left;
        border-bottom: solid 1px lightgray;
    }

    .text-properties-editor.hidden {
        left: 100vw;
    }

    .text-properties-editor h4 {
        border-bottom: solid 1px lightgray;
    }

    .close {
        position:absolute;
        top: 0;
        right: 0;
        margin-top: 2px;
        margin-right: 2px;
    }

    .reduced {
        transform:scale(0.50) translateX(-25vw);
    }

</style>

<div on:click={() => {
    $ComponentEditorStore = id;
}} class="{$ComponentEditorStore === id ? 'reduced':''}">
    <ContentTextContainer properties="{properties}"></ContentTextContainer>
</div>

<div id="properties-{id}" class="text-properties-editor {$ComponentEditorStore === id ?'':'hidden'}">
    <h4>Propriétés</h4>
    <div class="close" on:click={() => {
        $ComponentEditorStore = '';
    }}><i class="fal fa-window-close"></i></div>
    <div class="">
        <label for="classes">CSS Classes :</label>
        <input id="classes" type="text" class="form-control" placeholder="Taper le nom des classes css séparées par un espace" bind:value={properties.classes}>
    </div>
    <div class="">
        <label for="style">Style :</label>
        <textarea id="style"
                  placeholder="Taper le style css"
                  bind:value={properties.style}
        ></textarea>
    </div>
    <div class="">
        <label for="content-{id}">Texte :</label>
        <div id="content-{id}">
        </div>
    </div>
</div>