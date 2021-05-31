import {NodeCMSClientContract} from "./NodeCMSClientContract";

let configuration:any = null;
export const getClientConfig = ():any => {
    if(!configuration){
        const request = new XMLHttpRequest();
        request.open('GET',`${window.location.origin}/clientConfiguration.json`, false);
        request.send();
        if(request.status === 200)
            configuration = JSON.parse(request.responseText);
        else
            throw new Error(`Couldn\'t get config from server : ${request.responseText}`)
    }
    return configuration;
}

let backendClient:NodeCMSClientContract;
export const getBackendClient = async ():Promise<NodeCMSClientContract> => {
    if(backendClient)
        return backendClient;
    throw new Error('BackendClient not initialized, please check your initialization sequence');
};

export const setBackendClient = (newBackendClient:NodeCMSClientContract):NodeCMSClientContract => {
    backendClient = newBackendClient;
    return backendClient;
}