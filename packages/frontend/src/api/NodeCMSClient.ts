import axios, {AxiosInstance} from "axios";
//@ts-ignore
import https from 'https';
import io from 'socket.io-client';
import {SocketIOTopicServiceClientProxy} from "../../includes/SocketIOTopicServiceClientProxy.js";
import {MediaService} from "./MediaService";
import {PostService} from "./PostService";

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
    private socketIoUrl: string;

    public mediaService:MediaService;
    public postService: PostService;

    constructor(cmsUrl:string = "/", socketIoHost:string = "/", env?) {
        this.url = cmsUrl;
        this.socketIoUrl = socketIoHost?socketIoHost:this.url;
        axios.defaults.withCredentials = true;
        this.env = env;
        if(this.env === 'dev') {
            axios.defaults.httpsAgent = new https.Agent({
                rejectUnauthorized: false
            })
        }
        this.axiosInstance = axios.create();
        this.mediaService = new MediaService(this.axiosInstance, this.url);
        this.postService = new PostService(this.axiosInstance, this.url);
    }

    createHeaders() {
        return {
            crossDomain:true,
            withCredentials: true
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
            let socket = io(this.socketIoUrl, {
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
            let socket = io(this.socketIoUrl, {
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

}

const getClientConfig = async () => {
    const configuration = await axios.get(`${window.location.href}/clientConfiguration.json`);
    console.log(configuration);
    return configuration;
}

let backendClient = null;
getClientConfig().then((configuration:any) => {
    backendClient = new NodeCMSClient(configuration.data.backendHost, configuration.data.socketIoHost, configuration.data.env);
    backendClient.getMetadata('title').then((value) => {
        document.querySelector('head title').innerHTML = value;
    });
    window.dispatchEvent(new Event('backend-ready'));
})

export const getBackendClient = ():NodeCMSClient => {
    return backendClient;
};