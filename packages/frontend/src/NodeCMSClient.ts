import axios from "axios";

export class NodeCMSClient {
    private url: string;
    constructor(cmsUrl:string = "http://localhost:3030") {
        this.url = cmsUrl;
    }
    async getMetadata(key:string) {
        const response = await axios.request({
            method:'get',
            baseURL:this.url,
            url:`metadata/${key}`
        });
        return response.data.value
    }
}

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
    window.dispatchEvent(new Event('backend-ready'));
})

export const getBackendClient = () => {
    return backendClient;
};