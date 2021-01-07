<script>
    import {onMount} from "svelte";
    import {getBackendClient} from "../../api/NodeCMSClient";
    import ContentChannelContainer from './ContentChannelContainer.svelte';

    export let properties;
    export let channelKey;
    let channel;

    let backEndService = null;

    window.addEventListener('backend-ready', () => {
        backEndService = getBackendClient();
    })

    onMount(async () => {
        if(!backEndService)
            backEndService = getBackendClient();
        if(properties)
        {
            channelKey = properties.channelKey;
            channel = await backEndService.getChannel(channelKey);
        }
        //TODO : get list of channel
    });

</script>

<style>
    .channelPanel {
        display: flex;
        width:100%;
        height:100%;
    }
    .channelsMenu {
        flex-grow: 1;
        width:25vw;
    }
</style>
<main class="channelPanel">
    <div class="channelsMenu">

    </div>
    <ContentChannelContainer channel="{channel}"></ContentChannelContainer>

</main>

