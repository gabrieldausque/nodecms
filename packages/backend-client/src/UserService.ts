import {BaseServiceClient} from "./BaseServiceClient";
import {NodeCMSFrontEndEvents} from "./NodeCMSFrontEndEvents";
import {v4 as uuid} from 'uuid';
import {Authentication, User} from "@nodecms/backend-data/dist";
import {UserEvent} from "@nodecms/backend-data";
import {UserEventService} from "./UserEventService";
import io from "socket.io-client";
import {SocketIOTopicServiceClientProxy} from "./includes/SocketIOTopicServiceClientProxy";
import {ChannelPostReceived} from "./ChannelsService";
import {MessageReceivedHandler} from "./Helpers";

export class AuthenticationService extends BaseServiceClient<Authentication> {
    constructor(url: string) {
        super(url, 'authentication');
    }
}

export const userEventsEventName = {
    userEventActions: 'user-events.actions'
}

export class UserService extends BaseServiceClient<User> {

    public isAuthenticated:boolean;
    private authenticationService: AuthenticationService;
    private userEventService: UserEventService;
    private readonly socketIoUrl: string;
    private topicServiceClient?: SocketIOTopicServiceClientProxy;
    private env?: string;

    constructor(url:string, socketIoHost:string = '/', env?:string) {
        super(url, 'user');
        this.isAuthenticated = false;
        this.authenticationService = new AuthenticationService(this.url);
        this.userEventService = new UserEventService(this.url);
        this.socketIoUrl = socketIoHost?socketIoHost:this.url;
        document.addEventListener(NodeCMSFrontEndEvents.UserAuthenticatedEventName, this.createTopicServiceClient.bind(this));
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
            };
        }
    }


    getClientUniqueId() {
        let clientId = localStorage.getItem('clientUniqueId');
        if(!clientId){
            console.log(`adding client unique Id`);
            clientId = uuid();
            localStorage.setItem('clientUniqueId',clientId)
        }
        console.log(`client unique Id is ${clientId}`)
        return clientId
    }

    async checkAuthentication() {
        const value = await this.authenticationService.find();
        const authenticateEvent = new Event(NodeCMSFrontEndEvents.UserAuthenticatedEventName);
        document.dispatchEvent(authenticateEvent);
        console.log(`authentication : ${value}`)
        this.isAuthenticated = true;
        return value;
    }

    async authenticate(login:string, password:string){
        await this.authenticationService.create({
            login,
            password,
            clientUniqueId: this.getClientUniqueId()
        })
        this.isAuthenticated = true;
        const authenticateEvent = new Event(NodeCMSFrontEndEvents.UserAuthenticatedEventName);
        document.dispatchEvent(authenticateEvent);
    }

    async logOut() {
        try{
            const response = await this.authenticationService.delete(0);
            const logoutEvent = new Event(NodeCMSFrontEndEvents.UserLogoutEventName);
        }catch(error){
            console.error(error);
        }
        this.isAuthenticated = false;
    }

    async getUser(ownerId: number) {
        return await this.get(ownerId);
    }

    async createUserEvent(userEvent: UserEvent) {
        return await this.userEventService.create(userEvent);
    }

    async findUserEvents(login:string, startDate:Date, endDate:Date) {
        const user = await this.get(login);
        return await this.userEventService.findUserEvents(user.id as number, startDate, endDate);
    }

    async subscribeToUserEvents(userLogin:string,
                                handler:MessageReceivedHandler,
                                addNewHandler = false)
    {
        const userEventsTopic = `${userEventsEventName.userEventActions}.${userLogin}`;
        const subscribe = async() => {
            console.log(`subscribing to ${userEventsTopic}`)
            await this.topicServiceClient?.subscribe(userEventsTopic, async (t:any,m:any) => {
                console.log(`receiving message from ${t}`);
                try{
                    await handler(m.content);
                }catch(error) {
                    console.error(error);
                }
            })
        }
        if(typeof handler === 'function'){
            if(this.topicServiceClient && this.topicServiceClient.isReady) {
                if((this.topicServiceClient.subscriptions?.indexOf(userEventsTopic) >= 0 && addNewHandler) ||
                    this.topicServiceClient.subscriptions?.indexOf(userEventsTopic) < 0
                ){
                    await subscribe();
                }
            } else {
                window.setTimeout(async () => {
                    console.log('retrying subscribe ...');
                    await this.subscribeToUserEvents(userLogin, handler, addNewHandler);
                }, 2000)
            }
        }
    }


    async updateUserEvent(userEvent: UserEvent) {
        return await this.userEventService.updateUserEvent(userEvent);
    }

    async getCurrentUser(){
        const request = new XMLHttpRequest();
        const params:URLSearchParams = new URLSearchParams();
        params.append('currentUser','true');
        const url = `${this.url}/${this.service}/0?${params.toString()}`;
        request.open('GET', url, true);
        const requestPromise = new Promise<User>((resolve, reject) => {
            this.createHeaders(request);
            request.onreadystatechange = () => {
                if(request.readyState === 4) {
                    if(request.status === 200 ){
                        const found = JSON.parse(request.responseText);
                        if(Array.isArray(found) && found.length > 0){
                            resolve(found[0]);
                        } else
                            resolve(found);
                    }
                    else
                        reject(new Error(`Error ${request.status} : ${request.responseText}`))
                }
            }
            request.send();
        });
        return await requestPromise;
    }
}