<!--

properties.uri : string => the url of the image
properties.style : string => the css style string
properties.classes : the list of classes
properties.content : an html content to be added in the image div

-->

<script>
    import {onMount, afterUpdate} from 'svelte'
    import {Helpers} from '../../helpers/Helpers';

    export let properties;

    onMount(() => {
        if(!properties.uri) {
            properties.uri='';
            properties = properties;
        }
    })

    afterUpdate(() => {
        console.log('updated');
    })

    function isCrossDomain() {
        const loc = window.location;
        const a = document.createElement('a');
        a.href = properties.uri;
        console.log(a);
        console.log(loc);
        return properties.uri === undefined ||
               a.hostname !== loc.hostname ||
               a.port !== loc.port ||
               a.protocol !== loc.protocol
    }

</script>

<style>
    .default-image-container {
        width:100%;
        height:100%;
    }
</style>

{#if isCrossDomain()}
    <div style="{properties.style?properties.style:''}" class="default-image-container {properties.classes?properties.classes:''}">
        {#if properties.globalStyle}
            {@html Helpers.styleOpeningLabel + properties.innerStyle + Helpers.styleClosingLabel}
        {/if}
        <img style="max-height: 100%; max-width: 100%;" src={properties.uri?properties.uri:''} crossorigin="anonymous" alt="{properties.uri?properties.uri:''}">
        {#if properties.content}
            {@html properties.content}
        {/if}
    </div>
{:else}
    <div style="background-image: url('{properties.uri?properties.uri:''}'); {properties.style?properties.style:''}"
         class="default-image-container {properties.classes?properties.classes:''}">
        {#if properties.globalStyle}
            {@html Helpers.styleOpeningLabel + properties.innerStyle + Helpers.styleClosingLabel}
        {/if}
        {#if properties.content}
            {@html properties.content}
        {/if}
    </div>
{/if}

