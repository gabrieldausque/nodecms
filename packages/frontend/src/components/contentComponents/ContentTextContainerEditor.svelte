<script>
    import ContentTextContainer from "./ContentTextContainer.svelte";
    import Editor from "cl-editor";
    import {v4 as uuid} from 'uuid';
    import {onMount} from 'svelte';
    import {EditableDocumentStore} from "../../stores/EditableDocumentStore";

    export let properties;
    let id=uuid();

    onMount(() => {
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
                properties.content = editor.getHtml()
                console.log($EditableDocumentStore);
            })
        })
    })

</script>

<style>

    .properties-editor {
        background: white;
    }

    .properties-editor label {

    }

    .properties-editor div {
        text-align: left;
    }

</style>

<div>
    <div>
        <ContentTextContainer properties="{properties}"></ContentTextContainer>
    </div>
    <div class="properties-editor">
        <div class="">
            <label for="classes">Classes</label>
            <input id="classes" type="text" class="form-control" placeholder="Taper le nom des classes css séparées par un espace" bind:value={properties.classes}>
        </div>
        <div class="">
            <label for="style">Style</label>
            <textarea id="style"
                      placeholder="Taper le style css"
                      bind:value={properties.style}
            ></textarea>
        </div>
        <div class="">
            <label for="content-{id}">Texte</label>
            <div id="content-{id}">
            </div>
        </div>
    </div>
</div>