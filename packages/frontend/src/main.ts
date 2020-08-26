import App from './App.svelte';
import {getBackendClient} from './NodeCMSClient';

const app = new App({
	target: document.body
});

(window as any).getBackendClient = getBackendClient;

export default app;