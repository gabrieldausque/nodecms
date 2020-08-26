<script lang="ts">
    import {getBackendClient} from '../NodeCMSClient';
    import User from "./User.svelte";

    let title = '';
    let imgSrc = 'favicon.png';

    //TODO replace by the setContext
    window.addEventListener('backend-ready', async () => {
        title = await getBackendClient().getMetadata('title');
        const newLogoSrc = await getBackendClient().getMetadata('logo').catch(() => {
            return null
        });
        if (newLogoSrc) {
            imgSrc = newLogoSrc;
        }
    })
</script>

<nav class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container d-flex justify-content-between">
        <a href="#" class="navbar-brand d-flex align-items-center">
            <img src="{imgSrc}" crossorigin="anonymous" height="45px" width="45px">
            <strong>{title}</strong>
        </a>
        <User></User>
    </div>
</nav>

<style>
    nav {
        min-height:50px;
    }
    .container {
        max-width:100%;
    }
</style>