<script>
    import {getBackendClient} from '../NodeCMSClient';
    import { onMount } from 'svelte';
    import DocumentTitle from './documentComponents/DocumentTitle.svelte';
    import DocumentTextContainer from './documentComponents/DocumentTextContainer.svelte';
    import DocumentImageContainer from './documentComponents/DocumentImageContainer.svelte';

    let containersCtors = {
        document: Document,
        text: DocumentTextContainer,
        image: DocumentImageContainer
    };

    let backEndService = null;
    export let documentKey = 'welcome';
    let documentContent = null;

    let title = null;

    let getContainer = (containerType) => {
        if(containersCtors.hasOwnProperty(containerType))
            return containersCtors[containerType]
        return null;
    }

    window.addEventListener('backend-ready', () => {
        backEndService = getBackendClient();
    })

    onMount(async () => {
        // document =  await backEndService.getDocument(documentKey);
        let rawDocument = {
            title: 'A team',
            classes: 'MyClasses',
            containers:[
                {
                    order:1,
                    type:'text',
                    properties:{
                        content:'<h2>This is the Second container content</h2>',
                        style:'color:blue',
                        classes:'myH2Class'
                    }
                },
                {
                    order:0,
                    type:'image',
                    properties: {
                        classes: "main-logo",
                        style:"width:50vh; height:50vh",
                        uri:"http://localhost:3030/a-team_logo.png"
                    }
                }
            ]
        }
        if(Array.isArray(rawDocument.containers)) {
            rawDocument.containers.sort((a,b) =>{
                if(a.order < b.order)
                    return -1
                else if (a.order === b.order)
                    return 0
                else
                    return 1
            })
        }
        documentContent = rawDocument;

        if(documentContent.title)
            title = DocumentTitle
    })

</script>

<div class="document">
    <svelte:component this="{title}" title="{documentContent.title}"></svelte:component>
    {#if documentContent}
        {#if Array.isArray(documentContent.containers)}
            {#each documentContent.containers as container}
                <svelte:component this="{getContainer(container.type)}" properties="{container.properties}"></svelte:component>
            {/each}
        {/if}
    {/if}
</div>