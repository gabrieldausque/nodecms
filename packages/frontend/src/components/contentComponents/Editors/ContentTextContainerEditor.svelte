<script>
   import Editor from "cl-editor";
    import {v4 as uuid} from 'uuid';
    import {onMount} from 'svelte';
    import {EditableDocumentStore} from "../../../stores/EditableDocumentStore";
    import {ComponentEditorStore} from "../../../stores/ComponentEditorStore";
    import HighlightedEditor from "../HighlightedEditor.svelte";

    export let properties;
    let id = uuid();
    $ComponentEditorStore;

    onMount(() => {
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
    <label for="style">Style :</label>
    <HighlightedEditor
            id="style"
            content={properties.style}
            onChange={(newstyle) => {
                properties.style = newstyle
                updateEds();
            }}
    ></HighlightedEditor>
</div>
<div class="content">
    <label for="content-{id}">Texte :</label>
    <div id="content-{id}">
    </div>
</div>
