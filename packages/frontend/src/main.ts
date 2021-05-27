//import {DocumentStore} from "./stores/DocumentStore";
//import App from './App.svelte';
//import {globalFEService} from "./FEServices";

import {getBackendClient, TempCache} from "@nodecms/backend-client";
// import {Entity} from "@nodecms/backend-data";

export const coucou = () => console.log('hello');
(window as any).coucou = coucou;
/*
const params = (new URL(window.location.href)).searchParams;
const documentKeyFromUrl = params.get('documentKey');
if(documentKeyFromUrl)
{
	DocumentStore.update(ds => {
		ds.key = documentKeyFromUrl;
		return ds;
	});
}
else
{
	DocumentStore.update((store) => {
		store.key = 'welcome';
		return store;
	})
}
console.log('before app');
const app = new App({
	target: document.body
});

(window as any).getBackendClient = getBackendClient;
globalFEService.registerService('TempCache',new TempCache());

export default app;*/