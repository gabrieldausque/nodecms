<script>
    export let id;
    export let content;
    export let onChange;
    let toUpdate;

    import hljs from 'highlight.js/lib/core';
    import _ from 'underscore';
    import {onMount, onDestroy} from 'svelte';
    import json from 'highlight.js/lib/languages/json'
    import css from 'highlight.js/lib/languages/css'

    hljs.registerLanguage('json',json);
    hljs.registerLanguage('css', css);

    const highlight = (htmlElement) =>{
        hljs.highlightBlock(htmlElement);
        const reg = new RegExp(/\u00A0/g)
        if(typeof onChange === 'function'){
            onChange(htmlElement.textContent.replace(reg,''))
        }
    };

    onMount(() => {
        document.querySelectorAll('.highlightEditor').forEach(htmlElement => {
            hljs.highlightBlock(htmlElement);
        })
    })

    onDestroy(() => {

    })

</script>

<svelte:head>
    <link rel="stylesheet"
          href="/css/highlight/highlight.css">
</svelte:head>

<style>

    .highlightEditor {
        white-space: pre;
        text-align: start;
    }

    :global(.hljs-string) {
        white-space: pre-line;
    }

</style>

<div id={id} contenteditable="true" class="highlightEditor" on:keyup={() => {
    toUpdate = true;
}}>
    {content}
</div>
<button class="btn {toUpdate?'btn-success':''}" disabled="{toUpdate?'':'disabled'}" type="button" on:click={() => {
        highlight(document.getElementById(id));
        toUpdate = false;
    }}>Mettre à jour</button>