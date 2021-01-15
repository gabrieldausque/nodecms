import axios, {AxiosInstance} from "axios";
import {BaseServiceClient} from "./BaseServiceClient";
import {NodeCMSFrontEndEvents} from "./NodeCMSFrontEndEvents";
import io from "socket.io-client";
import {SocketIOTopicServiceClientProxy} from "../../includes/SocketIOTopicServiceClientProxy";

export type ChannelPostReceived = (messageContent:any) => Promise<void>

export const channelsEventNames = {
    channelsActions:'channels.actions'
}

export class ChannelsService extends BaseServiceClient {
    private topicServiceClient: SocketIOTopicServiceClientProxy;
    private readonly socketIoUrl: string;
    private readonly env:string;

    constructor(axiosInstance: AxiosInstance, url:string, socketIoHost:string = '/', env?:string) {
        super(axiosInstance, url);
        this.socketIoUrl = socketIoHost?socketIoHost:this.url;
        this.env = env;
        document.addEventListener(NodeCMSFrontEndEvents.UserAuthenticatedEventName, this.createTopicServiceClient.bind(this));
        document.addEventListener(NodeCMSFrontEndEvents.UserLogoutEventName, this.onLogOut.bind(this));
    }

    async onLogOut(){
        console.log('disconnected');
        if(this.topicServiceClient){
            this.topicServiceClient.socket.close();
            this.topicServiceClient = null;
        }
    }

    async createTopicServiceClient(){
        if(!this.topicServiceClient){
            let socket = io(this.socketIoUrl, {
                transports: ['websocket'],
                rejectUnauthorized: !(this.env === 'dev')
            });
            this.topicServiceClient = new SocketIOTopicServiceClientProxy(socket);
            this.topicServiceClient.readyHandler = () => {
                this.topicServiceClient.subscribe(channelsEventNames.channelsActions, async (t,m) => {
                    const channelAction = m.content
                    document.dispatchEvent(new Event(channelsEventNames.channelsActions));
                })
            };
            (window as any).cmsClient = this;
            console.log('connected');
        }
    }

    async getChannel(channelName) {
        const result = (await axios.request({
            method: 'get',
            baseURL: this.url,
            url: `channel/${channelName}`,
            withCredentials: true,
            headers:this.createHeaders()
        }));
        return result.data;
    }

    async getChannelPosts(channelName) {
        return (await axios.request({
            method:'get',
            baseURL:this.url,
            url: `channel/${channelName}/posts/`
        })).data;
    }

    async subscribeToChannel(channelKey:string, handler:ChannelPostReceived, addNewHandler = false)  {
        await this.createTopicServiceClient();
        const channelTopic = `channels.${channelKey}.posts`;
        const subscribe = async() => {
            await this.topicServiceClient.subscribe(channelTopic, async (t,m) => {
                try{
                    await handler(m.content);
                }catch(error) {
                    console.error(error);
                }
            })
        }
        if(typeof handler === 'function'){
            if((this.topicServiceClient.subscriptions?.indexOf(channelTopic) >= 0 && addNewHandler) ||
                this.topicServiceClient.subscriptions?.indexOf(channelTopic) < 0
            ){
                await subscribe();
            }
        }
    }

    async getAvailableChannels() {
        const result = (await axios.request({
            method: 'get',
            baseURL: this.url,
            url: `channel`,
            withCredentials: true,
            headers:this.createHeaders()
        }));
        return result.data;
    }

    async exists(channelKeyOrId){
        try{
            const result = (await axios.request({
                method: 'get',
                baseURL: this.url,
                url: `channel/${channelKeyOrId}`,
                withCredentials: true,
                headers:this.createHeaders()
            }));
            return result.status === 200;
        }catch(error){

        }
        return false;
    }

    async createChannel(channel) {
        try {
            const result = (await axios.request({
                method: 'post',
                baseURL: this.url,
                url: `channel`,
                data: channel,
                withCredentials: true,
                headers:this.createHeaders()
            }));
            return result.data;
        }catch(error){
            console.error(error);
            if(error.response){
                throw new Error(error.response.message);
            } else {
                throw error;
            }
        }
    }

}