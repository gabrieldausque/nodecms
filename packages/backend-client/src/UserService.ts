import {BaseServiceClient} from "./BaseServiceClient";
import type {AxiosInstance} from "axios";
import axios from "axios";
import {NodeCMSFrontEndEvents} from "./NodeCMSFrontEndEvents";
import {v4 as uuid} from 'uuid';

export class UserService extends BaseServiceClient {

    public isAuthenticated:boolean;

    constructor(axiosInstance: AxiosInstance, url:string) {
        super(axiosInstance, url);
        this.isAuthenticated = false;
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
        const value = await axios.request({
            method:'get',
            baseURL:this.url,
            url:'authentication'
        })
        const authenticateEvent = new Event(NodeCMSFrontEndEvents.UserAuthenticatedEventName);
        document.dispatchEvent(authenticateEvent);
        this.isAuthenticated = value.data;
        return value.data;
    }

    async authenticate(login:string, password:string){
        await axios.request({
            method:'post',
            baseURL:this.url,
            url:'authentication',
            data: {
                login,
                password,
                clientUniqueId: this.getClientUniqueId()
            }
        })
        this.isAuthenticated = true;
        const authenticateEvent = new Event(NodeCMSFrontEndEvents.UserAuthenticatedEventName);
        document.dispatchEvent(authenticateEvent);
    }

    async logOut() {
        try{
            const response = await axios.request({
                method:'delete',
                baseURL:this.url,
                url:'authentication',
                headers:this.createHeaders()
            });
            console.log(response);
            const logoutEvent = new Event(NodeCMSFrontEndEvents.UserLogoutEventName);
            document.dispatchEvent(logoutEvent);
        }catch(error){
            console.error(error);
        }
        this.isAuthenticated = false;
    }

    async getUser(ownerId: number) {
        try{
            const user = await axios.request({
                method:'get',
                baseURL:this.url,
                url:`user/${ownerId}`
            });
            return user.data;
        }catch(error) {
            throw(error);
        }
    }
}