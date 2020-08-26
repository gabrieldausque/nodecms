<script>
    import {getBackendClient} from '../NodeCMSClient'
    export let isLogin = false;
    let backendService = null;
    let login;
    let password;

    window.addEventListener('backend-ready', () => {
        backendService = getBackendClient();
    });

    let showOrHideAuthenticate = () => {
        //toggle the login modal to show
        window.jQuery('#LoginModal').modal('toggle');
    }

    let authenticate = async () => {
        await backendService.authenticate(login, password);
        isLogin = true;
        login = '';
        password = '';
        window.jQuery('#LoginModal').modal('hide');
    }

    let logout = async () => {
        isLogin = false;
        await backendService.logOut();
    }
</script>

{#if !isLogin}
    <div>
        <button type="button" on:click={showOrHideAuthenticate}>
            Login
        </button>
    </div>
{:else}
    <div>
        <button type="button" on:click={logout}>
            Logout
        </button>
    </div>
{/if}

<div id="LoginModal" class="modal fade">
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
                <button type="button" class="btn btn-primary" on:click={authenticate}>Login</button>
            </div>
        </div>
    </div>
</div>
