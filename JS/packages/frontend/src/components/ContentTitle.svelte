<script>
    import { Helpers } from '../helpers/Helpers';
    export let properties;
</script>

<style>
    h1 {
        color: #ff0033;
        text-transform: uppercase;
        font-size: 4em;
        font-weight: 100;
    }

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
    {/if}
</div>
