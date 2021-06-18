<script>
    import { Helpers } from '../helpers/Helpers';
    export let properties;
</script>

<style>
    .nodecms-title {
        text-align:center;
        color: white;
        font-size: larger;
        width:100%;
    }
</style>

<div class="nodecms-title {properties.classes?properties.classes:''}" >
    {#if properties}
        {#if typeof properties.globalStyle === "string"}
            {@html Helpers.styleOpeningLabel + properties.globalStyle + Helpers.styleClosingLabel}
        {/if}
        <h1 style="{properties.style?properties.style:''}">{@html properties.title?properties.title:''}</h1>
    {:else}
        <h1></h1>
    {/if}
</div>
