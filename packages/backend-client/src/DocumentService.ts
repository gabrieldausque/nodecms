import {BaseServiceClient} from "./BaseServiceClient";
import type {AxiosInstance} from "axios";
import axios from "axios";
import {NodeCMSFrontEndEvents} from "./NodeCMSFrontEndEvents";
import io from "socket.io-client";
import {getBackendClient} from "./NodeCMSClient";
import {SocketIOTopicServiceClientProxy} from "@hermes/topicservice/dist/clients/SocketIOTopicServiceClientProxy";

export const documentsEventName = {
    documentsActions: 'documents.actions'
}

export class DocumentService extends BaseServiceClient {
    private topicServiceClient?: SocketIOTopicServiceClientProxy;
    private readonly socketIoUrl: string;
    private env?: string;

    constructor(axiosInstance: AxiosInstance, url:string, socketIoHost:string = '/', env?:string) {
        super(axiosInstance, url);
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
                this.topicServiceClient?.subscribe(documentsEventName.documentsActions, async (t,m) => {
                    const documentAction = m.content;
                    document.dispatchEvent(new CustomEvent(documentsEventName.documentsActions, {
                        detail: documentAction
                    }));
                })
            };
        }
    }

    async findDocument(filter?:{
        id?:number,
        key?:string,
        lastIndex?:number
    }) {
        try {
            const response = await axios.request({
                method:'get',
                baseURL:this.url,
                url:`document`,
                headers: this.createHeaders(),
                params: filter
            })
            const found:any[] = response.data;
            const services = await getBackendClient();
            if(services.userService.isAuthenticated){
                for(const doc of found){
                    doc.author = await services.userService.getUser(doc.ownerId);
                }
            }
            return found;
        } catch(error) {
            throw(error);
        }
    }

    async getDocument(key:string) {
        try{
            const response = await axios.request({
                method:'get',
                baseURL:this.url,
                url:`document/${key}`,
                headers: this.createHeaders()
            })
            const obtained = response.data;
            const services = await getBackendClient();
            if(services.userService.isAuthenticated){
                obtained.author =  await services.userService.getUser(obtained.ownerId);
            }
            return obtained;
        }catch(error){
            throw(error);
        }
    }

    async exists(key: string) {
        try {
            const result = (await  axios.request({
                method: 'get',
                baseURL: this.url,
                url:  `document/${key}`,
                withCredentials: true,
                headers:this.createHeaders()
            }))
            return result.status === 200;
        }catch(error) {

        }
        return false;
    }

    async createDocument(newDocument: any) {
        try {
            const result = (await axios.request({
                method:'post',
                baseURL: this.url,
                url:'document',
                data:newDocument,
                withCredentials:true,
                headers:this.createHeaders()
            }));
            return result.data;
        } catch(error) {
            throw error
        }
    }

    async updateDocument(documentUpdated:any){
        try{
            console.log(documentUpdated);
            const result = (await axios.request({
                method: 'put',
                baseURL: this.url,
                url:`document/${documentUpdated.id}`,
                data:documentUpdated,
                withCredentials:true,
                headers:this.createHeaders()
            }))
            console.log(result);
        } catch(error) {
            throw error;
        }
    }
}