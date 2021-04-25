<script>

    import {globalContentContainerFactory} from "../../../../ContentContainerFactory";
    import {EditableDocumentStore} from "../../../../stores/EditableDocumentStore";
    import {v4 as uuid} from 'uuid';
    import {ComponentEditorStore} from '../../../../stores/ComponentEditorStore';
    import HighlightedEditor from "../../HighlightedEditor.svelte";

    export let component;
    $ComponentEditorStore;
    let id = uuid();

    function handleChange(code) {
        const newJson = JSON.parse(code);
        EditableDocumentStore.update(eds => {
            //todo change target for header and footer (to be set by caller)
            eds.document.content.bodies.splice(
                $EditableDocumentStore.document.content.bodies.indexOf(component),
                1,
                newJson
            );
            return eds;
        });
    }

</script>

<style>

    .json-editor {
        background: white;
        position: absolute;
        height: calc(100vh - 121px);
        width: 50vw;
        left: 50vw;
        transition: left 200ms linear;
        border-left: solid 1px lightgray;
        top: 121px;
        padding: 5px;
    }

    .json-editor div {
        text-align: left;
    }

    .json-editor.hidden {
        left: 100vw;
    }

    .json-editor h4 {
        height: 37px;
        border-bottom: solid 1px lightgray;
    }

    :global(.json-editor > .highlightEditor) {
        width: 100%;
        height: calc(100% - 45px) !important;
    }

    .close {
        position:absolute;
        top: 0;
        right: 0;
        margin-top: 2px;
        margin-right: 2px;
    }

    .reduced {
        transform:scale(0.25) translateX(-100vw) translateY(-100vh);
    }

</style>

<div on:click={() => {
    $ComponentEditorStore = id;
}} class="{$ComponentEditorStore ? 'reduced':''}">
    <svelte:component this={globalContentContainerFactory.getContentContainer(component.type)} properties={component.properties}></svelte:component>
</div>

<div id="properties-{id}" class="json-editor {$ComponentEditorStore === id?'':'hidden'}">
    <h4> Propriétés </h4>
    <div class="close" on:click={() => {
        $ComponentEditorStore = '';
    }}><i class="fal fa-window-close"></i></div>
    <HighlightedEditor
            content={JSON.stringify(component, null, 4)}
            onChange={handleChange} ></HighlightedEditor>
</div>

