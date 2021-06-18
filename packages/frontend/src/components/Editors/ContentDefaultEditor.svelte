<script>

    import {EditableDocumentStore} from "../../stores/EditableDocumentStore";
    import {v4 as uuid} from 'uuid';
    import HighlightedEditor from "../HighlightedEditor.svelte";

    export let component;
    let id = uuid();

    function handleChange(code) {
        const newJson = JSON.parse(code);
        for(const propName in newJson){
            if(newJson.hasOwnProperty(propName)){
                component[propName] = newJson[propName];
            }
        }
        EditableDocumentStore.update(eds => {
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

