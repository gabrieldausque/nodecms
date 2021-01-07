<script>
    import {globalContentContainerFactory} from "../../ContentContainerFactory";
    import {getBackendClient} from '../../NodeCMSClient';
    import {beforeUpdate, onMount} from 'svelte';
    import ContentTitle from "./ContentTitle.svelte";

    let backEndService = null;
    export let properties;
    export let documentKey;

    const availableDocuments = {
        welcome: {
            globalStyle:`
            h2 {
                font-family: Army, serif;
                margin-top: 90px;
            }

            .documentContainer {
                display: flex;
                flex-direction:column;
                align-items: center;
                justify-content: center;
                height:100%;
                width:100%
            }

            .main-logo {
                height: initial !important;
                width: initial !important;
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
                        globalStyle: `
                        @keyframes animatedBorderTop {
                            0% {
                                left:-30px; height:3px; width:0px;
                            }
                            50% {
                                left:-30px; height: 3px; width: calc(100% + 60px);
                            }
                            100% {
                                left: calc(100% + 27px); height:3px; width:3px;
                            }
                        }

                        @keyframes animatedBorderRight {
                            0% {
                                top:-30px; left: calc(100% + 27px); height:0px; width:3px;
                            }
                            50% {
                                top:-30px;left: calc(100% + 27px); height: calc(100% + 57px); width: 3px;
                            }
                            100% {
                                top: calc(100% + 30px); height: 0px; width:3px;
                            }
                        }

                        @keyframes animatedBorderBottom {
                            0% {
                                right: -30px; width:0px;
                            }
                            50% {
                                right: -30px; width: calc(100% + 60px);
                            }
                            100% {
                                right: calc(100% + 30px); width:0px;
                            }
                        }

                        @keyframes animatedBorderLeft {
                            0% {
                                bottom:-30px; width:3px; height:0px;
                            }
                            50% {
                                bottom: -30px; height: calc(100% + 60px)
                            }
                            100% {
                                bottom: calc(100% + 30px); height: 0px;
                            }
                        }

                        .main-logo-border-top {
                        position:absolute;
                        background: red;
                        top:-30px;
                        left:-30px;
                        height:3px;
                        width:0px;
                        animation: 10s linear infinite animatedBorderTop;
                        }

                        .main-logo-border-right {
                        position:absolute;
                        background: red;
                        top:-30px;
                        left: calc(100% + 27px);
                        height:0px;
                        width:3px;
                        animation: 10s linear 5s infinite animatedBorderRight;
                        }

                        .main-logo-border-bottom {
                        position:absolute;
                        background: red;
                        bottom: -30px;
                        right: -30px;
                        height:3px;
                        width:0px;
                        animation: 10s linear infinite animatedBorderBottom;
                        }

                        .main-logo-border-left {
                        position:absolute;
                        background: red;
                        bottom: -30px;
                        left: -30px;
                        height:0px;
                        width:3px;
                        animation: 10s linear 5s infinite animatedBorderLeft;
                        }
                        `,
                        classes: "main-logo",
                        style:"",
                        headers:[],
                        bodies:[
                            {
                                order:1,
                                type:'image',
                                properties: {
                                    uri:"http://myhost.domain:3030/a-team_logo.png",
                                    style:`
                        width:50vh;
                        height:50vh;
                        border: red solid 1px;
                        background-repeat: no-repeat;
                        background-position: center;
                        background-size: cover;
                        overflow: visible;
                        position: relative;
                        `,
                                    content:  `
                        <div class="main-logo-border-top"></div>
                        <div class="main-logo-border-right"></div>
                        <div class="main-logo-border-bottom"></div>
                        <div class="main-logo-border-left"></div>
                        `
                                }
                            }],
                        footers:[]
                    }
                }
            ],
            footers:[]
        },
        welcomePrivate: {
            bodies:[
                {
                    order:0,
                    type:'channel',
                    properties:{
                        channelKey:"news"
                    }
                }
            ]
        }
    }

    window.addEventListener('backend-ready', () => {
        backEndService = getBackendClient();
    })

    function getDocument() {
        //let rawDocument =  await backEndService.getDocument(documentKey);
        if(documentKey && availableDocuments.hasOwnProperty(documentKey)){
            properties = null;
            let rawDocument = availableDocuments[documentKey];
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
        } else if(documentKey && ! availableDocuments.hasOwnProperty(documentKey)){
            properties = null;
        }
    }

    onMount(async () => {
        getDocument()
    })

    beforeUpdate(async() => {
        getDocument();
    })

</script>

<style>
    main {
        height:100%;
        width:100%;
        display:flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
</style>
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
