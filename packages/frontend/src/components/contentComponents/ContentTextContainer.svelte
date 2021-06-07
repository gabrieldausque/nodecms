<!--
    properties.globalStyle : string define global <style></style> in text container
    properties.style: string define style attribute of text container
    properties.content : HTML content of the text container
-->

<script>

    import {Helpers} from '../../helpers/Helpers'
    export let properties;

</script>

<style>
    .default-style-text-container {
        width:100%;
    }
</style>

<div class="default-style-text-container {properties.classes?properties.classes:''}"
     style="{properties.style?properties.style:''}">
    {#if properties.globalStyle}
        {@html Helpers.styleOpeningLabel + properties.innerStyle + Helpers.styleClosingLabel}
    {/if}
    {#if properties.content}
        {@html properties.content}
    {/if}
</div>

