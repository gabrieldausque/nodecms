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

    afterUpdate(() => {
        console.log('editor updated');
    })

    onMount(() => {
        window.setTimeout(() => {
            const contentText = document.getElementById(`content-${id}`)
            console.log(contentText);
            const editor = new Editor({
                target: contentText,
                props: {
                    actions: [
                        'left', 'center','right','justify','b', 'i', 'u', 'strike', 'ul', 'ol', 'a','viewHtml',
                    ],
                    html: properties.title
                }
            });
            editor.$on('change', (e) => {
                properties.title = editor.getHtml();
                updateEds();
            })
        })
    })

    function updateEds() {
        EditableDocumentStore.update(eds => {
            return eds;
        })
    }

</script>

<style>

    label {
        text-align: start;
    }

    .content {
        text-align: start;
    }

</style>

<div class="">
    <label for="classes">CSS Classes :</label>
    <input id="classes" type="text" class="form-control" placeholder="Taper le nom des classes css séparées par un espace" bind:value={properties.classes}>
</div>
<div class="style">
    <label for={`style-${id}`}>Container Style :</label>
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

