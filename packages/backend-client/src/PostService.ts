import axios, {AxiosInstance} from "axios";
import {BaseServiceClient} from "./BaseServiceClient";

export class PostService  extends BaseServiceClient{

    constructor(axiosInstance: AxiosInstance, url:string) {
        super(axiosInstance, url)
    }

    async createPost(channelKey:string, postContent:any, attachments:any, parentId?:number) {
        try {
            const attachmentsKeys:string[] = [];
            attachments.map((a:any) => attachmentsKeys.push(a.key));
            let data = undefined;
            if(typeof parentId !== 'number')
                data = {
                    content: postContent,
                    attachments: attachmentsKeys
                }
            else
                data = {
                    parentPost: parentId,
                    content: postContent,
                    attachments: attachmentsKeys
                }
            await axios.request({
                method: 'post',
                baseURL: this.url,
                url: `channel/${channelKey}/posts`,
                data: data,
                withCredentials: true,
                headers:this.createHeaders()
            });
        }catch(error) {
            console.log(error);
        }
    }
}