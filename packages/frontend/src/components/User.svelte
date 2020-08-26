<script>
    import {getBackendClient} from '../NodeCMSClient'
    export let isLogin = false;
    let backendService = null;
    window.addEventListener('backend-ready', () => {
        backendService = getBackendClient();
    });

    let showOrHideAuthenticate = () => {
        //toggle the login modal to show
        window.jQuery('#LoginModal').modal('toggle');
    }

    let authenticate = async () => {
        isLogin = true;
        window.jQuery('#LoginModal').modal('toggle');
    }

    let logout = async () => {
        isLogin = false;
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- TODO : add login input -->
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" on:click={authenticate}>Login</button>
            </div>
        </div>
    </div>
</div>
