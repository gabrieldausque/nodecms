<script>
    import {onMount} from "svelte";
    import {getBackendClient} from "../../NodeCMSClient";

    export let properties;
    export let channelKey;
    export let channelName;
    export let channelPosts;
    export let channel;


    let backEndService = null;

    window.addEventListener('backend-ready', () => {
        backEndService = getBackendClient();
    })

    onMount(async () => {
        if(!backEndService)
            backEndService = getBackendClient();

        if(properties){
            if(properties.channelKey){
                channelKey = properties.channelKey;
                channel = await backEndService.getChannel(channelKey);
                channelName = (channel.label)?channel.label:channelKey;
                channelPosts = await backEndService.getChannelPosts(channelKey)
            }
        }
    })

</script>

<style>
    .channel {
        height:100%;
        width:100%;
        background:white;
        overflow-y:auto;

    }

    .channelInfo {
        position:fixed;
        width: 100%;
        height: 50px;
        display: flex;
        align-items: center;
        border-bottom: solid lightgray 1px;
    }
</style>

<div class="channel">
    {#if properties}
        <div class="channelInfo">
            <span><strong>#{channelName}</strong></span>
        </div>
    {/if}
</div>

