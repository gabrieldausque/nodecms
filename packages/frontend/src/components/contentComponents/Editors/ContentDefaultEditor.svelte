<script>

    import {globalContentContainerFactory} from "../../../ContentContainerFactory";
    import {EditableDocumentStore} from "../../../stores/EditableDocumentStore";
    import {v4 as uuid} from 'uuid';
    import {ComponentEditorStore} from '../../../stores/ComponentEditorStore';
    import HighlightedEditor from "../HighlightedEditor.svelte";

    export let component;
    $ComponentEditorStore;
    let id = uuid();

    function handleChange(code) {
        const newJson = JSON.parse(code);
        console.log(newJson)
        EditableDocumentStore.update(eds => {
            //todo change target for header and footer (to be set by caller)
            eds.document.content.bodies.splice(
                $EditableDocumentStore.document.content.bodies.indexOf(component),
                1,
                newJson
            );
            console.log(eds);
            return eds;
        });
    }

</script>

<style>

    .highlightEditor {
        width: 100%;
        height: calc(100% - 45px) !important;
        overflow-y: auto;
        overflow-x: none;

    }


</style>

<HighlightedEditor
        content={JSON.stringify(component, null, 4)}
        onChange={handleChange} ></HighlightedEditor>

