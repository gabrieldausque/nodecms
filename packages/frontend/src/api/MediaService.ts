import type {AxiosInstance} from "axios";
import axios from "axios";
import {BaseServiceClient} from "./BaseServiceClient";
import {globalFEService} from "../FEServices";

export class MediaService extends BaseServiceClient {

    constructor(axiosInstance: AxiosInstance, url:string) {
        super(axiosInstance, url)
    }

    async getMedia(key:string) {
        let response;
        try{
            response = await axios.request({
                method: 'get',
                baseURL: this.url,
                url: `media/${key}`
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

    async createMedia(file:any, key:string, label:string, visibility:string, readers:[]) {
        try {
            const b = new Blob([file]);
            const f = new FormData();
            f.append('visibility',visibility);
            f.append('label',label);
            f.append('key',key);
            f.append('blob',b);
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