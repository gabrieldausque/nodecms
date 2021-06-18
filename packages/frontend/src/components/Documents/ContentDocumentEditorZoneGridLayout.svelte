<script>
    import {Helpers} from '../../helpers/Helpers';
    import {EditableDocumentStore} from "../../stores/EditableDocumentStore";
    import BlockEditor from "../Editors/BlockEditor.svelte";
    import BlockDropZone from './BlockDropZone.svelte';

    export let zone;

    $EditableDocumentStore;

    function onDropComponent(event){
        event = event.detail;
        if(event.target)
            event.target.classList.remove('on-hover');
        const newBlock = {
            order: typeof event.target.getAttribute('data-order') === 'string'?
                parseInt(event.target.getAttribute('data-order')):0,
            type: event.dataTransfer.getData('constructorType'),
            properties:{}
        }
        const zone = event.target.getAttribute('data-zone');
        let row = parseInt(event.target.getAttribute('data-row'));
        if(event.target.classList.contains('new-row')){
            $EditableDocumentStore.document.content[zone] = $EditableDocumentStore.document.content[zone]?
                $EditableDocumentStore.document.content[zone]:
                [];
            for(const component of $EditableDocumentStore.document.content[zone]){
                if(component.properties.row >= row){
                    component.properties.row++;
                }
            }
        }
        newBlock.properties.row = row;
        newBlock.properties.col = parseInt(event.target.getAttribute('data-col'));

        EditableDocumentStore.update(eds => {
            if(!Array.isArray(eds.document.content[zone])){
                eds.document.content[zone] = [];
            }
            eds.document.content[zone].push(newBlock);
            return eds;
        })
    }

</script>

<style>
    .new-row {
        max-height: 20px;
        width: 100%;
    }
    .new-row {
        max-height: 20px;
        width: 100%;
    }

    .components-col {
        padding: 0;
        display:flex;
        justify-content: center;
        align-items: center;
    }

    .components-col {
        padding: 0;
        display:flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

</style>

{#each Helpers.getRows($EditableDocumentStore.document.content[zone]) as row,rowIndex}
    {#if rowIndex > 0}
        <BlockDropZone
        zone={zone}
        layout="grid"
        row={rowIndex}
        col={0}
        isNewRow={true}
        on:drop={onDropComponent}>
        </BlockDropZone>
    {/if}
    <div class="row">
        {#each row as component,colIndex}
            {#if component.col !== 0 &&
            component.col !== null &&
            typeof component.col === 'number' &&
            !$EditableDocumentStore.document.content[zone].find(c => c.row === rowIndex &&
                c.col === component.col - 1)
            }
                <BlockDropZone
                        zone={zone}
                        layout="grid"
                        row={rowIndex}
                        col={colIndex - 1}
                on:drop={onDropComponent}>
                </BlockDropZone>
            {/if}
            <div class="components-col {component.colSpan?`col-${component.colSpan}`:'col'}">
                <BlockEditor component={component} zone="{zone}" layout="grid"></BlockEditor>
            </div>
            {#if component.col !== null &&
            typeof component.col === 'number' &&
            component.col + component.colSpan?component.colSpan:0 < 12 &&
                !$EditableDocumentStore.document.content[zone].find(c => c.row === rowIndex &&
                c.col === component.col + component.colSpan?component.colSpan:0)
            }
                <BlockDropZone
                        zone={zone}
                        layout="grid"
                        row={rowIndex}
                        col={colIndex + (component.colSpan?component.colSpan:0) + 1}
                on:drop={onDropComponent}>
                </BlockDropZone>
            {/if}
        {/each }
    </div>
{/each}
<BlockDropZone
        zone={zone}
        layout="grid"
        row={ !$EditableDocumentStore.document.content[zone] || $EditableDocumentStore.document.content[zone].length === 0?0:Helpers.getLastRowIndex($EditableDocumentStore.document.content[zone]) + 1}
        col={0}
        isNewRow={true}
        on:drop={onDropComponent}>
</BlockDropZone>