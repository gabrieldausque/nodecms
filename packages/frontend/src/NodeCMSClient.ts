import axios from "axios";

export class NodeCMSClient {
    private url: string;
    private authorization: string;
    private clientId: string;
    private realm:string;
    private id: number;
    constructor(cmsUrl:string = "http://localhost:3030") {
        this.url = cmsUrl;
        axios.defaults.withCredentials = true;
    }

    createHeaders() {
        return {
            crossDomain:true
        };
    }

    async getDocument(key:string) {
        const response = await axios.request({
            method:'get',
            baseURL:this.url,
            url:`document/${key}`,
            headers: this.createHeaders()
        })
        //TODO : manage notauthenticate error
        //TODO : manage renewal of method on notacceptable
        return response.data.value;
    }

    async getMetadata(key:string) {
        const response = await axios.request({
            method:'get',
            baseURL:this.url,
            url:`metadata/${key}`,
            headers: this.createHeaders()
        });
        //TODO : manage notauthenticate error
        //TODO : manage renewal of method on notacceptable
        return response.data.value
    }

    async authenticate(login:string, password:string){
        await axios.request({
            method:'post',
            baseURL:this.url,
            url:'authentication',
            data: {
                login,
                password
            },
            withCredentials: true,
            headers:{
                credentials: 'same-origin'
            }
        })
    }

    async logOut() {
        await axios.request({
            method:'delete',
            baseURL:this.url,
            url:'authentication',
            withCredentials: true,
            headers:this.createHeaders()
        })
    }
}

const getClientConfig = async () => {
    return await axios.get(`${window.location.href}/clientConfiguration.json`)
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