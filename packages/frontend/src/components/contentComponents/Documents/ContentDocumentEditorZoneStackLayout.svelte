<script>
    import {EditableDocumentStore} from "../../../stores/EditableDocumentStore";
    import BlockDropZone from './BlockDropZone.svelte';
    import BlockEditor from '../Editors/BlockEditor.svelte';
    import {afterUpdate} from 'svelte';

    export let zone;

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
        EditableDocumentStore.update(eds => {
            console.log('before update ')
            if(!Array.isArray(eds.document.content[zone])){
                eds.document.content[zone] = [];
            }
            eds.document.content[zone].push(newBlock);
            return eds;
        })
    }

    afterUpdate(() => {
        console.log(`after update in zone ${zone}`);
        console.log($EditableDocumentStore)
        console.log('#');
    })
</script>

{#if $EditableDocumentStore &&
     $EditableDocumentStore.document &&
     $EditableDocumentStore.document.content &&
     $EditableDocumentStore.document.content[zone] &&
     Array.isArray($EditableDocumentStore.document.content[zone]) && $EditableDocumentStore.document.content[zone].length > 0}
    {#each [...$EditableDocumentStore.document.content[zone]].sort((c1, c2) => {
        if(c1.order > c2.order)
            return 1;
        if(c1.order < c2.order)
            return -1;
        return 0;
    }) as component}
        <BlockDropZone zone={zone}
                       isBefore={true}
                       order={typeof component.order === 'number'?component.order - 1:0}
                       on:drop={onDropComponent}
        ></BlockDropZone>
        <BlockEditor component={component} zone="{zone}"></BlockEditor>
        <BlockDropZone zone={zone}
                       order={typeof component.order === 'number'?component.order + 1:1}
                       on:drop={onDropComponent}
        ></BlockDropZone>
    {/each}
{:else}
    <BlockDropZone zone={zone}
                   order={0}
                   on:drop={onDropComponent}
    ></BlockDropZone>
{/if}