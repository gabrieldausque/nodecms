import App from './App.svelte';
import {getBackendClient} from './api/NodeCMSClient';
import {FEServices, globalFEService} from "./FEServices";
import {TempCache} from "./api/TempCache";
import {DocumentStore} from "./stores/DocumentStore";

DocumentStore.update((store) => {
	store.key = 'welcome';
	return store;
})

const app = new App({
	target: document.body
});

(window as any).getBackendClient = getBackendClient;
globalFEService.registerService('TempCache',new TempCache());

export default app;