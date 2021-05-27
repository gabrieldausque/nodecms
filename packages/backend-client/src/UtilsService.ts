import {BaseServiceClient} from "./BaseServiceClient";
import type {AxiosInstance} from "axios";

export interface WebThumbnail {
    mediaId: number,
    title: string,
    description: string,
    url: string
}

export type NullableWebThumbnail = WebThumbnail | null | undefined;

export class UtilsService extends BaseServiceClient {

    constructor(axiosInstance: AxiosInstance, url:string) {
        super(axiosInstance, url);
    }

    async getWebsiteThumbnail(URL:string):Promise<NullableWebThumbnail>{
        try {
            const mediaThumbnail:WebThumbnail = (await this.axiosInstance.request({
                method:'get',
                baseURL:this.url,
                url:'webthumbnail',
                params:{
                    id:URL
                }
            })).data[0]
            console.log(mediaThumbnail);
            return mediaThumbnail;
        }catch(error){
            console.error(error);
        }
        return null;
    }

}