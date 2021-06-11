import {BaseServiceClient} from "./BaseServiceClient";
import {Media, NotAuthorizedError} from "@nodecms/backend-data/dist";

export class MediaService extends BaseServiceClient<Media> {

    public static AuthorizedMimeTypes = [
        'image/gif',
        'image/png',
        'image/jpeg',
        'image/bmp',
        'image/webp',
        'image/svg+xml',
        'audio/mp3',
        'audio/mpeg',
        'audio/webm',
        'audio/ogg',
        'audio/aac',
        'audio/wav',
        'video/webm',
        'video/ogg',
        'video/mp4',
        'video/x-msvideo',
        'application/pdf'
    ]

    constructor(url:string) {
        super(url, 'media');
    }

    async getMedia(keyOrId:string | number) {
        try{
            if(typeof keyOrId === "number")
                return await this.get(keyOrId);
            else {
                const metadata = await this.getMediaMetadata(keyOrId);
                if(metadata && typeof metadata.id === 'number')
                    return await this.get(metadata.id);
                else
                    throw new Error( `No Media with key ${keyOrId}`);
            }
        } catch(error) {
            console.error(error);
        }
    }

    async getMediaMetadata(key:string) {
        try{
            return (await this.find({
                key: key
            }))[0]
        }catch(error) {
            console.error(error);
        }
    }

    async findMedia(filter:{
            key?:string,
            label?:string,
            mediaType?:string,
            ownerId?:string
            tags?:string[]
    }) {
        try{
            return await this.find(filter);
        }catch(error) {
            console.error(error);
        }
    }

    async createMedia(file:any, key:string, label:string, visibility:string,tags:string[]= [], readers:[] = []) {
        try {
            const b = new Blob([file]);
            const f = new FormData();
            f.append('visibility',visibility);
            f.append('label',label);
            f.append('key',key);
            f.append('blob',b);
            for(const tag of tags){
                f.append(`tags[${tags.indexOf(tag)}]`, tag)
            }
            for(const readerRoleId of readers){
                f.append(`readers[${readers.indexOf(readerRoleId)}]`,readerRoleId);
            }
            const request = new XMLHttpRequest();
            request.open('POST', `${this.url}/${this.service}`, true);
            const requestPromise = new Promise<Media>((resolve, reject) => {
                request.withCredentials = true;
                // request.setRequestHeader('Content-Type', 'multipart/form-data; boundary=${data._boundary}')
                request.onreadystatechange = () => {
                    if(request.readyState === 4) {
                        if(request.status === 201)
                            resolve(JSON.parse(request.responseText));
                        else
                            reject(new Error(`Error ${request.status} : ${request.responseText}`))
                    }
                }
                request.send(f);
            });
            return await requestPromise;
        } catch(error) {
            throw error;
        }
    }

    async create(entity:Media):Promise<Media> {
        throw new NotAuthorizedError('This method is not available for media creation. Use createMedia instead.')
    }

    async update(entity:Media):Promise<Media> {
        throw new NotAuthorizedError('This method is not available for media creation. Use updateMedia instead.')
    }

    async updateMedia(key:string, label:string, visibility:string,tags:string[]= [], readers:[] = []) {
        try {
            const f = {
                key,
                visibility,
                label,
                tags,
                readers
            }
            const request = new XMLHttpRequest();
            request.open('PATCH', `${this.url}/${this.service}/${key}`, true);
            const requestPromise = new Promise<Media>((resolve, reject) => {
                this.createHeaders(request);
                request.onreadystatechange = () => {
                    if(request.readyState === 4){
                        if(request.status === 201 || request.status === 200)
                            resolve(JSON.parse(request.responseText));
                        else
                            reject(new Error(`Error ${request.status} : ${request.responseText}`))
                    }
                }
                request.send(JSON.stringify(f));
            });
            return await requestPromise;
        } catch(error) {
            throw error;
        }
    }

    async mediaExists(key: string) {
        try {
            const media = await this.getMediaMetadata(key);
            return typeof media !== 'undefined' && media !== null
        }catch(ex){
            console.error(ex);
        }
        return false;
    }
}