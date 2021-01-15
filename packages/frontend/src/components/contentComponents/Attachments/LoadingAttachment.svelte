<script>
    import {AttachmentHelpers} from "./AttachmentHelpers";
    export let attachment;
</script>

<style>
    .loading-container {
        border: solid 1px lightgray;
        width:250px !important;
        height:150px !important;
        border-radius: 5px;
        display: flex;
        justify-content: center;
        align-items: center;
        align-self: center;
    }

    .spinner-loading {
        width:75px !important;
        height:75px !important;
        z-index: 3;
    }

    .medias-loading {
        position: absolute;
        color: lightgray;
        z-index: 0;
    }
</style>

<div class="loading-container" id="{attachment}" title="Chargement ...">
    <div class="spinner-border spinner-loading text-danger" ></div>
    <div class="medias-loading">
        <i class="fas fa-3x fa-video"></i>
        <i class="fas fa-3x fa-volume-up"></i>
        <i class="fas fa-3x fa-image"></i>
    </div>
</div>