<script>

    import {getBackendClient} from "../../api/NodeCMSClient";
    import {afterUpdate, onMount} from "svelte";

    export let key;
    export let label;
    export let visibility;
    export let file;
    let src = 'defaultImageUrl';
    export let media;

    onMount(async () => {
        window.setTimeout(async () => {
            if(!media && file){
                const backEndService = getBackendClient();
                if(!await backEndService.mediaService.mediaExists(key)){
                    await backEndService.mediaService.createMedia(file, key, label, visibility);
                }
                media = await backEndService.mediaService.getMedia(key);
                console.log('adding media')
                console.log(media);
            } else if(media){
                console.log('reading media')
                console.log(media);
            }
        }, 200)
    })

    afterUpdate(async() => {
        if(media && media.mediaType.indexOf('image') >= 0) {
            const div = document.getElementById(`${media.key}`);
            const localBuffer = new Uint8Array(media.blob.data);
            const blob = new Blob([localBuffer], { type: media.mediaType});
            div.style.backgroundImage = `url(${URL.createObjectURL(blob)})`;
            console.log('style done');
        }
    })

</script>

<style>
    .attachment {
        height:50px;
        width:50px;
        margin:5px;
        padding:5px;
        border: solid 1px lightgray;
        border-radius: 5px;
    }

    .attachment-image {
        height:100%;
        width:100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
    }
</style>



<div class="attachment">
    {#if media && media.mediaType.indexOf('image') >= 0}
      <div class="attachment-image" id="{media.key}"></div>
    {/if}
</div>