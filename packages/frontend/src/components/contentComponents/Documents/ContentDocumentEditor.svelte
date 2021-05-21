<script>

    import {EditableDocumentStore} from "../../../stores/EditableDocumentStore";
    import {globalContentContainerFactory} from "../../../ContentContainerFactory";
    import ContentDefaultEditor from '../Editors/ContentDefaultEditor.svelte';
    import {Helpers} from "../../../helpers/Helpers";
    import {BlockEditorComponentStore} from "../../../stores/BlockEditorComponentStore";
    import BlockEditor from "../Editors/BlockEditor.svelte";

    $EditableDocumentStore;
    $BlockEditorComponentStore;

    function handleDragStart(e) {
        e.dataTransfer.dropEffect = 'copy';
        e.dataTransfer.setData('template', 'todefine');
    }

    async function saveDocument(e) {
        const services = await getBackendClient();
        await services.documentService.updateDocument($EditableDocumentStore.document);
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
        justify-content: flex-end;
        align-items: center;
        padding: 2px;
        border-bottom: solid 1px lightgray;
        height:50px;
    }

    .toolbarButton {
        margin: 0 5px;
        width: 30px;
        height: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
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
        transform: scale(0.4) translateX(-72%);
    }

    .editor-content {
        max-height: calc(100% - 37px);
        overflow-y: auto;
    }

    #headers,
    #footers {
        position:relative;
        min-height: 15%;
        height:auto;
    }

    #bodies {
        position: relative;
        min-height: 70%;
        height:auto
    }

    #document-headers,
    #document-footers,
    #document-bodies {
        min-height: calc(100% - 41px);
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
                <button on:click={saveDocument} class="toolbarButton" type="button" title="Enregistrer">
                    <i class="fas fa-save"></i>
                </button>
                <button type="button" class="toolbarButton" title="Paramètres du document">
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
                                <BlockEditor component="headerComponent" zone="header"></BlockEditor>
                            {/each}
                        {/if }
                    </div>
                </div>
                <div id="bodies" class="section">
                    <h5>Corps</h5>
                    <div id="document-bodies" class="drop-zone {$BlockEditorComponentStore.zone === 'body'?'reduced':''}">
                        {#if Array.isArray($EditableDocumentStore.document.content.bodies)}
                            {#each [...$EditableDocumentStore.document.content.bodies].sort((c1, c2) => {
                                if(c1.order > c2.order)
                                    return 1;
                                if(c1.order < c2.order)
                                    return -1;
                                return 0;
                            }) as bodyComponent}
                                <BlockEditor component={bodyComponent} zone="body"></BlockEditor>
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
                                <BlockEditor component={footerComponent} zone="footer"></BlockEditor>
                            {/each}
                        {/if }
                    </div>
                </div>
            </div>

        {/if}
    </div>
    <div class="editor-panel {$BlockEditorComponentStore.component?'':'hidden'}">
        <h4> Propriétés </h4>
        <div class="close" on:click={() => {
        $BlockEditorComponentStore.component = undefined;
        $BlockEditorComponentStore.zone = undefined;
    }}><i class="fal fa-window-close"></i></div>
        <div class="editor-content">
            {#if $BlockEditorComponentStore.component}
                {#if globalContentContainerFactory.registeredConstructors[$BlockEditorComponentStore.component.type].editorConstructor}
                    <svelte:component this="{globalContentContainerFactory.registeredConstructors[$BlockEditorComponentStore.component.type].editorConstructor}"
                                      properties="{$BlockEditorComponentStore.component.properties}"></svelte:component>
                {:else}
                    <ContentDefaultEditor component={$BlockEditorComponentStore.component}></ContentDefaultEditor>
                {/if}
            {/if}
        </div>
    </div>
</main>