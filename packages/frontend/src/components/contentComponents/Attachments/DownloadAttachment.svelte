<script>
    import {AttachmentHelpers} from "./AttachmentHelpers";

    export let attachment;

    let icons = {
        'application/pdf': 'fa-file-pdf'
    }

</script>

<style>
    .attachment-download {
        display: flex;
        min-width: 50px;
        max-width: 150px;
        white-space: nowrap;
        height: 50px;
        overflow-x: hidden;
        overflow-y: hidden;
    }

    .attachment-download > label {
        margin-bottom: 0;
        margin-left: 5px;
    }
</style>

<a id="download-{attachment.id}" class="attachment-download" href="{AttachmentHelpers.getDownloadUrl(attachment)}" target="_blank">
    <div class="attachment-download">
        <i class="fas fa-2x {icons[attachment.mediaType]}"></i>
        <label>{attachment.label}</label>
    </div>
</a>