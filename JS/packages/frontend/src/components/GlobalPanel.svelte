<script lang="ts">
    import {onDestroy} from 'svelte';
    import {ComponentMetadata} from "../helpers";
    import {PanelContext} from "../stores";
    import {allPanelsContext} from "../stores/PanelStores";
    import {panelFactory} from "../factory";

    export let finalWidthInPercent:string;
    export let context:string;

    let components:ComponentMetadata[] = [];

    const unsubscribe = allPanelsContext[context].subscribe((pc:PanelContext) => {
        components = pc.components
    });

    function slideHorizontal(node, {
        delay = 0,
        duration = 300
    }) {
        return {
            delay,
            duration,
            css: t => `width: ${t * finalWidthInPercent}%`
        }
    }

    onDestroy(() => {
        unsubscribe();
    })

</script>

<style>
    .panel {
    }

</style>

<div class="panel" transition:slideHorizontal style="width:{finalWidthInPercent}%;">
    {#each components as component}
        <svelte:component this={panelFactory.getComponent(component.controlType)} properties={component.controlProperties}></svelte:component>
    {/each}
</div>