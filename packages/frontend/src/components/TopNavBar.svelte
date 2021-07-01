<script lang="ts">
    import {getBackendClient} from '@nodecms/backend-client';
    import User from "./User.svelte";
    import {onMount, afterUpdate} from "svelte";
    import {writable} from "svelte/store";

    const model = writable({
        title: '',
        imgSrc: 'favicon.png'
    })
    let innerModel = $model;

    const unsubscribe = model.subscribe(m => {
        innerModel = m;
    })

    onMount(async() => {
        const backendClient = await getBackendClient();
        const title = (await backendClient.getMetadata('title')).value;
        const newLogoSrc = (await backendClient.getMetadata('logo')).value;
        model.update((m) => {
            m.title = title;
            m.imgSrc = newLogoSrc;
            return m;
        })
    })

    afterUpdate(() => {
    })

</script>

<nav class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container d-flex justify-content-between">
        <div class="navbar-brand d-flex align-items-center">
            <img src={innerModel.imgSrc} height="45px" width="45px" alt="application logo">
            <strong>{innerModel.title}</strong>
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