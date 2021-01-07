<script>
    import {AttachmentHelpers} from "./AttachmentHelpers";

    export let attachment;

    function handleVideoClick(event) {
        if (event.target && event.target.play) {
            event.target.play();
        }
    }

</script>

<style>
    .postAudio {
        max-height: 50vh;
    }
</style>

<audio id="{`video-${attachment.key}`}"
       on:click={handleVideoClick}
       controls
       class="postAudio"
       src="{AttachmentHelpers.getDownloadUrl(attachment)}"
       type="{attachment.mediaType}" >
    <track kind="captions">
    Your browser doesn't support audio tag. Please update your browser.
</audio>