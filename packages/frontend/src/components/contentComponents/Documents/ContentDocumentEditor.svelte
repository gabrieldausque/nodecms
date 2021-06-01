<script>

    import {getBackendClient} from "@nodecms/backend-client";
    import {EditableDocumentStore} from "../../../stores/EditableDocumentStore";
    import {globalContentContainerFactory} from "../../../ContentContainerFactory";
    import ContentDefaultEditor from '../Editors/ContentDefaultEditor.svelte';
    import {Helpers} from "../../../helpers/Helpers";
    import {BlockEditorComponentStore} from "../../../stores/BlockEditorComponentStore";
    import BlockEditor from "../Editors/BlockEditor.svelte";

    $EditableDocumentStore;
    $BlockEditorComponentStore;

    async function saveDocument(e) {
        const services = await getBackendClient();
        await services.documentService.updateDocument($EditableDocumentStore.document);
    }

    function onDropZoneEnter(event){
        event.preventDefault();
        if(event.target)
            event.target.classList.add('on-hover');
    }

    function onDropZoneExit(event){
        event.preventDefault();
        if(event.target)
            event.target.classList.remove('on-hover');
    }

    function onDropComponent(event){
        if(event.target)
            event.target.classList.remove('on-hover');
        const newBlock = {
            order: parseInt(event.target.getAttribute('data-order')),
            type: event.dataTransfer.getData('constructorType'),
            properties:{}
        }
        const zone = event.target.getAttribute('data-zone');
        EditableDocumentStore.update(eds => {
            if(!Array.isArray(eds.document.content[zone])){
                eds.document.content[zone] = [];
            }
            eds.document.content[zone].push(newBlock)
            return eds;
        })
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
        z-index: 3;
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

    .reduced {
        transform: scale(0.4) translateX(-72%) translateY(-72%);
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

    .drop-zone {
        height:20px;
    }

    .drop-zone.on-hover {
        background: red;
    }

</style>

<main class="editor-main">
    <div id="toolbox">
        {#each globalContentContainerFactory.getConstructors() as constructorMetadata}
            {#if constructorMetadata.title}
                <div draggable="true"
                     class="content-button {constructorMetadata.cssClasses}"
                     title="{constructorMetadata.title}"
                     on:dragstart={(event) => {
                         event.dataTransfer.moveEffect = 'copy';
                         event.dataTransfer.setData('constructorType', constructorMetadata.type)
                     }}
                >
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
                    <div id="document-headers" class="{$BlockEditorComponentStore.zone === 'headers'?'reduced':''}">
                        {#if Array.isArray($EditableDocumentStore.document.content.headers) &&
                        $EditableDocumentStore.document.content.headers.length > 0}
                            {#each $EditableDocumentStore.document.content.headers.sort((c1, c2) => {
                                if(c1.order > c2.order)
                                    return 1;
                                if(c1.order < c2.order)
                                    return -1;
                                return 0;
                            }) as headerComponent}
                                <div class="drop-zone"
                                     data-zone="headers"
                                     data-order="{typeof headerComponent.order === 'number'?headerComponent.order - 1:0}"
                                     on:dragenter={onDropZoneEnter}
                                     on:dragleave={onDropZoneExit}
                                     on:drop={onDropComponent}
                                     on:dragover={(event) => { event.preventDefault(); return false;}}
                                ></div>
                                <BlockEditor component={headerComponent} zone="headers"></BlockEditor>
                                <div class="drop-zone"
                                     data-zone="headers"
                                     on:dragenter={onDropZoneEnter}
                                     on:dragleave={onDropZoneExit}
                                     on:drop={onDropComponent}
                                     on:dragover={(event) => { event.preventDefault(); return false;}}
                                     data-order="{typeof headerComponent.order === 'number' ? headerComponent.order + 1:1}"
                                ></div>
                            {/each}
                        {:else}
                            <div class="drop-zone"
                                 data-order="0"
                                 data-zone="headers"
                                 on:dragenter={onDropZoneEnter}
                                 on:dragleave={onDropZoneExit}
                                 on:drop={onDropComponent}
                                 on:dragover={(event) => { event.preventDefault(); return false;}}
                            ></div>
                        {/if }
                    </div>
                </div>
                <div id="bodies" class="section">
                    <h5>Corps</h5>
                    <div id="document-bodies" class="{$BlockEditorComponentStore.zone === 'bodies'?'reduced':''}">
                        {#if Array.isArray($EditableDocumentStore.document.content.bodies)}
                            {#each [...$EditableDocumentStore.document.content.bodies].sort((c1, c2) => {
                                if(c1.order > c2.order)
                                    return 1;
                                if(c1.order < c2.order)
                                    return -1;
                                return 0;
                            }) as bodyComponent}
                                <div class="drop-zone"
                                     data-zone="bodies"
                                     data-order="{typeof bodyComponent.order === 'number'?bodyComponent.order - 1:0}"
                                     on:dragenter={onDropZoneEnter}
                                     on:dragleave={onDropZoneExit}
                                     on:drop={onDropComponent}
                                     on:dragover={(event) => { event.preventDefault(); return false;}}
                                ></div>
                                <BlockEditor component={bodyComponent} zone="bodies"></BlockEditor>
                                <div class="drop-zone"
                                     data-zone="bodies"
                                     on:dragenter={onDropZoneEnter}
                                     on:dragleave={onDropZoneExit}
                                     on:drop={onDropComponent}
                                     on:dragover={(event) => { event.preventDefault(); return false;}}
                                     data-order="{typeof bodyComponent.order === 'number' ? bodyComponent.order + 1:1}"
                                ></div>
                            {/each}
                        {:else}
                            <div class="drop-zone"
                                 data-order="0"
                                 data-zone="bodies"
                                 on:dragenter={onDropZoneEnter}
                                 on:dragleave={onDropZoneExit}
                                 on:drop={onDropComponent}
                                 on:dragover={(event) => { event.preventDefault(); return false;}}
                            ></div>
                        {/if }
                    </div>
                </div>
                <div id="footers" class="section">
                    <h5>Pied de page</h5>
                    <div id="document-footers" class="{$BlockEditorComponentStore.zone === 'footers'?'reduced':''}">
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
                                <div class="drop-zone"
                                     data-zone="footers"
                                     data-order="{typeof footerComponent.order === 'number'?footerComponent.order - 1:0}"
                                     on:dragenter={onDropZoneEnter}
                                     on:dragleave={onDropZoneExit}
                                     on:drop={onDropComponent}
                                     on:dragover={(event) => { event.preventDefault(); return false;}}
                                ></div>
                                <BlockEditor component={footerComponent} zone="footers"></BlockEditor>
                                <div class="drop-zone"
                                     data-zone="footers"
                                     on:dragenter={onDropZoneEnter}
                                     on:dragleave={onDropZoneExit}
                                     on:drop={onDropComponent}
                                     on:dragover={(event) => { event.preventDefault(); return false;}}
                                     data-order="{typeof footerComponent.order === 'number' ? footerComponent.order + 1:1}"
                                ></div>
                            {/each}
                        {:else}
                            <div class="drop-zone"
                                 data-order="0"
                                 data-zone="footers"
                                 on:dragenter={onDropZoneEnter}
                                 on:dragleave={onDropZoneExit}
                                 on:drop={onDropComponent}
                                 on:dragover={(event) => { event.preventDefault(); return false;}}
                            ></div>
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