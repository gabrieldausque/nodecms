<script>
    import {Helpers} from "../../helpers/Helpers";
    export let properties;
</script>

<style>

</style>

<main>
    {@html Helpers.styleOpeningLabel + properties.globalStyle + Helpers.styleClosingLabel}
    <svelte:component this={Helpers.getAttachmentComponent(properties.mediaType)}
                      attachment={properties.key}
                      style="{properties.style}"/>
    {#if properties.content}
        {@html properties.content}
    {/if}
</main>