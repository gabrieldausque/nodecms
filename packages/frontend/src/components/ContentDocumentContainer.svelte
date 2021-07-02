
<script>

    import {globalContentContainerFactory} from "../ContentContainerFactory";
    import {getBackendClient} from '@nodecms/backend-client';
    import {beforeUpdate, onMount} from 'svelte';
    import {Helpers} from "../helpers/Helpers";

    export let doc;

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
        flex-grow: 1;
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

{#if doc}
    <div class="container-content {doc.classes?doc.classes:''}" style="{doc.style?doc.style:''}">
    {#if doc && doc.content}
        {#if typeof doc.content.globalStyle === "string"}
            {@html Helpers.styleOpeningLabel + doc.content.globalStyle + Helpers.styleClosingLabel}
        {/if}
        {#if Array.isArray(doc.content.headers) && doc.content.headers.length > 0}
            <header class="{(doc.content.layout &&
                     doc.content.layout.headers &&
                     doc.content.layout.headers.type === 'grid')?'container':''} document-section document-header">
            {#if doc.content.layout &&
            doc.content.layout.headers &&
            doc.content.layout.headers.type === 'grid'}
                {#each Helpers.getRows(doc.content.headers) as row}
                    <div class="row">
                        {#each row as container}
                            <div class="{container.colSpan?`col-${container.colSpan}`:'col'}">
                                <svelte:component this="{globalContentContainerFactory.getContentContainer(container.type)}" properties="{container.properties}"></svelte:component>
                            </div>
                        {/each }
                    </div>
                {/each}
            {:else}
                {#each doc.content.headers as container}
                    <svelte:component this="{globalContentContainerFactory.getContentContainer(container.type)}" properties="{container.properties}"></svelte:component>
                {/each}
            {/if}
            </header>
        {/if}
        <main class="{(doc.content.layout &&
                     doc.content.layout.bodies &&
                     doc.content.layout.bodies.type === 'grid')?'container':''} document-section document-main">
            {#if Array.isArray(doc.content.bodies)}
                {#if doc.content.layout &&
                     doc.content.layout.bodies &&
                     doc.content.layout.bodies.type === 'grid'}
                    {#each Helpers.getRows(doc.content.bodies) as row}
                        <div class="row">
                            {#each row as container}
                                <div class="{container.colSpan?`col-${container.colSpan}`:'col'}">
                                    <svelte:component this="{globalContentContainerFactory.getContentContainer(container.type)}" properties="{container.properties}"></svelte:component>
                                </div>
                            {/each }
                        </div>
                    {/each}
                {:else}
                    {#each doc.content.bodies as container}
                        <svelte:component this="{globalContentContainerFactory.getContentContainer(container.type)}" properties="{container.properties}"></svelte:component>
                    {/each}
                {/if}
            {/if}
        </main>
        {#if Array.isArray(doc.content.footers) && doc.content.footers.length > 0}
            <footer class="{(doc.content.layout &&
                     doc.content.layout.footers &&
                     doc.content.layout.footers.type === 'grid')?'container':''} document-section document-footer">
            {#if doc.content.layout &&
            doc.content.layout.footers &&
            doc.content.layout.footers.type === 'grid'}
                {#each Helpers.getRows(doc.content.footers) as row}
                    <div class="row">
                        {#each row as container}
                            <div class="{container.colSpan?`col-${container.colSpan}`:'col'}">
                                <svelte:component this="{globalContentContainerFactory.getContentContainer(container.type)}" properties="{container.properties}"></svelte:component>
                            </div>
                        {/each }
                    </div>
                {/each}
            {:else}
                {#each doc.content.footers as container}
                    <svelte:component this="{globalContentContainerFactory.getContentContainer(container.type)}" properties="{container.properties}"></svelte:component>
                {/each}
            {/if}
            </footer>
        {/if}
    {/if}
</div>
{/if}