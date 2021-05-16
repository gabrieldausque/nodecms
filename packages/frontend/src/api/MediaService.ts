import type {AxiosInstance} from "axios";
import axios from "axios";
import {BaseServiceClient} from "./BaseServiceClient";
import {globalFEService} from "../FEServices";

export class MediaService extends BaseServiceClient {

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


    constructor(axiosInstance: AxiosInstance, url:string) {
        super(axiosInstance, url)
    }

    async getMedia(keyOrId:string | number) {
        let response;
        try{
            response = await axios.request({
                method: 'get',
                baseURL: this.url,
                url: `media/${keyOrId}`
            })
            return response.data;
        } catch(error) {
            console.error(error);
        }
    }

    async getMediaMetadata(keyOrId:string) {
        let response;
        try{
            response = await axios.request({
                method:'get',
                baseURL: this.url,
                url: 'media',
                params: {
                    key:keyOrId
                }
            })
            return response.data[0];
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
            await axios.request({
                method: 'post',
                baseURL: this.url,
                url: 'media',
                data:f,
                headers: {
                    'Content-Type': 'multipart/form-data; boundary=${data._boundary}',
                }
            })
        } catch(error) {
            globalFEService.getService('displayError').displayError('Erreur lors de la création d\'un media', error.response.data.message);
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
    }
}