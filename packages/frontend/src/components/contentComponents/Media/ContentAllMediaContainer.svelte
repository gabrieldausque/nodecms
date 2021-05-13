<script>

    import {AllMediaStores} from "../../../stores/AllMediaStores";

    $AllMediaStores;

</script>

<style>
    .all-media-panel {
        display: flex;
        height:100%;
    }
    .media-menu {
        flex-grow: 1;
        min-width: 10vw;
    }
    .media-menu li.list-group-item-action {
        display: flex;
        align-items: center;
        text-align: start;
    }
    .media-action > span {
        margin-left: 5px;
    }
    .all-media-list {
        flex-grow: 3;
        height:100%;
        max-height: 100%;
        min-height:100%;
        overflow: hidden;
        background: white;
    }

    .media-search-bar-container {
        width: calc(100% - 10px);
        position: relative;
        margin: 5px;
    }

    .media-search-bar {
        width: 100%;
    }

    .do-search {
        position: absolute;
        top: 1px;
        right: 1px;
        display: flex;
        justify-content: center;
        align-items: center;
        height: calc(100% - 10px);
    }

    .documents {
        overflow-y: auto;
    }
</style>

<main class="all-media-panel">
    <div class="media-menu">
        <ul class="list-group">
            <li class="media-action list-group-item list-group-item-dark">
                <i class="fas fa-2x fa-upload"></i><span>Ajouter un media</span>
            </li>
        </ul>
    </div>
    <div class="all-media-list">
        <div class="media-search-bar-container">
            <input class="media-search-bar" type="text" id="search-media-keyword" placeholder="Taper le mot clé">
            <button type="button" class="do-search btn btn-light"><i class="fas fa-search"></i></button>
        </div>
    </div>
</main>