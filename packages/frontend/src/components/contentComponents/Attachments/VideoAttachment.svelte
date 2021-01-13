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
    .postVideo {
        max-height: 50vh;
    }
</style>

<video id="{`video-${attachment.key}`}"
       controls
       on:click={handleVideoClick}
       class="postVideo"
       src="{AttachmentHelpers.getDownloadUrl(attachment)}"
       type="{attachment.mediaType}" >
    <track kind="captions">
    Your browser doesn't support video tag. Please update your browser.
</video>