import {BaseServiceClient} from "./BaseServiceClient";
import {NodeCMSFrontEndEvents} from "./NodeCMSFrontEndEvents";
import {v4 as uuid} from 'uuid';
import {Authentication, User} from "@nodecms/backend-data/dist";

export class AuthenticationService extends BaseServiceClient<Authentication> {
    constructor(url: string) {
        super(url, 'authentication');
    }
}

export class UserService extends BaseServiceClient<User> {

    public isAuthenticated:boolean;
    private authenticationService: AuthenticationService;

    constructor(url:string) {
        super(url, 'user');
        this.isAuthenticated = false;
        this.authenticationService = new AuthenticationService(this.url);
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
        try{
            return await this.get(ownerId);
        }catch(error) {
            throw(error);
        }
    }
}