<script lang="ts">
    import {getBackendClient} from '@nodecms/backend-client';
    import User from "./User.svelte";
    import {onMount} from "svelte";

    let title = '';
    let imgSrc = 'favicon.png';

    onMount(async() => {
        const backendClient = await getBackendClient();
        title = await backendClient.getMetadata('title');
        const newLogoSrc = await backendClient.getMetadata('logo').catch(() => {
            return null
        });
        if (newLogoSrc) {
            imgSrc = newLogoSrc;
        }
    })

</script>

<nav class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container d-flex justify-content-between">
        <div class="navbar-brand d-flex align-items-center">
            <img src="{imgSrc}" height="45px" width="45px" alt="application logo">
            <strong>{title}</strong>
        </div>
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