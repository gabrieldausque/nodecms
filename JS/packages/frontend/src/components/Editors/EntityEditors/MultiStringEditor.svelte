<script lang="ts">

    import {createEventDispatcher} from 'svelte';

    const dispatch = createEventDispatcher();

    export let stringArray:string[];

    //TODO : create a multistring input to manage

    async function onNewElement(event) {
        const element = event.target;
        const newValues = element.innerText.split(',');
        let hasNew = false;
        for(let newValue of newValues){
            if(newValue &&
                newValue.trim() !== '' &&
                element.innerHTML != '&nbsp') {
                console.log(`#${newValue}#`);
                stringArray.push(newValue.trim());
                hasNew = true;
            }
        }
        if(hasNew)
            dispatch('blur')
        element.innerHTML='&nbsp;';
    }

</script>

<style>
    .multi-string-container {
        display: flex;
        flex-wrap: wrap;
        flex-direction: row;
        justify-content: flex-start;
        align-items: center;
        width: 100%;
    }

    .multi-string-element {
        display: flex;
        justify-content: center;
        align-items: center;
        background: lightcoral;
        color: white;
        padding-left: 5px;
        padding-right: 5px;
        margin: 5px;
        border-radius: 10px;
        height:35px;

    }

    .new-element {
        min-width: 10px;
        display: flex;
        vertical-align: middle;
        justify-content: flex-start;
        align-items: flex-start;
        word-break: break-all;
        word-wrap: break-word;
        text-align: left;
        flex-grow: 1;
        border: dashed lightgray 1px;
    }

    .new-element:empty:not(:focus):before{
        content:'Taper ici...';
        color:grey;
        font-style: italic;
    }
</style>

<div class="multi-string-container">
    {#each stringArray as element}
        <div class="multi-string-element">{element}</div>
    {/each}
    <div class="new-element" contenteditable="true" on:blur={onNewElement}>&nbsp;</div>
</div>