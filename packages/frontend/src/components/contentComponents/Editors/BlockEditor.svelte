<script>
    import {BlockEditorComponentStore} from "../../../stores/BlockEditorComponentStore";
    import {globalContentContainerFactory} from "../../../ContentContainerFactory";
    import {Helpers} from "../../../helpers/Helpers";

    $BlockEditorComponentStore

    export let component;
    export let zone;

</script>

<style>
    .component-container {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        min-height: 30px;
    }

    .component-container:hover {
        border: solid 2px red;
    }

    .contextual-menu {
        position: fixed !important;
    }
</style>

<div class="component-container" on:contextmenu={(event) => {
                                   event.stopPropagation();
                                   event.preventDefault();
                                   if(!$BlockEditorComponentStore.component) {
                                       console.log(event);
                                       document.querySelectorAll('.contextual-menu').forEach(cm => {cm.classList.remove('show')});
                                       const contextMenu = event.target.closest('.component-container').querySelector('.contextual-menu');
                                       contextMenu.classList.add('show');
                                       contextMenu.style.top = `${event.y}px`;
                                       contextMenu.style.left = `${event.x}px`;
                                   }
                                }}>
    <div class="contextual-menu dropdown-menu dropdown-menu-sm-left">
        <div class="dropdown-item" on:click={(event) => {
                                             event.stopPropagation();
                                             event.preventDefault();
                                             document.querySelectorAll('.contextual-menu').forEach(cm => {cm.classList.remove('show')});
                                             $BlockEditorComponentStore.component = component;
                                             $BlockEditorComponentStore.zone = zone;
                                         }}>Editer</div>
    </div>
    {#if component.properties.globalStyle}
        {@html Helpers.styleOpeningLabel + component.properties.globalStyle + Helpers.styleClosingLabel}
    {/if}
    {#if component.properties.headers || component.properties.bodies || component.properties.footers}
        {#if Array.isArray(component.properties.headers) && component.properties.headers.length > 0}
            {#each component.properties.headers as headerComponent}
                <svelte:self component={headerComponent} zone={zone}></svelte:self>
            {/each}
        {/if}
        {#if Array.isArray(component.properties.bodies)  && component.properties.bodies.length > 0}
            {#each component.properties.bodies as bodyComponent}
                <svelte:self component={bodyComponent} zone={zone}></svelte:self>
            {/each}
        {/if}
        {#if Array.isArray(component.properties.footers)  && component.properties.footers.length > 0}
            {#each component.properties.footers as footerComponent}
                <svelte:self component={footerComponent} zone={zone}></svelte:self>
            {/each}
        {/if}
    {:else if globalContentContainerFactory.registeredConstructors[component.type].canDisplayInEditMode}
        <svelte:component this="{globalContentContainerFactory.getContentContainer(component.type)}" properties="{component.properties}"></svelte:component>
    {:else}
        <div>
            Ce bloc n'est pas affichable en mode édition du document
        </div>
    {/if}
</div>