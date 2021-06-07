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
            order: typeof event.target.getAttribute('data-order') === 'string'?
                parseInt(event.target.getAttribute('data-order')):0,
            type: event.dataTransfer.getData('constructorType'),
            properties:{}
        }
        const layout = event.target.getAttribute('data-layout');
        const zone = event.target.getAttribute('data-zone');

        if(layout === 'grid'){
            let row = parseInt(event.target.getAttribute('data-row'));
            if(event.target.classList.contains('new-row')){
                for(const component of $EditableDocumentStore.document.content[zone]){
                    if(component.properties.row >= row){
                        component.properties.row++;
                    }
                }
            }
            newBlock.properties.row = row;
            newBlock.properties.col = parseInt(event.target.getAttribute('data-col'));
        }
        EditableDocumentStore.update(eds => {
            if(!Array.isArray(eds.document.content[zone])){
                eds.document.content[zone] = [];
            }
            eds.document.content[zone].push(newBlock);
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
        min-height: 100%;
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

    .container.reduced {
        transform: scale(0.4) translateX(-106%) translateY(-19%);
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
        height:auto;
    }

    #document-headers,
    #document-footers,
    #document-bodies {
        min-height: calc(100% - 41px);
        height:100%;
        flex-grow: 1;
    }

    #document-headers.container,
    #document-footers.container,
    #document-bodies.container {
        display: flex;
        flex-direction: column;
    }

    #document-headers.container > div.row,
    #document-footers.container > div.row,
    #document-bodies.container > div.row {
        flex-grow: 1;
        margin: 0 !important;
    }

    .drop-zone {
        min-height:20px;
        min-width:10px;
        border: dashed 1px;
    }

    .drop-zone.on-hover {
        background: red;
    }

    .new-row {
        max-height: 20px;
        width: 100%;
    }

    .components-col {
        padding: 0;
        display:flex;
        justify-content: center;
        align-items: center;
    }

    :global(.components-col > div.component-container) {
        width:100%;
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
                    <div id="document-bodies" class="{$BlockEditorComponentStore.zone === 'bodies'?'reduced':''}
                    {
                        $EditableDocumentStore.document.content.layout &&
                        $EditableDocumentStore.document.content.layout.bodies &&
                        $EditableDocumentStore.document.content.layout.bodies.type === 'grid'?
                        'container':
                        ''
                    }">
                        {#if Array.isArray($EditableDocumentStore.document.content.bodies)}
                            {#if $EditableDocumentStore.document.content.layout &&
                            $EditableDocumentStore.document.content.layout.bodies &&
                            $EditableDocumentStore.document.content.layout.bodies.type === 'grid'}
                                {#each Helpers.getRows($EditableDocumentStore.document.content.bodies) as row,rowIndex}
                                    {#if rowIndex > 0}
                                        <div class="new-row drop-zone"
                                             data-zone="bodies"
                                             data-layout="grid"
                                             data-row="{rowIndex}"
                                             data-col="0"
                                             on:dragenter={onDropZoneEnter}
                                             on:dragleave={onDropZoneExit}
                                             on:drop={onDropComponent}
                                             on:dragover={(event) => { event.preventDefault(); return false;}}
                                        ></div>
                                    {/if}
                                    <div class="row">
                                        {#each row as bodyComponent, colIndex}
                                            {#if bodyComponent.col !== 0 &&
                                            bodyComponent.col !== null &&
                                            typeof bodyComponent.col === 'number' &&
                                            !$EditableDocumentStore.document.content.bodies.find(c => c.row === rowIndex &&
                                                c.col === colIndex - 1)
                                            }
                                                <div class="drop-zone"
                                                     data-zone="bodies"
                                                     data-layout="grid"
                                                     data-row="{rowIndex}"
                                                     data-col="{colIndex - 1}"
                                                     on:dragenter={onDropZoneEnter}
                                                     on:dragleave={onDropZoneExit}
                                                     on:drop={onDropComponent}
                                                     on:dragover={(event) => { event.preventDefault(); return false;}}
                                                ></div>
                                            {/if}
                                            <div class="components-col {bodyComponent.colSpan?`col-${bodyComponent.colSpan}`:'col'}">
                                                <BlockEditor component={bodyComponent} zone="bodies" layout="grid"></BlockEditor>
                                            </div>
                                            {#if bodyComponent.col !== null &&
                                            typeof bodyComponent.col === 'number' &&
                                            bodyComponent.col + bodyComponent.span?bodyComponent.span:0 < 12 &&
                                            !$EditableDocumentStore.document.content.bodies.find(c => c.row === rowIndex &&
                                                c.col === bodyComponent.col + bodyComponent.span?bodyComponent.span:0)
                                            }
                                                <div class="drop-zone"
                                                     data-zone="bodies"
                                                     data-row="{rowIndex}"
                                                     data-layout="grid"
                                                     data-col="{bodyComponent.col + bodyComponent.span?bodyComponent.span:0 + 1}"
                                                     on:dragenter={onDropZoneEnter}
                                                     on:dragleave={onDropZoneExit}
                                                     on:drop={onDropComponent}
                                                     on:dragover={(event) => { event.preventDefault(); return false;}}
                                                ></div>
                                            {/if}
                                        {/each }
                                    </div>
                                {/each}
                                <div class="new-row drop-zone"
                                     data-zone="bodies"
                                     data-layout="grid"
                                     data-row="{Helpers.getLastRowIndex($EditableDocumentStore.document.content.bodies) + 1}"
                                     data-col="0"
                                     on:dragenter={onDropZoneEnter}
                                     on:dragleave={onDropZoneExit}
                                     on:drop={onDropComponent}
                                     on:dragover={(event) => { event.preventDefault(); return false;}}
                                ></div>
                            {:else}
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
                                    <div class=" drop-zone"
                                         data-zone="bodies"
                                         on:dragenter={onDropZoneEnter}
                                         on:dragleave={onDropZoneExit}
                                         on:drop={onDropComponent}
                                         on:dragover={(event) => { event.preventDefault(); return false;}}
                                         data-order="{typeof bodyComponent.order === 'number' ? bodyComponent.order + 1:1}"
                                    ></div>
                                {/each}
                            {/if}
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
        $BlockEditorComponentStore.layout = undefined;
    }}><i class="fal fa-window-close"></i></div>
        <div class="editor-content">
            {#if $BlockEditorComponentStore.layout}
                <label for="grid-options">Options de grille</label>
                <div id="grid-options">
                    <div class="form-group">
                        <label for="row">ligne</label>
                        <input id="row" type="number" value="{$BlockEditorComponentStore.component.properties.row}" on:blur={(event) => {
                            const input = event.currentTarget;
                            $BlockEditorComponentStore.component.properties.row = input.value?parseInt(input.value):0;
                            BlockEditorComponentStore.update(becs => becs);
                            EditableDocumentStore.update(ecs => ecs);
                        }}>
                        <label for="column">Colonne</label>
                        <select id="column" class="form-control-sm" bind:value={$BlockEditorComponentStore.component.properties.col}
                            on:blur={(event) => {
                            const input = event.currentTarget;
                            $BlockEditorComponentStore.component.properties.col = input.value?parseInt(input.value):0;
                            BlockEditorComponentStore.update(becs => becs);
                            EditableDocumentStore.update(ecs => ecs);
                        }} >
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                </div>
            {/if}
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