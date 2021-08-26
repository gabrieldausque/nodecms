import {BaseServiceClient} from "./BaseServiceClient";
import {NodeCMSFrontEndEvents} from "./NodeCMSFrontEndEvents";
import {v4 as uuid} from 'uuid';
import {Authentication, User} from "@nodecms/backend-data/dist";
import {UserEvent} from "@nodecms/backend-data";
import {UserEventService} from "./UserEventService";
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
    private env?: string;

    constructor(url:string, socketIoHost:string = '/', env?:string) {
        super(url, 'user');
        this.isAuthenticated = false;
        this.authenticationService = new AuthenticationService(this.url);
        this.userEventService = new UserEventService(this.url);
        this.socketIoUrl = socketIoHost?socketIoHost:this.url;
        document.addEventListener(NodeCMSFrontEndEvents.UserAuthenticatedEventName, async () => {
            this.topicServiceClient = await this.getOrCreateTopicServiceClient(this.socketIoUrl, env);
        });
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
        await this.subscribeToTopic(userEventsTopic, handler, addNewHandler);
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

    async removeUserEvent(userEvent: UserEvent) {
        if(typeof userEvent.id === 'number' || typeof userEvent.id === 'string')
            return await this.userEventService.delete(userEvent.id);
        throw new Error('Wrong Id for removing user event : must be of type number or string');
    }
}