import axios from "axios";
import io from 'socket.io-client';
import {SocketIOTopicServiceClientProxy} from "../includes/SocketIOTopicServiceClientProxy.js";

export type ChannelPostReceived = (messageContent:any) => Promise<void>

export class NodeCMSClient {
    private url: string;
    private authorization: string;
    private clientId: string;
    private realm:string;
    private id: number;
    private topicServiceClient: SocketIOTopicServiceClientProxy;

    constructor(cmsUrl:string = "/") {
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

    async checkAuthentication() {
        const value = await axios.request({
            method:'get',
            baseURL:this.url,
            url:'authentication/0'
        })
        if(!this.topicServiceClient && value.data && value.data !== false){
            let socket = io(this.url, {
                transports: ['websocket']
            });
            socket.on('clientId', (clientId) => {
                console.log('toto');
            })
            this.topicServiceClient = new SocketIOTopicServiceClientProxy(socket);
            (window as any).cmsClient = this;
        }
        return value.data;
    }

    async authenticate(login:string, password:string){
        await axios.request({
            method:'post',
            baseURL:this.url,
            url:'authentication',
            data: {
                login,
                password
            }
        })
        console.log(this.topicServiceClient);
        if(!this.topicServiceClient){
            let socket = io(this.url, {
                transports: ['websocket']
            });
            this.topicServiceClient = new SocketIOTopicServiceClientProxy(socket);
            (window as any).cmsClient = this;
        }
    }

    async logOut() {
        await axios.request({
            method:'delete',
            baseURL:this.url,
            url:'authentication',
            headers:this.createHeaders()
        })
    }

    async getChannel(channelName) {
        const result = (await axios.request({
            method: 'get',
            baseURL: this.url,
            url: 'channel',
            withCredentials: true,
            headers:this.createHeaders()
        }));

        return result.data[0];
    }

    async getChannelPosts(channelName) {
        return (await axios.request({
            method:'get',
            baseURL:this.url,
            url: `channel/${channelName}/posts/`
        })).data;
    }

    async subscribeToChannel(channelKey:string, handler:ChannelPostReceived)  {
        if(typeof handler === 'function'){
            await this.topicServiceClient.subscribe(`channels.${channelKey}.posts`, async (t,m) => {
                try{
                    await handler(m.content);
                }catch(error) {
                    console.error(error);
                }
            })
        }
    }

    async createPost(channelKey:string, post:any) {
        try {
            await axios.request({
                method: 'post',
                baseURL: this.url,
                url: `channel/${channelKey}/posts`,
                data: {
                    content: post
                },
                withCredentials: true,
                headers:this.createHeaders()
            });
        }catch(error) {
            console.log(error);
        }
    }

}

const getClientConfig = async () => {
    return await axios.get(`${window.location.href}/clientConfiguration.json`)
}

let backendClient = null;
getClientConfig().then((configuration:any) => {
    backendClient = new NodeCMSClient(configuration.data.backendHost)
    backendClient.getMetadata('title').then((value) => {
        document.querySelector('head title').innerHTML = value;
    });
    window.dispatchEvent(new Event('backend-ready'));
})

export const getBackendClient = () => {
    return backendClient;
};