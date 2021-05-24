<script>
    export let properties;
</script>

<div class="{properties.classes}" style="{properties.style?properties.style:''}">
    {#if properties.content}
        {@html properties.content}
    {/if}
</div>

