import {NodeCMSClient} from "./NodeCMSClient";

let configuration:any = null;
const getClientConfig = async () => {
    if(!configuration){
        const request = new XMLHttpRequest();
        request.open('GET',`${window.location.origin}/clientConfiguration.json`);
        const p = new Promise<any>((resolve, reject) => {
            request.onreadystatechange = () => {
                if(request.readyState === 4){
                    if(request.status === 200)
                        resolve(JSON.parse(request.responseText))
                    else
                        reject(new Error(`Couldn\'t get config from server : ${request.responseText}`))
                }
            }
            request.send();
        })
        configuration = await p;
    }
    return configuration;
}

let backendClient:NodeCMSClient;
export const getBackendClient = async ():Promise<NodeCMSClient> => {
    const configuration = await getClientConfig();
    if(!backendClient){
        backendClient = new NodeCMSClient(configuration.backendHost, configuration.socketIoHost, configuration.env);
    }
    return backendClient;
};