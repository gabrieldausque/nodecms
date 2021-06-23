<script>
    import {getBackendClient} from '@nodecms/backend-client';
    import { onMount } from 'svelte';
    import {UserStore} from "../stores/UserStore";
    import {DocumentStore} from "../stores/DocumentStore";
    import {DocumentsStore} from "../stores/DocumentsStore";

    export let isLogin = false;
    let backendService = null;
    let login;
    let password;

    let showOrHideAuthenticate = () => {
        //toggle the login modal to show
        window.jQuery('#errorOnLoginContent').html('')
        window.jQuery('#errorOnLogin').removeClass('show');
        window.jQuery('#LoginModal').modal('toggle');
    }

    function onLoggedIn() {
        UserStore.set({
            isLogin: isLogin,
            login
        })

        const params = (new URL(document.location.href)).searchParams;
        if(!params.get('documentKey')){
            DocumentStore.update((store) => {
                store.key = 'welcomePrivate';
                return store;
            })
        }
        window.jQuery('#LoginModal')?.modal('hide');
    }

    let authenticate = async () => {
        if(login && password){
            const alertBox = window.jQuery('#errorOnLogin')
            alertBox.removeClass('show');
            try{
                await backendService.userService.authenticate(login, password);
                isLogin = true;
            }catch (e) {
                console.log(e);
                let message;
                if(e.response && e.response.data && e.response.data.message){
                    message = e.response.data.message;
                } else {
                    message = e.message;
                }
                window.jQuery('#errorOnLoginContent').html(`${message}`);
                alertBox.alert();
                alertBox.addClass('show')
            }
            if(isLogin){
                onLoggedIn();
            }
        }
    }

    let onKeyPress = async (event) => {
        if(event.code === 'Enter') {
            await authenticate();
        }

    }

    let logout = async () => {
        isLogin = false;
        await backendService.userService.logOut();
        UserStore.set({
            isLogin:false,
            login:undefined
        })
        DocumentStore.update((store) => {
            store.key = "welcome";
            return store;
        });
    }

    onMount(async () => {
        window.jQuery('#LoginModal').on('hidden.bs.modal', (e) => {
            login = '';
            password = '';
        })
        backendService = await getBackendClient();
        let loginOrFalse = await backendService.userService.checkAuthentication();
        if(loginOrFalse && typeof loginOrFalse === "string"){
            isLogin = true;
            login = loginOrFalse;
            onLoggedIn();
        }
    })

    async function displayDocument(event) {
        const documentKey = event.currentTarget.getAttribute('data-document-key');
        if(documentKey){
            if(documentKey === 'documents'){
                const services = await getBackendClient();
                $DocumentsStore.documents = [];
                $DocumentsStore.documents = await services.documentService.findDocument();
                const indexes = $DocumentsStore.documents.map(d => d.id);
                $DocumentsStore.hasNext = (await services.documentService.findDocument({
                    lastIndex: Math.min(...indexes)
                })).length > 0
            };
            DocumentStore.update((store) => {
                store.key = documentKey;
                return store;
            })
        }
    }

</script>

<style>
    .btn.dropdown-toggle {
        margin-bottom: 0;
    }

    .dropdown-item > span {
        margin-left: 5px;
    }
</style>

{#if !isLogin}
    <div>
        <button type="button" on:click={showOrHideAuthenticate}>
            Connexion
        </button>
    </div>
{:else}
    <div class="dropdown">
        <button type="button" class="btn btn-secondary dropdown-toggle"
                data-toggle="dropdown" >
            <i class="fas fa-bars"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right ">
            <button class="dropdown-item" type="button" on:click={displayDocument} data-document-key="media">
                <i class="fas fa-photo-video"></i><span>Media</span>
            </button>
            <button class="dropdown-item" type="button" on:click={displayDocument} data-document-key="documents">
                <i class="fas fa-file-alt"></i><span>Documents</span>
            </button>
            <button class="dropdown-item" type="button" on:click={displayDocument} data-document-key="channels">
                <i class="fas fa-comments"></i><span>Channels</span>
            </button>
            <div class="dropdown-divider"></div>
            <button class="dropdown-item" type="button" on:click={logout}>
                Déconnexion
            </button>
        </div>
    </div>
{/if}

<div id="LoginModal" class="modal fade" data-keyboard="false" on:keypress={onKeyPress}>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button id="LoginClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="login">Login</label>
                        <input id="login" type="text" placeholder="Type your login here" bind:value={login}>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" type="password" placeholder="Type your password here" bind:value={password}>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div id="errorOnLogin" class="alert alert-danger fade">
                    <div id="errorOnLoginContent"></div>
                </div>
                <button type="button" class="btn btn-danger" on:click={authenticate}>Login</button>
            </div>
        </div>
    </div>
</div>
