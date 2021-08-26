import {BaseServiceClient} from "./BaseServiceClient";
import {WebThumbnail} from "@nodecms/backend-data/dist";

export type NullableWebThumbnail = WebThumbnail | null | undefined;

export class UtilsService extends BaseServiceClient<WebThumbnail> {

    constructor(url:string) {
        super(url, 'webthumbnail');
    }

    async getWebsiteThumbnail(URL:string):Promise<NullableWebThumbnail>{
        try {
            return await this.get(URL);
        }catch(error){
            console.error(error);
        }
        return null;
    }

}