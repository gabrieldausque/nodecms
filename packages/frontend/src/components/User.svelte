<script>
    import {getBackendClient} from '../NodeCMSClient';
    import { onMount } from 'svelte';
    export let isLogin = false;
    let backendService = null;
    let login;
    let password;

    window.addEventListener('backend-ready', () => {
        backendService = getBackendClient();
    });

    let showOrHideAuthenticate = () => {
        //toggle the login modal to show
        window.jQuery('#errorOnLoginContent').html('')
        window.jQuery('#errorOnLogin').removeClass('show');
        window.jQuery('#LoginModal').modal('toggle');
    }

    let authenticate = async () => {
        const alertBox = window.jQuery('#errorOnLogin')
        alertBox.removeClass('show');
        try{
            await backendService.authenticate(login, password);
            isLogin = true;
        }catch (e) {
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
        if(isLogin)
          window.jQuery('#LoginModal').modal('hide');
    }

    let onKeyPress = async (event) => {
        if(event.code === 'Enter') {
            await authenticate();
        }

    }

    let logout = async () => {
        isLogin = false;
        await backendService.logOut();
    }

    onMount(async () => {
        window.jQuery('#LoginModal').on('hidden.bs.modal', (e) => {
            login = '';
            password = '';
        })
    })

</script>

{#if !isLogin}
    <div>
        <button type="button" on:click={showOrHideAuthenticate}>
            Connexion
        </button>
    </div>
{:else}
    <div>
        <button type="button" on:click={logout}>
            Déconnexion
        </button>
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
