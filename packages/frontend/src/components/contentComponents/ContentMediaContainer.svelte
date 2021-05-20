<script>
    import {Helpers} from "../../helpers/Helpers";
    import {onMount} from "svelte";
    export let properties;

    onMount(() => {
        console.log(properties);
    })

</script>

<style>

</style>

<main style="{properties.style}">
    {#if properties.globalStyle}
        {@html Helpers.styleOpeningLabel + properties.globalStyle + Helpers.styleClosingLabel}
    {/if}
    <svelte:component this={Helpers.getAttachmentComponent(properties.mediaType)}
                      attachment={properties.key}/>
    {#if properties.content}
        {@html properties.content}
    {/if}
</main>