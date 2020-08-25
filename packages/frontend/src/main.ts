import App from './App.svelte';
import {NodeCMSClient} from './NodeCMSClient';

const getClientConfig = async () => {
	const xmlRequest = new XMLHttpRequest()
	xmlRequest.open('GET', `${window.location.href}/clientConfiguration.json`);
	return new Promise((resolve, reject) => {
		xmlRequest.onreadystatechange = () => {
			resolve(xmlRequest.responseText);
		}
		 xmlRequest.send();
	});
}
let backendClient = null;
getClientConfig().then((configuration:any) => {
	backendClient = new NodeCMSClient(configuration.backendHost)
	backendClient.getMetadata('title').then((value) => {
		document.querySelector('head title').innerHTML = value;
	});
})

const app = new App({
	target: document.body,
	props: {
		name: 'world'
	}
});



export default app;