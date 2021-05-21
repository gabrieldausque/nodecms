<script lang="ts">

	import {Router, Route, Link} from "svelte-routing";

	import TopNavBar from './components/TopNavBar.svelte';
	import ContentGenericContainer from './components/contentComponents/ContentGenericContainer.svelte';
	import ContentTextContainer from './components/contentComponents/ContentTextContainer.svelte';
	import ContentTextContainerEditor from './components/contentComponents/Editors/ContentTextContainerEditor.svelte';
	import ContentImageContainer from './components/contentComponents/ContentImageContainer.svelte';
	import ContentChannelsContainer from './components/contentComponents/Channel/ContentChannelsContainer.svelte';
	import ContentProjectsContainer from './components/contentComponents/Projects/ContentProjectsContainer.svelte';
	import ContentDocumentsContainer from './components/contentComponents/Documents/ContentDocumentsContainer.svelte';
	import ContentDocumentEditor from './components/contentComponents/Documents/ContentDocumentEditor.svelte';
	import ContentTitle from './components/contentComponents/ContentTitle.svelte';
	import ContentAllMediaContainer from './components/contentComponents/Media/ContentAllMediaContainer.svelte';
	import ContentMediaContainer from './components/contentComponents/ContentMediaContainer.svelte';
	import ContentMediaContainerEditor from './components/contentComponents/Editors/ContentMediaContainerEditor.svelte';
	import {globalContentContainerFactory} from "./ContentContainerFactory";
	import {onMount} from "svelte";
	import {getBackendClient} from "./api/NodeCMSClient";
	import ErrorModal from "./components/ErrorModal.svelte";
	import {DocumentStore} from "./stores/DocumentStore";

	$DocumentStore;
	export let url="";

	globalContentContainerFactory.registerContentContainer('generic', ContentGenericContainer,
			'Conteneur', 'fas fa-sitemap');
	globalContentContainerFactory.registerContentContainer('text', ContentTextContainer,
			'Texte', 'fas fa-text', ContentTextContainerEditor);
	globalContentContainerFactory.registerContentContainer('image', ContentImageContainer,
			'Image','fas fa-image');
	globalContentContainerFactory.registerContentContainer('channels', ContentChannelsContainer,
			'Canaux', 'fas fa-signal-stream')
	globalContentContainerFactory.registerContentContainer('projects', ContentProjectsContainer);
	globalContentContainerFactory.registerContentContainer('title',ContentTitle,
			'Titre', 'fas fa-heading');
	globalContentContainerFactory.registerContentContainer('documents', ContentDocumentsContainer, undefined, undefined, undefined, false);
	globalContentContainerFactory.registerContentContainer('documentEditor', ContentDocumentEditor, undefined, undefined, undefined, false);
	globalContentContainerFactory.registerContentContainer('all-media', ContentAllMediaContainer);
	globalContentContainerFactory.registerContentContainer('media', ContentMediaContainer, 'Media', 'fas fa-photo-video', ContentMediaContainerEditor);


	onMount(async() => {
		const backendClient = await getBackendClient();
		const title = await backendClient.getMetadata('title');
		document.querySelector('head title').innerHTML = title;

	})

</script>

<style>
	main {
		text-align: center;
		max-width: 240px;
		margin: 0 auto;
		background: black;
		width:100%;
		height: calc(100vh - 71px);
		padding: 0;
		display: flex;
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
	<ContentGenericContainer documentKey={$DocumentStore.key}></ContentGenericContainer>
</main>
<ErrorModal></ErrorModal>

