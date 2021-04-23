<script>

    import {globalContentContainerFactory} from "../../ContentContainerFactory";
    import {EditableDocumentStore} from "../../stores/EditableDocumentStore";
    import {v4 as uuid} from 'uuid';
    import {ComponentEditorStore} from '../../stores/ComponentEditorStore';
    import hljs from 'highlight.js/lib/core';
    import json from 'highlight.js/lib/languages/json';
    import _ from 'underscore';
    hljs.registerLanguage('json', json);



    export let component;
    $ComponentEditorStore;
    let id=uuid();

    const highlight = _.debounce(hljs.highlightBlock, 500);
</script>

<svelte:head>
    <link rel="stylesheet"
          href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.2/styles/default.min.css">
</svelte:head>

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

    :global(.json-editor > textarea) {
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
        transform:scale(0.25) translateX(-100vw);
    }

    .code {
        white-space: pre;
    }

    :global(.hljs-string) {
        white-space: pre-line;
    }

</style>

<div on:click={() => {
    $ComponentEditorStore = id;
}} class="{$ComponentEditorStore === id ? 'reduced':''}">
    <svelte:component this={globalContentContainerFactory.getContentContainer(component.type)} properties={component.properties}></svelte:component>
</div>

<div id="properties-{id}" class="json-editor {$ComponentEditorStore === id?'':'hidden'}">
    <h4> Propriétés </h4>
    <div class="close" on:click={() => {
        $ComponentEditorStore = '';
    }}><i class="fal fa-window-close"></i></div>
    <div contenteditable="true" class="code" on:input={(event) => {
        console.log(event.target);
        // TODO : change in highlight and update, using debounce to update the component itself
        highlight(event.target);
        console.log(event.target.textContent);
    }}>
        {JSON.stringify(component, null, 4)}
    </div>
    <textarea on:change={(event) => {
        const reg = new RegExp(/\u00A0/g)
        const stringiFied = event.target.value;
        const newJson = JSON.parse(stringiFied.replace(reg,''))
        console.log(newJson)
        EditableDocumentStore.update(eds => {
                //todo change target for header and footer (to be set by caller)
                eds.document.content.bodies.splice(
                $EditableDocumentStore.document.content.bodies.indexOf(component),
                1,
                newJson
            );
            return eds;
        });
    }} on:keypress={(event) => {
        if(event.code === 'Enter'){
            event.preventDefault()
            event.target.blur();
        } else {
            console.log(event)
        }
    }} value={JSON.stringify(component, null, 4)}></textarea>
</div>

