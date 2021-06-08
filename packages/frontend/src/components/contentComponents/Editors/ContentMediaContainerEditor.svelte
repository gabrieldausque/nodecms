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

    import Editor from "cl-editor/src/Editor.svelte";
    import {v4 as uuid} from 'uuid';
    import {onMount, onDestroy} from 'svelte';
    import {EditableDocumentStore} from "../../../stores/EditableDocumentStore";
    import HighlightedEditor from "../HighlightedEditor.svelte";
    import MediaSearchBar from "../Media/MediaSearchBar.svelte";
    import {AllMediaStores} from "../../../stores/AllMediaStores";
    import {Helpers} from "../../../helpers/Helpers";
    import UploadMediaModal from "../Media/UploadMediaModal.svelte";
    import {ShowUploadModalStore, ShowUploadModal} from "../../../stores/ShowUploadModalStore";

    $AllMediaStores;

    export let properties;
    let id = uuid();

    onMount(() => {
        console.log(properties);
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

    onDestroy(() => {
        AllMediaStores.media = [];
    })

    function updateEds() {
        EditableDocumentStore.update(eds => {
            return eds;
        })
    }

    function onSearchStarted() {
        document.querySelector('.searching').classList.add('show');
    }

    function onSearchEnded() {
        document.querySelector('.searching').classList.remove('show');
    }

    async function onMediaClick(event) {
        const services = await getBackendClient();
        if (event.detail &&
            event.detail.target &&
            event.detail.target.getAttribute('data-media-key')
        ) {
            console.log('updating media')
            const mediaMetadata = await services.mediaService.getMediaMetadata(event.detail.target.getAttribute('data-media-key'));
            console.log(mediaMetadata);
            if (mediaMetadata && mediaMetadata.key !== properties.key) {
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

    :global(.highlightEditor) {
        max-height: 25vh;
        overflow-y: auto;
    }

    #media-select-zone {
        height:25vh;
        max-height:25vh;
        width:100%;
        max-width: 100%;
        overflow:hidden;
    }

    #media-select-zone .all-media-list {
        overflow-y: auto;
        height: calc(100% - 39px);
        min-height: calc(100% - 39px);
        max-height: calc(100% - 39px);
        display: flex;
        flex-wrap: wrap;
        position: relative;
    }

    .media-editor :global(.attachment-image),
    .media-editor :global(.attachment-video),
    .media-editor :global(.attachment-download),
    .media-editor :global(.attachment-upload),
    .media-editor .media-container
    {
        min-height: 100px;
        max-height: 150px;
        min-width: 100px;
        max-width: 150px;
    }

    .searching {
        width: 50%;
        height: 5vh;
        align-self: center;
        justify-self: center;
        bottom: calc(50% - 20px);
        left:calc(50% - 100px);
        position: absolute;
        font-size: 2vh;
        display: none;
    }

    .searching .first-point {
        animation: 1s linear infinite fading;
    }

    .searching .second-point {
        animation: 1s linear 250ms infinite fading;
    }

    .searching .third-point {
        animation: 1s linear 500ms infinite fading;
    }

    :global(.searching.show) {
        display: flex !important;
    }

    @keyframes fading {
        50% { opacity: 0}
    }

    .media-container {
        margin: 15px;
        height: fit-content;
        width: fit-content;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .media-container:hover {
        border: solid red 5px !important;
        border-radius: 5px !important;
    }

    .media-container.selected {
        border: solid blue 2px;
        border-radius: 2px;
    }

    .current-media {
        display: flex;
        justify-content: center;
        width: 100%;
    }
</style>

<div class="media-editor">
    <div class="media">
        <label for="media">Media :</label>
        <div id="media" class="current-media">
                <svelte:component this={Helpers.getAttachmentComponent(properties.mediaType)} attachment={properties.key}/>
        </div>
        <button type="button" class="btn btn-secondary" on:click={() => {
                const show = new ShowUploadModal();
                show.shown = true;
                ShowUploadModalStore.set(show);
            }}><i class="fas fa-plus-circle">Ajouter un média</button>
        <div id="media-select-zone">

            <MediaSearchBar on:search-started={onSearchStarted} on:search-ended={onSearchEnded}></MediaSearchBar>
            <div class="all-media-list">
                <div class="searching">
                    <span>Recherche en cours</span>
                    <div>
                        <span class="first-point">.</span><span class="second-point">.</span><span class="third-point">.</span>
                    </div>
                </div>
                {#each $AllMediaStores.media as media}
                    <div class="media-container" class:selected={media.key === properties.key} on:click={onMediaClick}>
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
                content={properties.globalStyle?properties.globalStyle:''}
                onChange={(newStyle) => {
                    properties.globalStyle = newStyle
                updateEds();
            }}
        ></HighlightedEditor>
    </div>
    <div class="style">
        <label for="style">Style :</label>
        <HighlightedEditor
                id={`style-${id}`}
                content={properties.style?properties.globalStyle:''}
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

<UploadMediaModal></UploadMediaModal>

