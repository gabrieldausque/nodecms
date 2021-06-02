
<script>

    import {globalContentContainerFactory} from "../../ContentContainerFactory";
    import {getBackendClient} from '@nodecms/backend-client';
    import {beforeUpdate, onMount} from 'svelte';
    import {Helpers} from "../../helpers/Helpers";

    export let properties;
    export let documentKey;

    async function getDocument() {
        let rawDocument = null;
        const backendClient = await getBackendClient();
        if(documentKey){
            let doc = await backendClient.documentService.getDocument(documentKey);
            rawDocument = doc.content;
            let sortFunction = (a,b) =>{
                if(a.order < b.order)
                    return -1
                else if (a.order === b.order)
                    return 0
                else
                    return 1
            };
            if(Array.isArray(rawDocument.headers)) {
                rawDocument.headers = rawDocument.headers.sort(sortFunction)
            }
            if(Array.isArray(rawDocument.bodies)) {
                rawDocument.bodies = rawDocument.bodies.sort(sortFunction)
            }
            if(Array.isArray(rawDocument.footers)) {
                rawDocument.footers = rawDocument.footers.sort(sortFunction)
            }

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

    function getRows(containers){
        const rows = []
        const rowIndexes = containers.map(c => typeof c.row === 'number'? c.row : 0).sort();
        for(const rowIndex of rowIndexes){
            const row = []
            for(const colContainer of containers.filter(c => {
                if(rowIndex === 0)
                    return c.row === rowIndex || typeof c.row === 'undefined' || c.row === null;
                else
                    return c.row === rowIndex;
            })){
                row.push(colContainer);
            }
            row.sort((c1,c2) => {
                if(c1.col > c2.col)
                    return 1;
                if(c1.col < c2.col)
                    return -1;
                return 0;
            })
            rows.push(row)
        }
        return rows;
    }

</script>

<style>
    .container-content {
        display: flex;
        flex-direction: column;
        width: 100%;
        height: 100%;
    }
    .container-content > main {
        flex-grow: 1;
        height: 100%;
        overflow:auto;
    }
</style>

<div class="container-content">
    {#if properties}
        {#if typeof properties.globalStyle === "string"}
            {@html Helpers.styleOpeningLabel + properties.globalStyle + Helpers.styleClosingLabel}
        {/if}
        {#if Array.isArray(properties.headers) && properties.headers.length > 0}
            <header>
                {#each properties.headers as container}
                    <svelte:component this="{globalContentContainerFactory.getContentContainer(container.type)}" properties="{container.properties}"></svelte:component>
                {/each}
            </header>
        {/if}
        <main class="{properties.classes}" style="{properties.style}">
            <svelte:component this="{properties.title}" title="{properties.title}"></svelte:component>
            {#if Array.isArray(properties.bodies)}
                {#if properties.bodies.layout === 'grid'}
                    {#each getRows(properties.bodies) as row}
                        <div class="row">
                            {#each row as container}
                                <div class="{container.colSpan?`col-${container.colSpan}`:'col'}">
                                    <svelte:component this="{globalContentContainerFactory.getContentContainer(container.type)}" properties="{container.properties}"></svelte:component>
                                </div>
                            {/each }
                        </div>
                    {/each}
                {:else}
                    {#each properties.bodies as container}
                        <svelte:component this="{globalContentContainerFactory.getContentContainer(container.type)}" properties="{container.properties}"></svelte:component>
                    {/each}
                {/if}
            {/if}
        </main>
        {#if Array.isArray(properties.header) && properties.header.length > 0}
            <footer>
                {#each properties.header as container}
                    <svelte:component this="{globalContentContainerFactory.getContentContainer(container.type)}" properties="{container.properties}"></svelte:component>
                {/each}
            </footer>
        {/if}
    {/if}
</div>