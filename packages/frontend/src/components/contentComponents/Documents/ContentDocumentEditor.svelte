<script>

    import {getBackendClient} from "@nodecms/backend-client";
    import {EditableDocumentStore} from "../../../stores/EditableDocumentStore";
    import {globalContentContainerFactory} from "../../../ContentContainerFactory";
    import ContentDefaultEditor from '../Editors/ContentDefaultEditor.svelte';
    import {Helpers} from "../../../helpers/Helpers";
    import {BlockEditorComponentStore} from "../../../stores/BlockEditorComponentStore";
    import ContentDocumentEditorZoneGridLayout from './ContentDocumentEditorZoneGridLayout.svelte';
    import ContentDocumentEditorZoneStackLayout from './ContentDocumentEditorZoneStackLayout.svelte';
    import HighlightedEditor from '../HighlightedEditor.svelte';
    import {onMount, afterUpdate} from 'svelte'

    let editDocumentGlobalProperties;
    let refresh = new Date();

    async function saveDocument() {
        const services = await getBackendClient();
        await services.documentService.updateDocument($EditableDocumentStore.document);
    }

    function getZoneLayout(zone) {
        const layout = $EditableDocumentStore.document.content.layout &&
        $EditableDocumentStore.document.content.layout[zone] &&
        $EditableDocumentStore.document.content.layout[zone].type?
            $EditableDocumentStore.document.content.layout[zone].type:
            '';
        console.log(`layout for zone ${zone} : ${layout}`);
        return layout;
    }

    function reorderRow() {
        const row = $EditableDocumentStore.document.content[$BlockEditorComponentStore.zone].filter(
            component => component.properties.row === $BlockEditorComponentStore.component.properties.row);
        row.splice(row.indexOf($BlockEditorComponentStore.component),1);
        row.splice($BlockEditorComponentStore.component.properties.col, 0, $BlockEditorComponentStore.component);
        for(let colIndex = 0; colIndex < row.length; colIndex++) {
            row[colIndex].properties.col = colIndex;
        }
    }

    onMount(() => {
        document.querySelector('.app-viewport > div.container-content > main').classList.remove('document-section','document-main');
    })

    afterUpdate(() => {
        document.querySelector('.app-viewport > div.container-content > main').classList.remove('document-section','document-main');
    })

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

    .toolbar-button {
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
        margin-bottom: 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
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

    :global( .editor-panel > .highlightEditor) {
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

    :global(.container.reduced) {
        transform: scale(0.4) translateX(-106%) translateY(-19%);
    }

    :global(.reduced) {
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

    #document-headers.container > :global(div.row),
    #document-footers.container > :global(div.row),
    #document-bodies.container > :global(div.row) {
        flex-grow: 1;
        margin: 0 !important;
    }

    :global(.components-col > div.component-container) {
        width:100%;
    }

    .grid-options > .form-group {
        display: flex;
        align-items: center;
        justify-content: start;
    }

    .section-layout {
        display: flex;
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
    <div id="document" class="container-content">
        {#if $EditableDocumentStore.document}
            {#if typeof $EditableDocumentStore.document.content.globalStyle === "string"}
                {@html Helpers.styleOpeningLabel + $EditableDocumentStore.document.content.globalStyle + Helpers.styleClosingLabel}
            {/if}
            <div class="documentEditorMenuBar">
                <button on:click={saveDocument} class="toolbar-button" type="button" title="Enregistrer">
                    <i class="fas fa-save"></i>
                </button>
                <button on:click={() => {
                    $BlockEditorComponentStore.component = undefined;
                    $BlockEditorComponentStore.zone = undefined;
                    $BlockEditorComponentStore.layout = undefined;
                    editDocumentGlobalProperties = true;
                }} type="button" class="toolbar-button" title="Options du document">
                    <i class="fas fa-cogs"></i>
                </button>
            </div>
            <div class="documentEditorContent">
                <div id="headers" class="section" >
                    <h5>En tête <div class="section-layout">
                        <button id="change-layout-headers-stack" type="button" class="toolbar-button
                        {
                         $EditableDocumentStore.document.content.layout &&
                         $EditableDocumentStore.document.content.layout.headers &&
                         $EditableDocumentStore.document.content.layout.headers.type === 'stack' ||
                         !$EditableDocumentStore.document.content.layout ||
                         !$EditableDocumentStore.document.content.layout.headers ?
                            'active-layout':
                            ''
                        }"
                        on:click={() => {
                            document.querySelector('#headers > h5 > .section-layout > button.active-layout').classList.remove('active-layout');
                            if(!$EditableDocumentStore.document.content.layout){
                                $EditableDocumentStore.document.content.layout = {}
                            }
                            if(!$EditableDocumentStore.document.content.layout.headers){
                                $EditableDocumentStore.document.content.layout.headers = {
                                    type: 'stack'
                                }
                            } else {
                                $EditableDocumentStore.document.content.layout.headers.type = 'stack'
                            }
                            document.getElementById('change-layout-headers-stack').classList.add('active-layout');
                            Helpers.updateEditableDocumentStore();
                        }}
                        title="Mise en page colonne">
                            <i class="fas fa-layer-group"></i>
                        </button>
                        <button id="change-layout-headers-grid" type="button" class="toolbar-button {getZoneLayout('headers') === 'grid' || !getZoneLayout('headers')?
                            'active-layout':
                            ''
                        }"
                        on:click={() => {
                            document.querySelector('#headers > h5 > .section-layout > button.active-layout').classList.remove('active-layout');
                            if(!$EditableDocumentStore.document.content.layout){
                                $EditableDocumentStore.document.content.layout = {}
                            }
                            if(!$EditableDocumentStore.document.content.layout.headers){
                                $EditableDocumentStore.document.content.layout.headers = {
                                    type: 'grid'
                                }
                            } else {
                                $EditableDocumentStore.document.content.layout.headers.type = 'grid'
                            }
                            document.getElementById('change-layout-headers-grid').classList.add('active-layout')
                            Helpers.updateEditableDocumentStore();
                        }} title="Mise en page grille">
                            <i class="fas fa-th-large"></i>
                        </button>
                    </div></h5>
                    <header id="document-headers" class="document-section document-headers {$BlockEditorComponentStore.zone === 'headers'?'reduced':'' }
                         {
                            $EditableDocumentStore.document.content.layout &&
                            $EditableDocumentStore.document.content.layout.headers &&
                            $EditableDocumentStore.document.content.layout.headers.type === 'grid'?
                                 'container':
                                 ''
                         }">
                    {#if $EditableDocumentStore.document.content.layout &&
                    $EditableDocumentStore.document.content.layout.headers &&
                    $EditableDocumentStore.document.content.layout.headers.type === 'grid'}
                        <ContentDocumentEditorZoneGridLayout zone="headers"></ContentDocumentEditorZoneGridLayout>
                    {:else}
                        <ContentDocumentEditorZoneStackLayout zone="headers"></ContentDocumentEditorZoneStackLayout>
                    {/if}
                    </header>
                </div>
                <div id="bodies" class="section">
                    <h5>Corps <div class="section-layout">
                        <button id="change-layout-bodies-stack" type="button" class="toolbar-button
                        {
                         $EditableDocumentStore.document.content.layout &&
                         $EditableDocumentStore.document.content.layout.bodies &&
                         $EditableDocumentStore.document.content.layout.bodies.type === 'stack' ||
                         !$EditableDocumentStore.document.content.layout ||
                         !$EditableDocumentStore.document.content.layout.bodies ?
                            'active-layout':
                            ''}"
                          on:click={() => {
                            document.querySelector('#bodies > h5 > .section-layout > button.active-layout').classList.remove('active-layout');
                            if(!$EditableDocumentStore.document.content.layout){
                                $EditableDocumentStore.document.content.layout = {}
                            }
                            if(!$EditableDocumentStore.document.content.layout.bodies){
                                $EditableDocumentStore.document.content.layout.bodies = {
                                    type: 'stack'
                                }
                            } else {
                                $EditableDocumentStore.document.content.layout.bodies.type = 'stack'
                            }
                            document.getElementById('change-layout-bodies-stack').classList.add('active-layout');
                            Helpers.updateEditableDocumentStore();
                        }}
                                title="Mise en page colonne">
                            <i class="fas fa-layer-group"></i>
                        </button>
                        <button id="change-layout-bodies-grid" type="button" class="toolbar-button {
                         $EditableDocumentStore.document.content.layout &&
                         $EditableDocumentStore.document.content.layout.bodies &&
                         $EditableDocumentStore.document.content.layout.bodies.type === 'grid'?
                            'active-layout':
                            ''
                        }"
                                on:click={() => {
                            document.querySelector('#bodies > h5 > .section-layout > button.active-layout').classList.remove('active-layout');
                            if(!$EditableDocumentStore.document.content.layout){
                                $EditableDocumentStore.document.content.layout = {}
                            }
                            if(!$EditableDocumentStore.document.content.layout.bodies){
                                $EditableDocumentStore.document.content.layout.bodies = {
                                    type: 'grid'
                                }
                            } else {
                                $EditableDocumentStore.document.content.layout.bodies.type = 'grid'
                            }
                            document.getElementById('change-layout-bodies-grid').classList.add('active-layout')
                            Helpers.updateEditableDocumentStore();
                        }} title="Mise en page grille">
                            <i class="fas fa-th-large"></i>
                        </button>
                    </div></h5>
                    <main id="document-bodies" class="document-section document-main {$BlockEditorComponentStore.zone === 'bodies'?'reduced':''}
                    {
                        $EditableDocumentStore.document.content.layout &&
                        $EditableDocumentStore.document.content.layout.bodies &&
                        $EditableDocumentStore.document.content.layout.bodies.type === 'grid'?
                        'container':
                        ''
                    }" >
                        {#if $EditableDocumentStore.document.content.layout &&
                             $EditableDocumentStore.document.content.layout.bodies &&
                             $EditableDocumentStore.document.content.layout.bodies.type === 'grid'}
                            <ContentDocumentEditorZoneGridLayout zone="bodies"></ContentDocumentEditorZoneGridLayout>
                        {:else}
                            <ContentDocumentEditorZoneStackLayout zone="bodies"></ContentDocumentEditorZoneStackLayout>
                        {/if}
                    </main>
                </div>
                <div id="footers" class="section">
                    <h5>Pied de page <div class="section-layout">
                        <button id="change-layout-footers-stack" type="button" class="toolbar-button
                        {
                         $EditableDocumentStore.document.content.layout &&
                         $EditableDocumentStore.document.content.layout.footers &&
                         $EditableDocumentStore.document.content.layout.footers.type === 'stack' ||
                         !$EditableDocumentStore.document.content.layout ||
                         !$EditableDocumentStore.document.content.layout.footers ?
                            'active-layout':
                            ''
                        }"
                                on:click={() => {
                            document.querySelector('#footers > h5 > .section-layout > button.active-layout').classList.remove('active-layout');
                            if(!$EditableDocumentStore.document.content.layout){
                                $EditableDocumentStore.document.content.layout = {}
                            }
                            if(!$EditableDocumentStore.document.content.layout.footers){
                                $EditableDocumentStore.document.content.layout.footers = {
                                    type: 'stack'
                                }
                            } else {
                                $EditableDocumentStore.document.content.layout.footers.type = 'stack'
                            }
                            document.getElementById('change-layout-footers-stack').classList.add('active-layout');
                            Helpers.updateEditableDocumentStore();
                        }}
                                title="Mise en page colonne">
                            <i class="fas fa-layer-group"></i>
                        </button>
                        <button id="change-layout-footers-grid" type="button" class="toolbar-button {
                            $EditableDocumentStore.document.content.layout &&
                            $EditableDocumentStore.document.content.layout.footers &&
                            $EditableDocumentStore.document.content.layout.footers.type === 'grid' ?
                            'active-layout':
                            ''
                        }"
                                on:click={() => {
                            document.querySelector('#footers > h5 > .section-layout > button.active-layout').classList.remove('active-layout');
                            if(!$EditableDocumentStore.document.content.layout){
                                $EditableDocumentStore.document.content.layout = {}
                            }
                            if(!$EditableDocumentStore.document.content.layout.footers){
                                $EditableDocumentStore.document.content.layout.footers = {
                                    type: 'grid'
                                }
                            } else {
                                $EditableDocumentStore.document.content.layout.footers.type = 'grid'
                            }
                            document.getElementById('change-layout-footers-grid').classList.add('active-layout')
                            Helpers.updateEditableDocumentStore();
                        }} title="Mise en page grille">
                            <i class="fas fa-th-large"></i>
                        </button>
                </div></h5>
                    <footer id="document-footers" class="document-section document-footer {$BlockEditorComponentStore.zone === 'footers'?'reduced':''}
                    {
                        $EditableDocumentStore.document.content.layout &&
                        $EditableDocumentStore.document.content.layout.footers &&
                        $EditableDocumentStore.document.content.layout.footers.type === 'grid'?
                        'container':
                        ''
                    }">
                        {#if $EditableDocumentStore.document.content.layout &&
                        $EditableDocumentStore.document.content.layout.footers &&
                        $EditableDocumentStore.document.content.layout.footers.type === 'grid'}
                            <ContentDocumentEditorZoneGridLayout zone="footers"></ContentDocumentEditorZoneGridLayout>
                        {:else}
                            <ContentDocumentEditorZoneStackLayout zone="footers"></ContentDocumentEditorZoneStackLayout>
                        {/if}
                    </footer>
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
                        <input id="row" type="number" class="form-control-sm" value="{$BlockEditorComponentStore.component.properties.row}" on:blur={(event) => {
                            const input = event.currentTarget;
                            $BlockEditorComponentStore.component.properties.row = input.value?parseInt(input.value):0;
                            reorderRow();
                            BlockEditorComponentStore.update(becs => becs);
                            EditableDocumentStore.update(ecs => ecs);
                        }}>
                        <label for="column">Colonne</label>
                        <input id="column" type="number" class="form-control-sm" value={$BlockEditorComponentStore.component.properties.col}
                            on:blur={(event) => {
                            const input = event.currentTarget;
                            $BlockEditorComponentStore.component.properties.col = input.value?parseInt(input.value):0;
                            reorderRow();
                            BlockEditorComponentStore.update(becs => becs);
                            EditableDocumentStore.update(ecs => ecs);
                        }} >
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

    <div class="editor-panel {editDocumentGlobalProperties?'':'hidden'}">
        <h4> Propriétés du Document</h4>
        <div class="close" on:click={() => {
        editDocumentGlobalProperties=false;
    }}><i class="fal fa-window-close"></i></div>
        <div class="editor-content">
            <div class="visibility">
                <label for="documentVisibility">Visibilité</label>
                <select on:blur={() => {
                            const visibility = document.getElementById('documentVisibility');
                            visibility.title = Helpers.visibilityTooltips[visibility.value];
                            $EditableDocumentStore.document.visibility = visibility.value;
                        }} class="form-select"
                        id="documentVisibility" name="documentVisibility"
                        value="{$EditableDocumentStore.document.visibility}"
                        required title="Un document privé n'est accessible et visible que par ses lecteurs et les administrateurs">
                    <option value="private" >Privé</option>
                    <option value="protected" >Protégé</option>
                    <option value="public">Public</option>
                </select>
            </div>
        </div>
        <div class="global-style">
            <label for="globalStyle">Global Style :</label>
            <HighlightedEditor
                    id="globalStyle"
                    content={$EditableDocumentStore.document.content.globalStyle?$EditableDocumentStore.document.content.globalStyle:''}
                    onChange={(newStyle) => {
                    $EditableDocumentStore.document.content.globalStyle = newStyle
                    Helpers.updateEditableDocumentStore();
            }}
            ></HighlightedEditor>
        </div>
        <div class="style">
            <label for="style">Style :</label>
            <HighlightedEditor
                    id="style"
                    content={$EditableDocumentStore.document.style?$EditableDocumentStore.document.style:''}
                    onChange={(newStyle) => {
                    $EditableDocumentStore.document.style = newStyle
                    Helpers.updateEditableDocumentStore();
            }}
            ></HighlightedEditor>
        </div>
    </div>

</main>
