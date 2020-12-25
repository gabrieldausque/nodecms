import axios, {AxiosInstance} from "axios";
//@ts-ignore
import https from 'https';
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
    private axiosInstance: AxiosInstance;
    private env:string;

    constructor(cmsUrl:string = "/", env?) {
        this.url = cmsUrl;
        axios.defaults.withCredentials = true;
        this.env = env;
        if(this.env === 'dev') {
            axios.defaults.httpsAgent = new https.Agent({
                rejectUnauthorized: false
            })
        }
        this.axiosInstance = axios.create();
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
                transports: ['websocket'],

            });
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
                transports: ['websocket'],
                rejectUnauthorized: !(this.env === 'dev')
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

    async createPost(channelKey:string, post:any, attachments:any) {
        try {
            await axios.request({
                method: 'post',
                baseURL: this.url,
                url: `channel/${channelKey}/posts`,
                data: {
                    content: post,
                    attachments: attachments
                },
                withCredentials: true,
                headers:this.createHeaders()
            });
        }catch(error) {
            console.log(error);
        }
    }

    async getMedia(key:string) {
        let response;
        try{
            response = await axios.request({
                method: 'get',
                baseURL: this.url,
                url: `media/${key}`
            })
        } catch(error) {
            console.error(error);
        }
        console.log(response);
    }

    async createMedia(file:any, key:string, label:string, visibility:string) {
        try {
            console.log(file);
            const b = new Blob([file]);
            console.log(b);
            const f = new FormData();
            f.append('visibility',visibility);
            f.append('label',label);
            f.append('key',key);
            f.append('blob',b);
            await axios.request({
                method: 'post',
                baseURL: this.url,
                url: 'media',
                data:f,
                headers: {
                    'Content-Type': 'multipart/form-data; boundary=${data._boundary}',
                }
            })
        } catch(error) {
            console.log(error);
        }
    }
}

const getClientConfig = async () => {
    const configuration = await axios.get(`${window.location.href}/clientConfiguration.json`);
    console.log(configuration);
    return configuration;
}

let backendClient = null;
getClientConfig().then((configuration:any) => {
    backendClient = new NodeCMSClient(configuration.data.backendHost, configuration.data.env);
    backendClient.getMetadata('title').then((value) => {
        document.querySelector('head title').innerHTML = value;
    });
    window.dispatchEvent(new Event('backend-ready'));
})

export const getBackendClient = () => {
    return backendClient;
};