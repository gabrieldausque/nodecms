import {DocumentStore} from "./stores/DocumentStore";
import App from './App.svelte';
import {globalFEService} from "./FEServices";
import {getBackendClient, TempCache} from '@nodecms/backend-client';

(window as any).getBackendClient = getBackendClient;
globalFEService.registerService('TempCache',new TempCache());

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

const app = new App({
	target: document.body
});

export default app;