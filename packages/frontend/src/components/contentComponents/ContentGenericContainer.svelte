<script>
    import {globalContentContainerFactory} from "../../ContentContainerFactory";
    import {getBackendClient} from '../../NodeCMSClient';
    import { onMount } from 'svelte';
    import ContentTitle from "./ContentTitle.svelte";

    let backEndService = null;
    export let properties;
    export let documentKey;

    window.addEventListener('backend-ready', () => {
        backEndService = getBackendClient();
    })

    onMount(async () => {
        if(documentKey){
            //let rawDocument =  await backEndService.getDocument(documentKey);
            let rawDocument = {

                globalStyle:`
            h2 {
                font-family: Army, serif
            }

            .documentContainer {
                display: flex;
                flex-direction:column;
                align-items: center;
                justify-content: center;
                height:100%;
                width:100%
            }
            `,
                style: ``,
                classes: 'documentContainer',
                headers:[],
                bodies:[
                    {
                        order:1,
                        type:'text',
                        properties:{
                            content:'<h2>Servir sans faillir</h2>',
                            style:`font-family: Army; color: white`,
                            classes:'myH2Class'
                        }
                    },
                    {
                        order:0,
                        type:'generic',
                        properties: {
                            classes: "main-logo",
                            style:"",
                            headers:[],
                            bodies:[{
                                order:1,
                                type:'image',
                                properties: {
                                    uri:"http://localhost:3030/a-team_logo.png",
                                    style:`
                        width:50vh;
                        height:50vh;
                        border: red solid 1px;`
                                }
                            }],
                            footers:[]
                        }
                    }
                ],
                footers:[]
            }
            let sortFunction = (a,b) =>{
                if(a.order < b.order)
                    return -1
                else if (a.order === b.order)
                    return 0
                else
                    return 1
            };
            if(Array.isArray(rawDocument.headers)) {
                rawDocument.headers = rawDocument.headers.sort(sortFunction)
            }
            if(Array.isArray(rawDocument.bodies)) {
                rawDocument.bodies = rawDocument.bodies.sort(sortFunction)
            }
            if(Array.isArray(rawDocument.footers)) {
                rawDocument.footers = rawDocument.footers.sort(sortFunction)
            }
            properties = rawDocument
        }
    })

</script>

{#if properties}
    {#if typeof properties.globalStyle === "string"}
        {@html "<style>" + properties.globalStyle + "</style>"}
    {/if}
    {#if Array.isArray(properties.headers) && properties.headers.length > 0}
        <header>
            {#each properties.headers as container}
                <svelte:component this="{globalContentContainerFactory.getContentContainer(container.type)}" properties="{container.properties}"></svelte:component>
            {/each}
        </header>
    {/if}
    <main class="{properties.classes}" style="{properties.style}">
        <svelte:component this="{properties.title}" title="{properties.title}"></svelte:component>
        {#if Array.isArray(properties.bodies)}
            {#each properties.bodies as container}
                <svelte:component this="{globalContentContainerFactory.getContentContainer(container.type)}" properties="{container.properties}"></svelte:component>
            {/each}
        {/if}
    </main>
    {#if Array.isArray(properties.header) && properties.header.length > 0}
        <footer>
            {#each properties.header as container}
                <svelte:component this="{globalContentContainerFactory.getContentContainer(container.type)}" properties="{container.properties}"></svelte:component>
            {/each}
        </footer>
    {/if}
{/if}
