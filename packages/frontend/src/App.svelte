<script lang="ts">
	import TopNavBar from './components/TopNavBar.svelte';
	import ContentGenericContainer from './components/contentComponents/ContentGenericContainer.svelte';
	import ContentTextContainer from './components/contentComponents/ContentTextContainer.svelte';
	import ContentImageContainer from './components/contentComponents/ContentImageContainer.svelte';
	import ContentChannelsContainer from './components/contentComponents/ContentChannelsContainer.svelte';
	import {globalContentContainerFactory} from "./ContentContainerFactory";
	import {afterUpdate, createEventDispatcher, onMount} from "svelte";
	import {UserStore} from "./stores/UserStore";
	import {getBackendClient} from "./api/NodeCMSClient";
	import ErrorModal from "./components/ErrorModal.svelte";

	export let documentKey;

	globalContentContainerFactory.registerContentContainer('generic', ContentGenericContainer);
	globalContentContainerFactory.registerContentContainer('text', ContentTextContainer);
	globalContentContainerFactory.registerContentContainer('image', ContentImageContainer);
	globalContentContainerFactory.registerContentContainer('channel', ContentChannelsContainer)

	const unsubscribe = UserStore.subscribe(async (value) => {
		window.setTimeout(async() => {
			if (value && value.isLogin)
				documentKey = "welcomePrivate";
			else
				documentKey = "welcome"
		})
	})

	onMount(async() => {
		const backendClient = await getBackendClient();
		const title = await backendClient.getMetadata('title');
		document.querySelector('head title').innerHTML = title;
	})

</script>

<style>
	main {
		text-align: center;
		padding: 1em;
		max-width: 240px;
		margin: 0 auto;
		background: black;
		width:100%;
		height: calc(100vh - 71px);
		padding: 0;
	}

	h1 {
		color: #ff0033;
		text-transform: uppercase;
		font-size: 4em;
		font-weight: 100;
	}

	@media (min-width: 640px) {
		main {
			max-width: none;
		}
	}
</style>

<header>
	<TopNavBar></TopNavBar>
</header>
<main>
	<ContentGenericContainer documentKey={documentKey}></ContentGenericContainer>
</main>
<ErrorModal></ErrorModal>
