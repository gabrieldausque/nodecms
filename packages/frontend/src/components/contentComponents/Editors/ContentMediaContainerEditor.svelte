<!--
    properties : {
        content: "" ==> an html content
        globalStyle: "" ==>  a <style> content that will be added at the beginning of the html element
        key: "" ==> the key of the media
        mediaType: "" ==> the MIME type of the media
        style: "" ==> the style attribute of the media component
    }
-->

<script>

    import Editor from "cl-editor";
    import {v4 as uuid} from 'uuid';
    import {onMount} from 'svelte';
    import {EditableDocumentStore} from "../../../stores/EditableDocumentStore";
    import HighlightedEditor from "../HighlightedEditor.svelte";
    import MediaSearchBar from "../Media/MediaSearchBar.svelte";
    import {AllMediaStores} from "../../../stores/AllMediaStores";
    import {Helpers} from "../../../helpers/Helpers";

    $AllMediaStores;
    export let properties;
    let id = uuid();

    onMount(() => {
        window.setTimeout(() => {
            const contentText = document.getElementById(`content-${id}`)
            console.log(contentText);
            const editor = new Editor({
                target: contentText,
                props: {
                    actions: [
                        'b', 'i', 'u', 'strike', 'ul', 'ol', 'viewHtml'
                    ],
                    html: properties.content
                }
            });
            editor.$on('change', (e) => {
                properties.content = editor.getHtml();
                updateEds();
            })
            window.setTimeout(() => {
                document.querySelector('button[title="View HTML"]').click();
            })
        })
    })

    function updateEds() {
        EditableDocumentStore.update(eds => {
            return eds;
        })
    }

    function onSearchStarted() {

    }

    async function onMediaClick(event){
        console.log('receive media click ...');
        console.log(event);
        const services = await getBackendClient();
        if(event.detail &&
           event.detail.target &&
           event.detail.target.getAttribute('data-media-key')
        ) {
            console.log('updating media')
            const mediaMetadata = await services.mediaService.getMediaMetadata(event.detail.target.getAttribute('data-media-key'));
            console.log(mediaMetadata);
            if(mediaMetadata && mediaMetadata.key !== properties.key){
                properties.key = mediaMetadata.key;
                properties.mediaType = mediaMetadata.mediaType;
                properties = properties;
                updateEds();
            }
        }
    }

</script>

<style>
    label {
        text-align: start;
    }

    .content {
        text-align: start;
    }

    .media {
        display: flex;
        flex-direction: column;
    }

    .all-media-list {
        min-height: 25vh;
    }
</style>

<div>
    <div class="media">
        <label for="media">Media :</label>
        <svelte:component this={Helpers.getAttachmentComponent(properties.mediaType)} attachment={properties.key}/>
        <div id="media">
            <MediaSearchBar on:search-started={onSearchStarted}></MediaSearchBar>
            <div class="all-media-list">
                {#each $AllMediaStores.media as media}
                    <div class="media-container">
                        <svelte:component on:click={onMediaClick} this={Helpers.getAttachmentComponent(media.mediaType)} attachment={media.key}/>
                    </div>
                {/each}
            </div>
        </div>

    </div>
    <div class="global-style">
        <label for="globalStyle">Global Style :</label>
        <HighlightedEditor
                id="globalStyle"
                content={properties.globalStyle}
                onChange={(newStyle) => {
                    properties.globalStyle = newStyle
                updateEds();
            }}
        ></HighlightedEditor>
    </div>
    <div class="style">
        <label for="style">Style :</label>
        <HighlightedEditor
                id="style"
                content={properties.style}
                onChange={(newStyle) => {
                    properties.style = newStyle
                updateEds();
            }}
        ></HighlightedEditor>
    </div>
    <div class="content">
        <label for="content-{id}">Contenu HTML :</label>
        <div id="content-{id}">
        </div>
    </div>
</div>

