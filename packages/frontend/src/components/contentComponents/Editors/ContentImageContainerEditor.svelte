<script>
    import Editor from "cl-editor/src/Editor.svelte";
    import {v4 as uuid} from 'uuid';
    import {onMount, afterUpdate} from 'svelte';
    import {EditableDocumentStore} from "../../../stores/EditableDocumentStore";
    import {ComponentEditorStore} from "../../../stores/ComponentEditorStore";
    import HighlightedEditor from "../HighlightedEditor.svelte";

    export let properties;
    let id = uuid();
    $ComponentEditorStore;

    onMount(() => {
        if(!properties.uri){
            properties.uri = '';
            properties = properties;
        }
        window.setTimeout(() => {
            const contentText = document.getElementById(`content-${id}`)
            console.log(contentText);
            const editor = new Editor({
                target: contentText,
                props: {
                    actions: [
                        'b', 'i', 'u', 'strike', 'ul', 'ol', 'viewHtml'
                    ],
                    html: properties.content
                }
            });
            editor.$on('change', (e) => {
                properties.content = editor.getHtml();
                updateEds();
            })
        })
    })

    function updateEds() {
        EditableDocumentStore.update(eds => {
            return eds;
        })
    }

    afterUpdate(() => {
        console.log('editor updated');
    })

</script>

<style>

    label {
        text-align: start;
    }

    .content {
        text-align: start;
    }

</style>

<div class="url">
    <label for="uri-{id}">Url</label>
    <input id="uri-{id}" value={properties.uri?properties.uri:''} type="url" class="form-control" placeholder="Taper l'url de l'image"
           on:blur={() => {
               properties.uri = document.getElementById(`uri-${id}`).value;
               updateEds();
           }}>
</div>
<div class="classes">
    <label for="classes">CSS Classes :</label>
    <input id="classes" type="text" class="form-control" placeholder="Taper le nom des classes css séparées par un espace" bind:value={properties.classes}>
</div>
<div class="style">
    <label for={`style-${id}`}>Style :</label>
    <HighlightedEditor
            id={`style-${id}`}
            content={properties.style?properties.style:''}
            onChange={(newStyle) => {
                properties.style = newStyle
                updateEds();
            }}
    ></HighlightedEditor>
</div>
<div class="style">
    <label for={`global-style-${id}`}>Global Style :</label>
    <HighlightedEditor
            id={`global-style-${id}`}
            content={properties.globalStyle?properties.innerStyle:''}
            onChange={(newStyle) => {
                properties.globalStyle = newStyle
                updateEds();
            }}
    ></HighlightedEditor>
</div>
<div class="content">
    <label for="content-{id}">Texte :</label>
    <div id="content-{id}">
    </div>
</div>

