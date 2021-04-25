<script>

    import {EditableDocumentStore} from "../../../stores/EditableDocumentStore";
    import {globalContentContainerFactory} from "../../../ContentContainerFactory";
    import {beforeUpdate, afterUpdate, onDestroy} from 'svelte';
    import ContentDefaultEditor from '../Editors/ContentDefaultEditor.svelte';
    import {Helpers} from "../../../helpers/Helpers";

    $EditableDocumentStore;
    let blockEditorComponent = {
        component:undefined,
        zone:undefined
    };

    function handleDragStart(e) {
        e.dataTransfer.dropEffect = 'copy';
        e.dataTransfer.setData('template', 'todefine');
    }

</script>

<style>
    .content-button {
        height: 100px;
        width: 100px;
        font-size: xx-large;
        display: flex;
        align-items: center;
        justify-content: center;
        margin:10px;
        border: solid 1px lightgray;
        border-radius: 15px;
    }

    .editor-main
    {
        height: 100%;
        width: 100%;
        max-height:100%;
        min-height:100%;
        max-width:100%;
        min-width:100%;
        display: flex;
        flex-direction: row;
    }

    #toolbox {
        background: white;
        width: 120px;
        display: flex;
        flex-wrap: wrap;
        align-content: flex-start;
        padding: 10px;
        border-right: solid 1px lightgray;
    }

    #document {
        width: calc(100vw - 120px);
        height: 100%;
        max-height: 100%;
        min-height: 100%;
        overflow: hidden;
    }

    .documentEditorContent {
        overflow-y: auto;
        overflow-x: hidden;
        height: calc(100% - 50px);
    }

    .documentEditorMenuBar {
        background: white;
        display: flex;
        padding: 2px;
        border-bottom: solid 1px lightgray;
        height:50px;
    }

    #documentSettingsButton {
        margin-left:auto;
        margin-right:0;
    }

    .section {
        min-height: 150px;
        border-bottom: solid 1px lightgray;
        text-align: center;
        margin: 0 auto;
        background: black;
        padding: 0;
        display: flex;
        flex-direction: column;
    }

    .section > h5 {
        background: white;
        text-align: start;
        padding: 4px;
        border-bottom: solid 1px lightgray;
        box-shadow: inset 0px -3px 18px -14px;
        margin-bottom: 100px;
    }

    .editor-panel {
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

    .editor-panel div {
        text-align: left;
    }

    .editor-panel.hidden {
        left: 100vw;
    }

    .editor-panel h4 {
        height: 37px;
        border-bottom: solid 1px lightgray;
    }

    :global(.editor-panel > .highlightEditor) {
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

    .drop-zone.reduced {
        transform: scale(0.4) translateX(-60vw);
    }

</style>

<main class="editor-main">
    <div id="toolbox">
        {#each globalContentContainerFactory.getConstructors() as constructorMetadata}
            {#if constructorMetadata.title}
                <div draggable="true"
                     on:dragstart={handleDragStart}
                     class="content-button {constructorMetadata.cssClasses}"
                     title="{constructorMetadata.title}">
                </div>
            {/if}
        {/each}
    </div>
    <div id="document">
        {#if $EditableDocumentStore.document}
            {#if typeof $EditableDocumentStore.document.content.globalStyle === "string"}
                {@html Helpers.styleOpeningLabel + $EditableDocumentStore.document.content.globalStyle + Helpers.styleClosingLabel}
            {/if}
            <div class="documentEditorMenuBar">
                <button id="documentSettingsButton" type="button" title="Paramètres du document">
                    <i class="fas fa-cogs"></i>
                </button>
            </div>
            <div class="documentEditorContent">
                <div id="headers" class="section">
                    <h5>En tête</h5>
                    <div id="document-headers" class="drop-zone">
                        {#if Array.isArray($EditableDocumentStore.document.content.headers)}
                            {#each $EditableDocumentStore.document.content.headers.sort((c1, c2) => {
                                if(c1.order > c2.order)
                                    return 1;
                                if(c1.order < c2.order)
                                    return -1;
                                return 0;
                            }) as headerComponent}
                                {#if globalContentContainerFactory.registeredConstructors[headerComponent.type].editorConstructor}
                                    <svelte:component this="{globalContentContainerFactory.registeredConstructors[headerComponent.type].editorConstructor}"
                                                      properties="{headerComponent.properties}"></svelte:component>
                                {:else}
                                    <ContentDefaultEditor component={headerComponent}></ContentDefaultEditor>
                                {/if}
                            {/each}
                        {/if }
                    </div>
                </div>
                <div id="bodies" class="section">
                    <h5>Corps</h5>
                    <div id="document-bodies" class="drop-zone {blockEditorComponent.zone === 'body'?'reduced':''}">
                        {#if Array.isArray($EditableDocumentStore.document.content.bodies)}
                            {#each $EditableDocumentStore.document.content.bodies.sort((c1, c2) => {
                                if(c1.order > c2.order)
                                    return 1;
                                if(c1.order < c2.order)
                                    return -1;
                                return 0;
                            }) as bodyComponent}
                                <div on:click={() => {
                                    blockEditorComponent.component = bodyComponent;
                                    blockEditorComponent.zone = 'body'
                                }}>
                                    <svelte:component this="{globalContentContainerFactory.getContentContainer(bodyComponent.type)}" properties="{bodyComponent.properties}"></svelte:component>
                                </div>
                            {/each}
                        {/if }
                    </div>
                </div>
                <div id="footers" class="section">
                    <h5>Pied de page</h5>
                    <div id="document-footers" class="drop-zone">
                        {#if Array.isArray($EditableDocumentStore.document.content.footers)}
                            {#each $EditableDocumentStore.document.content.footers.sort((c1, c2) => {
                                console.log(c1);
                                console.log(c2);
                                if(c1.order > c2.order)
                                    return 1;
                                if(c1.order < c2.order)
                                    return -1;
                                return 0;
                            }) as footerComponent}
                                {#if globalContentContainerFactory.registeredConstructors[footerComponent.type].editorConstructor}
                                    <svelte:component this="{globalContentContainerFactory.registeredConstructors[footerComponent.type].editorConstructor}"
                                                      properties="{footerComponent.properties}"></svelte:component>
                                {:else}
                                    <ContentDefaultEditor component={footerComponent}></ContentDefaultEditor>
                                {/if}
                            {/each}
                        {/if }
                    </div>
                </div>
            </div>

        {/if}
    </div>
    <div class="editor-panel {blockEditorComponent.component?'':'hidden'}">
        <h4> Propriétés </h4>
        <div class="close" on:click={() => {
        blockEditorComponent.component = undefined;
        blockEditorComponent.zone = undefined;
    }}><i class="fal fa-window-close"></i></div>
        {#if blockEditorComponent.component}
            {#if globalContentContainerFactory.registeredConstructors[blockEditorComponent.component.type].editorConstructor}
                <svelte:component this="{globalContentContainerFactory.registeredConstructors[blockEditorComponent.component.type].editorConstructor}"
                                  properties="{blockEditorComponent.component.properties}"></svelte:component>
            {:else}
                <ContentDefaultEditor component={blockEditorComponent.component}></ContentDefaultEditor>
            {/if}
        {/if}
    </div>
</main>