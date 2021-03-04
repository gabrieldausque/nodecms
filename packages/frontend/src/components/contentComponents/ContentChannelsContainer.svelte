<script>
    import {onMount} from "svelte";
    import {getBackendClient} from "../../api/NodeCMSClient";
    import ContentChannelContainer from './ContentChannelContainer.svelte';
    import {channelsEventNames} from "../../api/ChannelsService";
    import {globalFEService} from "../../FEServices";
    import {AttachmentHelpers} from "../../api/AttachmentHelpers";
    import {ChannelContent, ChannelStore} from "../../stores/ChannelStore";
    import {ActivePostStore} from "../../stores/ActivePostStore";
    import {Helpers} from "../../helpers/Helpers";

    export let properties;
    let availableChannels = [];

    onMount(async () => {
        const backEndService = await getBackendClient();
        availableChannels = await backEndService.channelsService.getAvailableChannels();
        if(properties && properties.channelKey)
        {
            await changeCurrentChannel(properties.channelKey);
        }
    });

    document.addEventListener(channelsEventNames.channelsActions, async() => {
        const backEndService = await getBackendClient();
        availableChannels = await backEndService.channelsService.getAvailableChannels();
    })

    async function showCreateChannel(event) {
        jQuery('#CreateChannelModal').modal('show');
    }

    async function createChannel(event) {
        const errorAlertContent = document.getElementById('errorOnCreatingChannelContent');
        const errorAlert = document.getElementById('errorOnCreatingChannel');
        if(await validateNewChannel()) {
            try {
                const backendService = await getBackendClient();
                const data = {
                    key: document.querySelector('#channelKey').value,
                    label: document.querySelector('#channelLabel').value,
                    visibility: document.querySelector('#channelVisibility').value
                }
                await backendService.channelsService.createChannel(data);
                jQuery('#CreateChannelModal').modal('hide');
                document.querySelector('#channelKey').value = null;
                document.querySelector('#channelLabel').value = null;
                document.querySelector('#channelVisibility').value = 'private';
            }catch(error){
                console.log(error);
                errorAlertContent.innerText = error.message;
                errorAlert.classList.add('show');
            }
        } else {
            errorAlertContent.innerText = 'Impossible de créer le Canal. Vérifier ses paramètres';
            errorAlert.classList.add('show');
        }
    }

    async function validateNewChannel() {
        const form = document.getElementById('CreateChannelForm');
        const p = new Promise((resolve) => {
            form.querySelectorAll('input').forEach((i) => {
                i.dispatchEvent(new Event('change'));
            })
            resolve()
        })
        await p;
        const backendService = await getBackendClient();
        const data = {
            key: document.querySelector('#channelKey').value,
            label: document.querySelector('#channelLabel').value,
            visibility: document.querySelector('#channelVisibility').value
        }
        return data.key && data.label && data.visibility && !(await backendService.channelsService.exists(data.key));
    }

    async function onLabelChanged(event) {
        const keyInput = document.getElementById('channelKey');
        const labelInput = document.getElementById('channelLabel');
        if(!keyInput.value){
            keyInput.value = labelInput.value;
            keyInput.dispatchEvent(new Event('change'));
        }
        if(!labelInput) {
            labelInput.classList.remove('is-valid');
            labelInput.classList.add('is-invalid');
        } else {
            labelInput.classList.remove('is-invalid');
            labelInput.classList.add('is-valid');
        }
    }

    async function onKeyChanged(event) {
        const backendService = await getBackendClient();
        const keyInput = document.getElementById('channelKey');
        const labelInput = document.getElementById('channelLabel');
        if(!labelInput.value){
            labelInput.value = keyInput.value;
        }
        if(!labelInput) {
            labelInput.classList.add('is-invalid');
            labelInput.dispatchEvent(new Event('change'));
        } else {
            if(await backendService.channelsService.exists(keyInput.value)){
                keyInput.classList.remove('is-valid');
                keyInput.classList.add('is-invalid');
            } else {
                keyInput.classList.remove('is-invalid');
                keyInput.classList.add('is-valid');
            }
        }
    }

    const visibilityTooltips = {
        private: "Un canal privé n'est accessible et visible que par ses membres",
        protected: "Un canal protégé est visible par tout utilisateur authentifié et accessible uniquement par ses membres",
        public: "Un canal public est visible et accessible par tout utilisateur identifié"
    }

    async function onVisibilityChanged(event) {
        const visibility = document.getElementById('channelVisibility');
        visibility.title = visibilityTooltips[visibility.value];
    }

    async function changeCurrentChannelOnclick(event) {
        let selectedChannel = event.target;
        let selectedChannelKey;
        if(selectedChannel.attributes['data-channelKey']){
            selectedChannelKey = selectedChannel.attributes['data-channelKey'].value;
        }else {
            selectedChannel = event.target.parentNode;
            selectedChannelKey = selectedChannel.attributes['data-channelKey'].value;
        }
        await changeCurrentChannel(selectedChannelKey);
    }

    async function changeCurrentChannel(channelKey) {
        if(channelKey){
            const backendClient = await getBackendClient();
            const newChannelContentStore = new ChannelContent();
            newChannelContentStore.key = channelKey;
            newChannelContentStore.channel = await backendClient.channelsService.getChannel(channelKey);
            newChannelContentStore.posts = await backendClient.channelsService.getChannelPosts(channelKey);
            for(const p of newChannelContentStore.posts) {
                if(p.content){
                    await Helpers.preloadContentPreview(p.content)
                }
                if(Array.isArray(p.attachments) && p.attachments.length > 0){
                    const attachmentsMetadata = [];
                    for(const a of p.attachments){
                        const m = await backendClient.mediaService.getMediaMetadata(a);
                        attachmentsMetadata.push(m);
                    }
                    p.attachments = attachmentsMetadata;
                }
            }
            ActivePostStore.set(undefined);
            ChannelStore.set(newChannelContentStore);
            window.setTimeout(() => {
                const channelContent = document.querySelector('#current-posts');
                if(channelContent)
                    channelContent.scrollTop = channelContent.scrollHeight;
            }, 500)
        }
    }

</script>

<style>
    .channelPanel {
        display: flex;
        height: 100%;
    }
    .channelsMenu {
        flex-grow: 1;
        min-width: 25vw;
    }

    .channels-items {
        display: flex;
        align-items: center;
    }

    .channels-item-label {
        margin-left: 15px;
        text-align: start;
    }

    .btn.action {
        display: flex;
        align-items: center;
    }

    .btn.action span.spinner-border {
        margin-right:5px;
        display: none;
    }

    .btn.action span.spinner-border.show {
        margin-right:5px;
        display: block;
    }

    .modal-footer-createChannel {

    }

    .modal-footer > button {
        margin-right: 0;
        margin-left: auto;
    }

    #errorOnCreatingChannel {
        max-width: 325px;
    }

    #show-create-channel {
        text-align: start !important;
    }

</style>

<main class="channelPanel">
    <div class="channelsMenu">
        <ul class="list-group">
            <li id="show-create-channel" on:click={showCreateChannel} class="channels-items list-group-item list-group-item-dark list-group-item-action"><i class="fas fa-2x fa-plus-circle"></i><span class="channels-item-label">Ajouter un canal</span></li>
            {#each availableChannels as availableChannel}
                <li data-channelKey="{availableChannel.key}" on:click={changeCurrentChannelOnclick} class="channels-items list-group-item list-group-item-dark list-group-item-action"><span class="channels-item-label">{availableChannel.label}</span></li>
            {/each}
        </ul>
    </div>
    <ContentChannelContainer ></ContentChannelContainer>
</main>

<div id="CreateChannelModal" class="modal fade" data-keyboard="false">
    <style>
        label {
            text-align: start;
        }
    </style>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="create-channel-modal-title" class="modal-title">Créer un nouveau canal</h5>
                <button id="ErrorClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="CreateChannelForm" class="">
                    <div class="mb-3">
                        <label for="channelLabel">Label</label>
                        <input on:change={onLabelChanged} class="form-control" id="channelLabel" name="channelLabel" type="text" required>
                        <div class="invalid-feedback">
                            Le label ne peut pas être vide.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="channelKey">Clé unique du canal</label>
                        <input on:change={onKeyChanged} class="form-control" id="channelKey" name="channelKey" type="text" required>
                        <div class="invalid-feedback">
                            La clé ne peut pas être vide ou un canal avec la même clé existe déjà.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="channelVisibility">Visibilité</label>
                        <select on:change={onVisibilityChanged} class="form-select" id="channelVisibility" name="channelVisibility" required title="Un canal privé n'est accessible et visible que par ses membres">
                            <option value="private" >Privé</option>
                            <option value="protected" >Protégé</option>
                            <option value="public">Public</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer modal-footer-createChannel">
                <div id="errorOnCreatingChannel" class="alert alert-danger fade">
                    <div id="errorOnCreatingChannelContent"></div>
                </div>
                <button on:click={createChannel} type="button" class="btn action btn-danger " ><span id="creating-channel-loading" class="spinner-border"></span>Create Channel</button>
            </div>
        </div>
    </div>
</div>

