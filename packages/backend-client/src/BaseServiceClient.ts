import {Entity} from "@nodecms/backend-data/dist";

export abstract class BaseServiceClient<T extends Entity> {

    protected constructor(url: string, service:string) {
        this.url = url;
        this.service = service;
    }

    protected url: string;
    protected service: string;

    createHeaders(request:XMLHttpRequest) {
        request.withCredentials = true;
        request.setRequestHeader('Content-Type', 'application/json');
    }

    async create(entity:T):Promise<T> {
        const request = new XMLHttpRequest();
        request.open('POST', `${this.url}/${this.service}`, true);
        const requestPromise = new Promise<T>((resolve, reject) => {
            this.createHeaders(request);
            request.onreadystatechange = () => {
                if(request.status === 201)
                    resolve(JSON.parse(request.responseText));
                else
                    reject(new Error(`Error ${request.status} : ${request.responseText}`))
            }
            request.send(JSON.stringify(entity));
        });
        return await requestPromise;
    }

    async update(entity:T):Promise<T> {
        const request = new XMLHttpRequest();
        request.open('PUT', `${this.url}/${this.service}`, true);
        const requestPromise = new Promise<T>((resolve, reject) => {
            this.createHeaders(request);
            request.onreadystatechange = () => {
                if(request.status === 200)
                    resolve(JSON.parse(request.responseText));
                else
                    reject(new Error(`Error ${request.status} : ${request.responseText}`))
            }
            request.send(JSON.stringify(entity));
        });
        return await requestPromise;
    }

    async get(entityKeyOrId:string|number):Promise<T>{
        const request = new XMLHttpRequest();
        const url = typeof entityKeyOrId === 'number'?
            `${this.url}/${this.service}/${entityKeyOrId}`:
            `${this.url}/${this.service}`;
        request.open('GET', url, true);
        const requestPromise = new Promise<T>((resolve, reject) => {
            this.createHeaders(request);
            request.onreadystatechange = () => {
                if(request.status === 200)
                    resolve(JSON.parse(request.responseText));
                else
                    reject(new Error(`Error ${request.status} : ${request.responseText}`))
            }
            const params:undefined|URLSearchParams = typeof entityKeyOrId === 'string'?
                new URLSearchParams():
                undefined;
            if(params)
                params.append('key',entityKeyOrId.toString());
            request.send(params);
        });
        return await requestPromise;
    }

    async find(entityFilter?:Partial<T>):Promise<T[]> {
        const request = new XMLHttpRequest();
        request.open('GET', `${this.url}/${this.service}`, true);
        const requestPromise = new Promise<T[]>((resolve, reject) => {
            this.createHeaders(request);
            request.onreadystatechange = () => {
                if(request.status === 200)
                    resolve(JSON.parse(request.responseText));
                else
                    reject(new Error(`Error ${request.status} : ${request.responseText}`))
            }
            const params = entityFilter?
                new URLSearchParams():
                undefined;
            if(params && entityFilter)
                for(const propName in entityFilter){
                    if(entityFilter.hasOwnProperty(propName)){
                        params.append(propName, JSON.stringify(entityFilter[propName]));
                    }
                }
            request.send();
        });
        return await requestPromise;
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
                if(request.status === 200)
                    resolve(JSON.parse(request.responseText));
                else
                    reject(new Error(`Error ${request.status} : ${request.responseText}`))
            }
            const params = new URLSearchParams()
            request.send();
        });
        return await requestPromise;
    }



}