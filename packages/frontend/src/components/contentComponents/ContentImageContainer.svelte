<!--

properties.uri : string => the url of the image
properties.style : string => the css style string
properties.classes : the list of classes
properties.content : an html content to be added in the image div

-->

<script>
    import {onMount, afterUpdate} from 'svelte'

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

{#if isCrossDomain()}
    <div style={properties.style} class={properties.classes}>
        <img style="max-height: 100%; max-width: 100%;" src={properties.uri} crossorigin="anonymous">
        {#if properties.content}
            {@html properties.content}
        {/if}
    </div>
{:else}
    <div style="background-image: url('{properties.uri}'); {properties.style}" class="{properties.classes}">
        {#if properties.content}
            {@html properties.content}
        {/if}
    </div>
{/if}

