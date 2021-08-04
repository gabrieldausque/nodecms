<script lang="ts">

	import TopNavBar from './components/TopNavBar.svelte';
	import ContentDocumentContainer from './components/ContentDocumentContainer.svelte';
	import ContentTextContainer from './components/ContentTextContainer.svelte';
	import ContentTextContainerEditor from './components/Editors/ContentTextContainerEditor.svelte';
	import ContentImageContainer from './components/ContentImageContainer.svelte';
	import ContentChannelsContainer from './components/Channel/ContentChannelsContainer.svelte';
	import ContentChannelContainer from './components/Channel/ContentChannelContainer.svelte';
	import ContentProjectsContainer from './components/Projects/ContentProjectsContainer.svelte';
	import ContentDocumentsContainer from './components/Documents/ContentDocumentsContainer.svelte';
	import ContentDocumentEditor from './components/Documents/ContentDocumentEditor.svelte';
	import ContentTitle from './components/ContentTitle.svelte';
	import ContentAllMediaContainer from './components/Media/ContentAllMediaContainer.svelte';
	import ContentMediaContainer from './components/ContentMediaContainer.svelte';
	import ContentMediaContainerEditor from './components/Editors/ContentMediaContainerEditor.svelte';
	import ContentImageContainerEditor from './components/Editors/ContentImageContainerEditor.svelte';
	import ContentTitleContainerEditor from './components/Editors/ContentTitleContainerEditor.svelte';
	import {globalContentContainerFactory} from "./ContentContainerFactory";
	import {onMount} from "svelte";
	import {getBackendClient, TempCache} from "@nodecms/backend-client";
	import ErrorModal from "./components/ErrorModal.svelte";
	import {DocumentStore} from "./stores/DocumentStore";
	import ContentUserEventsContainer from './components/UserEvents/ContentUserEventsContainer.svelte';
	import ContentMultiUserCalendarContainer from './components/UserEvents/ContentMultiUserCalendarContainer.svelte';
	import GenericDataTables from './components/GenericDataTables.svelte';
	import GlobalModal from "./components/GlobalModal.svelte";

	let doc;
	const unsubscribe = DocumentStore.subscribe(async (ds) => {
		doc = await getDocument(ds.key);
	})

	globalContentContainerFactory.registerContentContainer('document', ContentDocumentContainer);
	globalContentContainerFactory.registerContentContainer('text', ContentTextContainer,
			'Texte', 'fas fa-text', ContentTextContainerEditor);
	globalContentContainerFactory.registerContentContainer('image', ContentImageContainer,
			'Image', 'fas fa-image', ContentImageContainerEditor);
	globalContentContainerFactory.registerContentContainer('channels', ContentChannelsContainer)
	globalContentContainerFactory.registerContentContainer('channel', ContentChannelContainer,
			'Canal', 'fas fa-signal-stream')
	globalContentContainerFactory.registerContentContainer('projects', ContentProjectsContainer);
	globalContentContainerFactory.registerContentContainer('title', ContentTitle,
			'Titre', 'fas fa-heading', ContentTitleContainerEditor);
	globalContentContainerFactory.registerContentContainer('documents', ContentDocumentsContainer, undefined, undefined, undefined, false);
	globalContentContainerFactory.registerContentContainer('documentEditor', ContentDocumentEditor, undefined, undefined, undefined, false);
	globalContentContainerFactory.registerContentContainer('all-media', ContentAllMediaContainer);
	globalContentContainerFactory.registerContentContainer('media', ContentMediaContainer,
			'Media',
			'fas fa-photo-video',
			ContentMediaContainerEditor);
	globalContentContainerFactory.registerContentContainer('user-events', ContentUserEventsContainer);
	globalContentContainerFactory.registerContentContainer('multiuser-events', ContentMultiUserCalendarContainer);
	globalContentContainerFactory.registerContentContainer('generic-data', GenericDataTables);

	onMount(async () => {
		const backendClient = await getBackendClient();
		const title = await backendClient.getMetadata('title');
		document.querySelector('head title').innerHTML = title.value;

	})

	async function getDocument(documentKey) {
		const backendClient = await getBackendClient();
		let rawDocument = undefined;
		if (documentKey) {
			let doc = await backendClient.documentService.getDocument(documentKey);
			let sortFunction = (a, b) => {
				if (a.order < b.order)
					return -1
				else if (a.order === b.order)
					return 0
				else
					return 1
			};
			if (Array.isArray(doc.content.headers)) {
				doc.content.headers = doc.content.headers.sort(sortFunction)
			}
			if (Array.isArray(doc.content.bodies)) {
				doc.content.bodies = doc.content.bodies.sort(sortFunction)
			}
			if (Array.isArray(doc.content.footers)) {
				doc.content.footers = doc.content.footers.sort(sortFunction)
			}
			rawDocument = doc;
		}
		return rawDocument
	}

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

	.app-viewport {
		background: black;
	}
</style>

<header>
	<TopNavBar></TopNavBar>
</header>
<main class="app-viewport">
	<ContentDocumentContainer doc={doc}></ContentDocumentContainer>
</main>
<GlobalModal></GlobalModal>

