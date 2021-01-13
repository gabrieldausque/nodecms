import axios, {AxiosInstance} from "axios";
import {BaseServiceClient} from "./BaseServiceClient";

export class PostService  extends BaseServiceClient{

    constructor(axiosInstance: AxiosInstance, url:string) {
        super(axiosInstance, url)
    }

    async createPost(channelKey:string, post:any, attachments:any) {
        try {
            const attachmentsKeys = [];
            attachments.map((a) => attachmentsKeys.push(a.key));
            await axios.request({
                method: 'post',
                baseURL: this.url,
                url: `channel/${channelKey}/posts`,
                data: {
                    content: post,
                    attachments: attachmentsKeys
                },
                withCredentials: true,
                headers:this.createHeaders()
            });
        }catch(error) {
            console.log(error);
        }
    }
}