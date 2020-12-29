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
            const canvas = document.getElementById(`${media.key}`);
            const ctx = canvas.getContext('2d');
            const img = new Image();
            img.onloadeddata = () => {
                console.log('plop1')
            };
            img.onload = () => {
                console.log('plop2')
                ctx.drawImage(img, 0, 0);
            };
            img.onerror = (err) => {
                console.log(err)
            }
            const localBuffer = new Uint8Array(media.blob.data);
            const blob = new Blob([localBuffer], { type: media.mediaType});
            img.src = URL.createObjectURL(blob);
        }
    })

</script>

<style>
    .attachment {
        height:50px;
        width:50px;
        background:red;
        margin:5px;
    }
</style>



<div class="attachment">
    {#if media && media.mediaType.indexOf('image') >= 0}
      <canvas id="{media.key}"></canvas>
    {/if}
</div>