
<script>

    import {globalContentContainerFactory} from "../../ContentContainerFactory";
    import {getBackendClient} from '@nodecms/backend-client';
    import {beforeUpdate, onMount} from 'svelte';
    import {Helpers} from "../../helpers/Helpers";

    export let properties;
    export let documentKey;

    async function getDocument() {
        const backendClient = await getBackendClient();
        let rawDocument = null;
        if(documentKey){
            let doc = await backendClient.documentService.getDocument(documentKey);
            let sortFunction = (a,b) =>{
                if(a.order < b.order)
                    return -1
                else if (a.order === b.order)
                    return 0
                else
                    return 1
            };
            if(Array.isArray(doc.content.headers)) {
                doc.content.headers = doc.content.headers.sort(sortFunction)
            }
            if(Array.isArray(doc.content.bodies)) {
                doc.content.bodies = doc.content.bodies.sort(sortFunction)
            }
            if(Array.isArray(doc.content.footers)) {
                doc.content.footers = doc.content.footers.sort(sortFunction)
            }
            rawDocument = doc;
        }
        return rawDocument
    }

    onMount(async () => {
        if(documentKey)
            properties = await getDocument();
    })

    $:{
        if(documentKey) {
            getDocument().then((content) => {
                properties = content;
            })
        }
    }

</script>

<style>
    .container-content {
        display: flex;
        flex-direction: column;
        width: 100%;
        height: 100%;
    }

    .container-content > main,
    .container-content > header,
    .container-content > footer
    {
        flex-grow: 1;
        height: auto;
        scrollbar-width:none;
        display: flex;
        flex-direction: column;
        width: 100%;
    }

    .container-content > main::-webkit-scrollbar,
    .container-content > header::-webkit-scrollbar,
    .container-content > footer::-webkit-scrollbar {
        display: none;
    }

    :global(.container-content > .container) {
        overflow: scroll;
    }

    :global(.container-content > .container > div.row) {
        display: flex;
    }

    :global(.container-content > .container > div.row > div.col) {
        padding: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .document-header {
        min-height: 150px;
    }

    .document-footer {
        min-height: 50px;
    }

</style>

{#if properties}
    <div class="container-content {properties.classes?properties.classes:''}" style="{properties.style?properties.style:''}">
    {#if properties && properties.content}
        {#if typeof properties.content.globalStyle === "string"}
            {@html Helpers.styleOpeningLabel + properties.content.globalStyle + Helpers.styleClosingLabel}
        {/if}
        {#if Array.isArray(properties.content.headers) && properties.content.headers.length > 0}
            <header class="{(properties.content.layout &&
                     properties.content.layout.headers &&
                     properties.content.layout.headers.type === 'grid')?'container':''} document-section document-header">
            {#if properties.content.layout &&
            properties.content.layout.headers &&
            properties.content.layout.headers.type === 'grid'}
                {#each Helpers.getRows(properties.content.headers) as row}
                    <div class="row">
                        {#each row as container}
                            <div class="{container.colSpan?`col-${container.colSpan}`:'col'}">
                                <svelte:component this="{globalContentContainerFactory.getContentContainer(container.type)}" properties="{container.properties}"></svelte:component>
                            </div>
                        {/each }
                    </div>
                {/each}
            {:else}
                {#each properties.content.headers as container}
                    <svelte:component this="{globalContentContainerFactory.getContentContainer(container.type)}" properties="{container.properties}"></svelte:component>
                {/each}
            {/if}
            </header>
        {/if}
        <main class="{(properties.content.layout &&
                     properties.content.layout.bodies &&
                     properties.content.layout.bodies.type === 'grid')?'container':''} document-section document-main">
            {#if Array.isArray(properties.content.bodies)}
                {#if properties.content.layout &&
                     properties.content.layout.bodies &&
                     properties.content.layout.bodies.type === 'grid'}
                    {#each Helpers.getRows(properties.content.bodies) as row}
                        <div class="row">
                            {#each row as container}
                                <div class="{container.colSpan?`col-${container.colSpan}`:'col'}">
                                    <svelte:component this="{globalContentContainerFactory.getContentContainer(container.type)}" properties="{container.properties}"></svelte:component>
                                </div>
                            {/each }
                        </div>
                    {/each}
                {:else}
                    {#each properties.content.bodies as container}
                        <svelte:component this="{globalContentContainerFactory.getContentContainer(container.type)}" properties="{container.properties}"></svelte:component>
                    {/each}
                {/if}
            {/if}
        </main>
        {#if Array.isArray(properties.content.footers) && properties.content.footers.length > 0}
            <footer class="{(properties.content.layout &&
                     properties.content.layout.footers &&
                     properties.content.layout.footers.type === 'grid')?'container':''} document-section document-footer">
            {#if properties.content.layout &&
            properties.content.layout.footers &&
            properties.content.layout.footers.type === 'grid'}
                {#each Helpers.getRows(properties.content.footers) as row}
                    <div class="row">
                        {#each row as container}
                            <div class="{container.colSpan?`col-${container.colSpan}`:'col'}">
                                <svelte:component this="{globalContentContainerFactory.getContentContainer(container.type)}" properties="{container.properties}"></svelte:component>
                            </div>
                        {/each }
                    </div>
                {/each}
            {:else}
                {#each properties.content.footers as container}
                    <svelte:component this="{globalContentContainerFactory.getContentContainer(container.type)}" properties="{container.properties}"></svelte:component>
                {/each}
            {/if}
            </footer>
        {/if}
    {/if}
</div>
{/if}