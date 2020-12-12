<script lang="ts">
	import TopNavBar from './components/TopNavBar.svelte';
	import ContentGenericContainer from './components/contentComponents/ContentGenericContainer.svelte';
	import ContentTextContainer from './components/contentComponents/ContentTextContainer.svelte';
	import ContentImageContainer from './components/contentComponents/ContentImageContainer.svelte';
	import {globalContentContainerFactory} from "./ContentContainerFactory";

	globalContentContainerFactory.registerContentContainer('generic', ContentGenericContainer);
	globalContentContainerFactory.registerContentContainer('text', ContentTextContainer);
	globalContentContainerFactory.registerContentContainer('image', ContentImageContainer);

</script>

<style>
	main {
		text-align: center;
		padding: 1em;
		max-width: 240px;
		margin: 0 auto;
		background: black;
		width:100%;
		height: calc(100vh - 79px);
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
	<ContentGenericContainer documentKey="welcome"></ContentGenericContainer>
</main>
