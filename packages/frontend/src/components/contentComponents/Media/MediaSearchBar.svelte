<script>
    import {AllMediaStores} from "../../../stores/AllMediaStores";
    import {createEventDispatcher} from 'svelte';
    import {onMount, onDestroy} from 'svelte';

    import _ from 'underscore';

    const dispatch = createEventDispatcher();
    const searchMedia = _.debounce(debounceSearchMedia, 1000);
    async function debounceSearchMedia() {
        const services = await getBackendClient();
        const results = [];
        const searchBar = document.getElementById('search-media-keyword')
        try{
            if(searchBar.value){
                const searchPromises = [];
                for(const keyword of searchBar.value.split(' ')){
                    searchPromises.push(services.mediaService.getMediaMetadata(keyword));
                    searchPromises.push(services.mediaService.findMedia({
                        label: keyword
                    }))
                }
                searchPromises.push(services.mediaService.findMedia({
                    tags: searchBar.value.split(' ')
                }))
                const searchResults = await Promise.all(searchPromises);
                const pushFoundMedia = (media) => {
                    if(media && results.findIndex(m => m.id === media.id) < 0){
                        results.push(media)
                    }
                }
                for(const result of searchResults){
                    if(Array.isArray(result)){
                        for(const m of result){
                            pushFoundMedia(m)
                        }
                    } else {
                        pushFoundMedia(result)
                    }
                }
                if(results.length > 0){
                    AllMediaStores.update(ams => {
                        ams.media = results;
                        return ams;
                    })
                }
            } else {
                AllMediaStores.update(ams => {
                    ams.media = [];
                    return ams;
                })
            }

        } catch(error) {
            globalFEService.getService('displayError').displayError('Erreur pendant la recherche', error.message)
        } finally {
            dispatch('search-ended');
        }
    }

    onMount(() => {
        console.log('mounting search bar');
    })

    onDestroy(() => {
        AllMediaStores.update((ams) => {
            ams.media = [];
            return ams;
        })
    })

    function onKeyUp() {
        dispatch('search-started');
        AllMediaStores.update(ams => {
            ams.media = [];
            return ams;
        })
        searchMedia()
    }
</script>

<style>
    .media-search-bar-container {
        width: calc(100% - 10px);
        position: relative;
        margin: 5px;
        display: flex;
        justify-content: flex-start;
        align-items: center;
    }
    .media-search-bar {
        width: calc(100% - 44px);
        border-bottom-right-radius: 0 ;
        border-top-right-radius: 0;
        margin:0;
    }
    .media-search-bar:focus-visible {
        border-bottom-right-radius: 0 ;
        border-top-right-radius: 0;
    }
    .do-search {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 39px;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
        margin: 0;
    }
</style>

<div class="media-search-bar-container">
    <input class="media-search-bar"
           type="text"
           id="search-media-keyword"
           placeholder="Taper votre recherche"
           on:keyup={onKeyUp}
    >
    <button type="button" class="do-search btn btn-dark"><i class="fas fa-search"></i></button>
</div>