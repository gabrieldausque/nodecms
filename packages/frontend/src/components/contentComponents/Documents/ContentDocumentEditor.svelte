<script>

    import {EditableDocumentStore} from "../../../stores/EditableDocumentStore";
    import {globalContentContainerFactory} from "../../../ContentContainerFactory";
    import {afterUpdate} from 'svelte';
    import { JSONEditor } from 'svelte-jsoneditor'

    $EditableDocumentStore;

    afterUpdate(() => {
        console.log($EditableDocumentStore)
    })

    function handleDragStart(e) {
        console.log(e)
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

    .editor-main {
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
        width: 25vw;
        display: flex;
        flex-wrap: wrap;
        align-content: flex-start;
        padding: 10px;
        border-right: solid 1px lightgray;
    }

    #document {
        width: 75vw;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .documentMenuBar {
        background: white;
        display: flex;
        padding: 2px;
        border-bottom: solid 1px lightgray;
    }

    #documentSettingsButton {
        margin-left:auto;
        margin-right:0;
    }

    .section {
        min-height: 150px;
        border-bottom: solid 1px lightgray;
    }

    .section > h5 {
        background: white;
        text-align: start;
        padding: 4px;
        border-bottom: solid 1px lightgray;
        box-shadow: inset 0px -3px 18px -14px;
        margin-bottom: 0;
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
            <div class="documentMenuBar">
                <button id="documentSettingsButton" type="button" title="Paramètres du document">
                    <i class="fas fa-cogs"></i>
                </button>
            </div>
            <div id="headers" class="section">
                <h5>En tête</h5>
                <div id="document-headers" class="drop-zone">
                    {#if Array.isArray($EditableDocumentStore.document.content.headers)}
                        {#each $EditableDocumentStore.document.content.headers.sort((c1, c2) => {
                            console.log(c1);
                            console.log(c2);
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
                                <JSONEditor json="{headerComponent}" onChange={
                                    (event) => {
                                        $EditableDocumentStore.document.content.headers.splice(
                                            $EditableDocumentStore.document.content.headers.indexOf(headerComponent),
                                            1,
                                            event.json
                                        )
                                        console.log($EditableDocumentStore);
                                    }
                                }></JSONEditor>
                            {/if}
                        {/each}
                    {/if }
                </div>
            </div>
            <div id="bodies" class="section">
                <h5>Corps</h5>
                <div id="document-bodies" class="drop-zone">
                    {#if Array.isArray($EditableDocumentStore.document.content.bodies)}
                        {#each $EditableDocumentStore.document.content.bodies.sort((c1, c2) => {
                            if(c1.order > c2.order)
                                return 1;
                            if(c1.order < c2.order)
                                return -1;
                            return 0;
                        }) as bodyComponent}
                            {#if globalContentContainerFactory.registeredConstructors[bodyComponent.type].editorConstructor}
                                <svelte:component this="{globalContentContainerFactory.registeredConstructors[bodyComponent.type].editorConstructor}" properties="{bodyComponent.properties}"></svelte:component>
                            {:else}
                                <JSONEditor json="{bodyComponent}" onChange={
                                    (event) => {
                                        $EditableDocumentStore.document.content.bodies.splice(
                                            $EditableDocumentStore.document.content.bodies.indexOf(bodyComponent),
                                            1,
                                            event.json
                                        )
                                        console.log($EditableDocumentStore);
                                    }
                                }></JSONEditor>
                            {/if}
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
                                <JSONEditor json="{footerComponent}" onChange={
                                    (event) => {
                                        $EditableDocumentStore.document.content.bodies.splice(
                                            $EditableDocumentStore.document.content.bodies.indexOf(footerComponent),
                                            1,
                                            event.json
                                        )
                                        console.log($EditableDocumentStore);
                                    }
                                }></JSONEditor>
                            {/if}
                        {/each}
                    {/if }
                </div>
            </div>
        {/if}
    </div>
</main>
