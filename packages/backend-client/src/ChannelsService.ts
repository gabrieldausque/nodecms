import axios, {AxiosInstance} from "axios";
import {BaseServiceClient} from "./BaseServiceClient";
import {NodeCMSFrontEndEvents} from "./NodeCMSFrontEndEvents";
import io from "socket.io-client";
// @ts-ignore
import {SocketIOTopicServiceClientProxy} from "./includes/SocketIOTopicServiceClientProxy.js";
import type {Channel} from "@nodecms/backend-data";
import {ChannelPost} from "@nodecms/backend-data/dist";
import {UserService} from "./UserService";

export type ChannelPostReceived = (messageContent:any) => Promise<void>

export const channelsEventNames = {
    channelsActions:'channels.actions'
}

export class ChannelsService extends BaseServiceClient<Channel> {
    private topicServiceClient?: SocketIOTopicServiceClientProxy;
    private readonly socketIoUrl: string;
    private readonly env?:string;
    private userService: UserService;

    constructor(url:string, socketIoHost:string = '/', env?:string) {
        super(url, 'channel');
        this.socketIoUrl = socketIoHost?socketIoHost:this.url;
        this.env = env;
        this.userService = new UserService(url);
        document.addEventListener(NodeCMSFrontEndEvents.UserAuthenticatedEventName, this.createTopicServiceClient.bind(this));
        document.addEventListener(NodeCMSFrontEndEvents.UserLogoutEventName, this.onLogOut.bind(this));
    }

    async onLogOut(){
        console.log('disconnected');
        if(this.topicServiceClient){
            this.topicServiceClient.socket.close();
            this.topicServiceClient = undefined;
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
                if(this.topicServiceClient)
                    this.topicServiceClient.isReady = true;
                this.topicServiceClient?.subscribe(channelsEventNames.channelsActions, async (t:any,m:any) => {
                    const channelAction = m.content
                    document.dispatchEvent(
                        new CustomEvent(channelsEventNames.channelsActions, {detail: channelAction}));
                })
            };
            (window as any).cmsClient = this;
        }
    }

    async getChannel(channelName:string) {
        return await this.get(channelName);
    }

    async getChannelPosts(channelName:string, filter?:any, lastPostId?:number) {
        const request = new XMLHttpRequest();
        const params = {...filter, ...{ lastIndex: lastPostId}};
        const p:URLSearchParams = new URLSearchParams();
        let paramsCount = 0;
        if(params)
        {
            for(const filter in params){
                if(params.hasOwnProperty(filter) &&
                    typeof params[filter] !== 'undefined') {
                    p.append(filter,params[filter].toString());
                    paramsCount++;
                }
            }
        }
        const url = paramsCount > 0?
            `${this.url}/channel/${channelName}/posts?${p.toString()}`:
            `${this.url}/channel/${channelName}/posts`
        ;
        request.open('GET', url, true);
        const requestPromise = new Promise<ChannelPost[]>((resolve, reject) => {
            this.createHeaders(request);
            request.onreadystatechange = () => {
                if(request.readyState === 4) {
                    if(request.status === 200)
                        resolve(JSON.parse(request.responseText));
                    else
                        reject(new Error(`Error ${request.status} : ${request.responseText}`))
                }
            }
            request.send();
        });
        const posts = await requestPromise;
        for(const p of posts){
            if(typeof p.parentPost !== 'number' && p.channelKey && typeof p.id === 'number'){
                p.answerCount = await this.getChildrenPostsCount(p.channelKey, p.id);
            }
        }
        return posts;
    }

    async subscribeToChannel(channelKey:string, handler:ChannelPostReceived, addNewHandler = false)  {
        const channelTopic = `channels.${channelKey}.posts`;
        const subscribe = async() => {
            console.log('plop 1')
            console.log(this.topicServiceClient);
            console.log('end plop 1');
            await this.topicServiceClient?.subscribe(channelTopic, async (t:any,m:any) => {
                console.log('handling message');
                try{
                    await handler(m.content);
                }catch(error) {
                    console.error(error);
                }
            })
        }
        if(typeof handler === 'function'){
            if(this.topicServiceClient && this.topicServiceClient.isReady) {
                if((this.topicServiceClient.subscriptions?.indexOf(channelTopic) >= 0 && addNewHandler) ||
                    this.topicServiceClient.subscriptions?.indexOf(channelTopic) < 0
                ){
                    await subscribe();
                }
            } else {
                window.setTimeout(async () => {
                    console.log('retrying subscribe ...');
                    await this.subscribeToChannel(channelKey, handler, addNewHandler);
                }, 2000)
            }
        }
    }

    async getAvailableChannels() {
        return await this.find();
    }

    async exists(channelKeyOrId:string){
        try{
            return typeof (await this.get(channelKeyOrId)).id === 'number';
        }catch(error){

        }
        return false;
    }

    async createChannel(channel:Channel) {
        try {
            return this.create(channel);
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

    async getChildrenPostsCount(channelKey:string, id:number):Promise<number> {
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