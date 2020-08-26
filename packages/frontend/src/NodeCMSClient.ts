import axios from "axios";

export class NodeCMSClient {
    private url: string;
    private authorization: string;
    private clientId: string;
    private realm:string;
    private id: number;
    constructor(cmsUrl:string = "http://localhost:3030") {
        this.url = cmsUrl;
    }

    createHeaders() {
        if(this.authorization && this.clientId && this.realm) {
            return {
                authorization: this.authorization,
                'ncms-uniqueid': this.clientId,
                'www-authenticate': this.realm
            }
        }
        return null;
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
        const response = await axios.request({
            method:'post',
            baseURL:this.url,
            url:'authentication',
            data: {
                login,
                password
            }
        })
        console.log(response);
        if(response.status === 200) {
            this.authorization = response.headers['authorization'];
            this.clientId = response.headers['ncms-uniqueid'];
            this.realm = response.headers['www-authenticate'];
        }
    }

    async logOut() {
        this.clientId = '';
        this.authorization = '';
        this.realm = '';
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