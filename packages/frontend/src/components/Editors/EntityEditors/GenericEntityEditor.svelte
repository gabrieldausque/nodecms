<script lang="ts">

    import {Entity, InterfaceMetadata} from "@nodecms/backend-data";

    export let properties:Entity;
    export let dataType:string;

    let entityMetadata = InterfaceMetadata[dataType];

</script>

<style>
    .field-edition {
        border-bottom: solid 1px lightgray;
    }
</style>

<form>
    {#each entityMetadata.fields as fieldMetadata}
        {#if fieldMetadata.visible}
            <div class="form-group field-edition">
                <label for="{properties.id}-field-{fieldMetadata.name}">{fieldMetadata.label} : </label>
                {#if fieldMetadata.editable}
                    {#if fieldMetadata.type === 'string'}
                        {#if fieldMetadata.masked}
                            <input type="password" bind:value={properties[fieldMetadata.name]} title="{fieldMetadata.description}">
                        {:else }
                            <input type="text" bind:value={properties[fieldMetadata.name]} title="{fieldMetadata.description}">
                        {/if}
                    {:else if fieldMetadata.type == 'boolean'}
                        <input type="checkbox" bind:checked={properties[fieldMetadata.name]}>
                    {/if}

                {:else}
                    <div class="non-editable">{properties[fieldMetadata.name]}</div>
                {/if}
            </div>
        {/if}
    {/each}
</form>