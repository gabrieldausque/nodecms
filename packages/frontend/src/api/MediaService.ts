import type {AxiosInstance} from "axios";
import axios from "axios";
import {BaseServiceClient} from "./BaseServiceClient";

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

    async createMedia(file:any, key:string, label:string, visibility:string) {
        try {
            console.log(file);
            const b = new Blob([file]);
            console.log(b);
            const f = new FormData();
            f.append('visibility',visibility);
            f.append('label',label);
            f.append('key',key);
            f.append('blob',b);
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
            console.log(error);
        }
    }

    async mediaExists(key: string) {
        try {
            const media = await this.getMedia(key);
            return typeof media !== 'undefined' && media !== null
        }catch(ex){
            console.error(ex);
        }
    }
}