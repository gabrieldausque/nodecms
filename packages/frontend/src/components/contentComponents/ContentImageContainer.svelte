<script>
    export let properties;
</script>

<div style="background-image: url('{properties.uri}'); {properties.style}" class="{properties.classes}">
{#if properties.content}
    {@html properties.content}
{/if}
</div>
