import {Entity} from "@nodecms/backend-data/dist";
import {SocketIOTopicServiceClientProxy} from "./includes/SocketIOTopicServiceClientProxy";
import io from "socket.io-client";
import {documentsEventName} from "./DocumentService";
import {MessageReceivedHandler} from "./Helpers";

export abstract class BaseServiceClient<T extends Entity> {

    public static topicServiceClient?:SocketIOTopicServiceClientProxy;

    protected constructor(url: string, service:string) {
        this.url = url;
        this.service = service;
    }

    protected url: string;
    protected service: string;
    public topicServiceClient?: SocketIOTopicServiceClientProxy;

    async getOrCreateTopicServiceClient(socketIoUrl:string, env?:string){
        if(!BaseServiceClient.topicServiceClient){
            let socket = io(socketIoUrl, {
                transports: ['websocket'],
                rejectUnauthorized: !(env === 'dev')
            });
            BaseServiceClient.topicServiceClient = new SocketIOTopicServiceClientProxy(socket);
            BaseServiceClient.topicServiceClient.readyHandler = () => {
                if(BaseServiceClient.topicServiceClient)
                    BaseServiceClient.topicServiceClient.isReady = true;
            };
        }
        return BaseServiceClient.topicServiceClient;
    }

    async subscribeToTopic(topic:string, handler:MessageReceivedHandler, addNewHandler = false){
        const subscribe = async() => {
            await BaseServiceClient.topicServiceClient?.subscribe(topic, async (t:any,m:any) => {
                try{
                    await handler(m.content);
                }catch(error) {
                    console.error(error);
                }
            })
        }
        if(typeof handler === 'function'){
            if(BaseServiceClient.topicServiceClient && BaseServiceClient.topicServiceClient.isReady) {
                if((BaseServiceClient.topicServiceClient.subscriptions?.indexOf(topic) >= 0 && addNewHandler) ||
                    BaseServiceClient.topicServiceClient.subscriptions?.indexOf(topic) < 0
                ){
                    await subscribe();
                }
            } else {
                window.setTimeout(async () => {
                    console.log(`retrying subscribe to ${topic} ...`);
                    await this.subscribeToTopic(topic, handler, addNewHandler);
                }, 2000)
            }
        }
    }

    createHeaders(request:XMLHttpRequest) {
        request.withCredentials = true;
        request.setRequestHeader('Content-Type', 'application/json');
        request.setRequestHeader("Cache-Control", "no-cache, no-store, max-age=0");
    }

    async create(entity:T):Promise<T> {
        const request = new XMLHttpRequest();
        request.open('POST', `${this.url}/${this.service}`, true);
        const requestPromise = new Promise<T>((resolve, reject) => {
            this.createHeaders(request);
            request.onreadystatechange = () => {
                if(request.readyState === 4){
                    if(request.status === 201 || request.status === 200)
                        resolve(JSON.parse(request.responseText));
                    else
                        reject(new Error(`Error ${request.status} : ${request.responseText}`))
                }
            }
            request.send(JSON.stringify(entity));
        });
        return await requestPromise;
    }

    async update(entity:T):Promise<T> {
        const request = new XMLHttpRequest();
        request.open('PUT', `${this.url}/${this.service}/${entity.id}`, true);
        const requestPromise = new Promise<T>((resolve, reject) => {
            this.createHeaders(request);
            request.onreadystatechange = () => {
                if(request.readyState === 4){
                    if(request.status === 200 || request.status === 201)
                        resolve(JSON.parse(request.responseText));
                    else
                        reject(new Error(`Error ${request.status} : ${request.responseText}`))
                }
            }
            request.send(JSON.stringify(entity));
        });
        return await requestPromise;
    }

    async get(entityKeyOrId:string|number):Promise<T>{
        const request = new XMLHttpRequest();

        const params:undefined|URLSearchParams = typeof entityKeyOrId === 'string'?
            new URLSearchParams():
            undefined;
        if(params)
            params.append('key',entityKeyOrId.toString());
        const url = params?
            `${this.url}/${this.service}?${params.toString()}`:
            `${this.url}/${this.service}/${entityKeyOrId}`;
        request.open('GET', url, true);
        const requestPromise = new Promise<T>((resolve, reject) => {
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
        return this.makeReadable(await requestPromise);
    }

    async find(entityFilter?:Partial<T>):Promise<T[]> {
        const request = new XMLHttpRequest();
        const params = entityFilter?
            new URLSearchParams():
            undefined;
        if(params && entityFilter)
            for(const propName in entityFilter){
                if(entityFilter.hasOwnProperty(propName)){
                    if(entityFilter[propName] as any instanceof Date)
                    {
                        const date = entityFilter[propName] as Date;
                        params.append(propName, date.getTime().toString());
                    } else {
                        params.append(propName, entityFilter[propName].toString());
                    }
                }
            }
        const url:string = params?
            `${this.url}/${this.service}?${params.toString()}`:
            `${this.url}/${this.service}`;
        request.open('GET', url, true);
        const requestPromise = new Promise<T[]>((resolve, reject) => {
            this.createHeaders(request);
            request.onreadystatechange = () => {
                if(request.readyState === 4){
                    if(request.status === 200)
                        resolve(JSON.parse(request.responseText));
                    else
                        reject(new Error(`Error ${request.status} : ${request.responseText}`))
                }
            }
            request.send();
        });
        const found = await requestPromise;
        for(let e of found){
            this.makeReadable(e);
        }
        return found
    }

    async delete(entityKeyOrId:string|number):Promise<T> {
        const request = new XMLHttpRequest();
        let id = typeof entityKeyOrId === 'number'?
            entityKeyOrId:
            (await this.get(entityKeyOrId)).id
        const url = `${this.url}/${this.service}/${id}`;
        request.open('DELETE', url, true);
        const requestPromise = new Promise<T>((resolve, reject) => {
            this.createHeaders(request);
            request.onreadystatechange = () => {
                if(request.readyState === 4){
                    if(request.status === 200)
                        resolve(JSON.parse(request.responseText));
                    else
                        reject(new Error(`Error ${request.status} : ${request.responseText}`))
                }
            }
            request.send();
        });
        return await requestPromise;
    }

    public makeReadable(entity: T) : T {
        return entity as T;
    }
}