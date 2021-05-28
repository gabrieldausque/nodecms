import {BaseServiceClient} from "./BaseServiceClient";
import {NodeCMSFrontEndEvents} from "./NodeCMSFrontEndEvents";
import io from "socket.io-client";
import {SocketIOTopicServiceClientProxy} from "./includes/SocketIOTopicServiceClientProxy";
import {Document as DocumentEntity} from '@nodecms/backend-data';
import {getBackendClient} from "./services-factory";

export const documentsEventName = {
    documentsActions: 'documents.actions'
}

export class DocumentService extends BaseServiceClient<DocumentEntity> {
    private topicServiceClient?: SocketIOTopicServiceClientProxy;
    private readonly socketIoUrl: string;
    private env?: string;

    constructor(url:string, socketIoHost:string = '/', env?:string) {
        super(url, 'document');
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
                this.topicServiceClient?.subscribe(documentsEventName.documentsActions, async (t:any,m:any) => {
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
            const documents = await this.find(filter);
            const services = await getBackendClient();
            for(const doc of documents){
                const author = await services.userService.get(doc.ownerId);
                doc.author = author;
            }
            return documents;
        } catch(error) {
            throw(error);
        }
    }

    async getDocument(key:string) {
        try{
            console.log(`Getting document with key ${key}`);
            const obtained = await this.get(key);
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
            return typeof (await this.get(key)).id === 'number'
        }catch(error) {

        }
        return false;
    }

    async createDocument(newDocument: DocumentEntity) {
        try {
            return await this.create(newDocument)
        } catch(error) {
            throw error
        }
    }

    async updateDocument(documentUpdated:DocumentEntity){
        try{
            return await this.update(documentUpdated);
        } catch(error) {
            throw error;
        }
    }
}