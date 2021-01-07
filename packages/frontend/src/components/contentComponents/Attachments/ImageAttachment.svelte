<script>
    import {AttachmentHelpers} from "./AttachmentHelpers";

    export let attachment
</script>

<style>
    .attachment-image {
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        width:100% !important;
        height:100%;
        min-height: 25vh;
        max-height:30vh;
    }
</style>

<div id="image-{attachment.id}" class="attachment-image" style="background-image: {AttachmentHelpers.getImageUrl(attachment)}"></div>