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

    async getChannelPosts(channelName, filter?:any, lastPostId?:number) {
        const posts = (await axios.request({
            method:'get',
            baseURL:this.url,
            url: `channel/${channelName}/posts/`,
            params: {...filter, ...{ lastIndex: lastPostId}}
        })).data;
        for(const p of posts){
            if(typeof p.parentPost !== 'number'){
                p.answerCount = await this.getChildrenPostsCount(p.channelKey, p.id);
            }
        }
        return posts;
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
            console.log(error.response);
            if(error.response){
                throw new Error(error.response.message);
            } else {
                throw error;
            }
        }
    }

    async getChildrenPosts(channelKey: string, parentPostId: number, lastPostId?:number) {
        return await this.getChannelPosts(channelKey, {
            parentPost: parentPostId
        }, lastPostId);
    }

    async getChildrenPostsCount(channelKey, id):Promise<number> {
        let count = 0;
        let children:any[] = []
        let lastChildrenId:number | undefined = undefined;
        do {
            children = (await this.getChildrenPosts(channelKey, id, lastChildrenId))
            if(children.length > 0){
                lastChildrenId = children[children.length - 1].id;
                count += children.length;
            }
        }while(children.length > 0)
        return count;
    }
}