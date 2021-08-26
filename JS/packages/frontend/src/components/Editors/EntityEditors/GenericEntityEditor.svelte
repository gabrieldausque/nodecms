<script lang="ts">

    import {Entity, InterfaceMetadata} from "@nodecms/backend-data";
    import MultiStringEditor from "./MultiStringEditor.svelte";

    export let properties: Entity;
    export let dataType: string;

    let entityMetadata = InterfaceMetadata[dataType];

</script>

<style>
    .field-edition {

    }

    .nodecms-checkbox {
        width: auto !important;
        margin-left: 0;
        margin-bottom: 1rem;
    }
</style>

<form>
    {#each entityMetadata.fields as fieldMetadata}
        {#if fieldMetadata.visible}
            {#if fieldMetadata.editable}
                {#if fieldMetadata.type === 'string'}
                    {#if fieldMetadata.masked}
                        <div class="form-group field-edition">
                            <label for="{properties.id}-field-{fieldMetadata.name}">{fieldMetadata.label} : </label>
                            <input type="password" bind:value={properties[fieldMetadata.name]} title="{fieldMetadata.description}">
                        </div>
                    {:else }
                        <div class="form-group field-edition">
                            <label for="{properties.id}-field-{fieldMetadata.name}">{fieldMetadata.label} : </label>
                            <input type="text" bind:value={properties[fieldMetadata.name]} title="{fieldMetadata.description}">
                        </div>
                    {/if}
                {:else if fieldMetadata.type == 'boolean'}
                    <div class="form-group field-edition">
                        <label for="{properties.id}-field-{fieldMetadata.name}">{fieldMetadata.label} : </label>
                        <input class="nodecms-checkbox" type="checkbox" bind:checked={properties[fieldMetadata.name]}>
                    </div>
                {:else if fieldMetadata.type == 'number'}
                    <div class="form-group field-edition">
                        <label for="{properties.id}-field-{fieldMetadata.name}">{fieldMetadata.label} : </label>
                        <input type="number" bind:value={properties[fieldMetadata.name]}>
                    </div>
                {:else if fieldMetadata.type == 'date'}
                    <div class="form-group field-edition">
                        <label for="{properties.id}-field-{fieldMetadata.name}">{fieldMetadata.label} : </label>
                        <input type="date" bind:value={properties[fieldMetadata.name]}>
                    </div>
                {:else if fieldMetadata.type == 'array:string'}
                    <div class="form-group field-edition">
                        <label for="{properties.id}-field-{fieldMetadata.name}">{fieldMetadata.label} : </label>
                        <MultiStringEditor bind:stringArray={properties[fieldMetadata.name]} on:blur={() => properties = properties}></MultiStringEditor>
                    </div>
                {/if}
            {:else}
                <div class="form-group field-edition">
                    <label for="{properties.id}-field-{fieldMetadata.name}">{fieldMetadata.label} : </label>
                    <div class="non-editable">{properties[fieldMetadata.name]}</div>
                </div>
            {/if}
        {/if}
    {/each}
</form>