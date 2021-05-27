import {BaseServiceClient} from "./BaseServiceClient";
import {ChannelPost} from "@nodecms/backend-data/dist";

export class PostService  extends BaseServiceClient<ChannelPost>{

    constructor(url:string) {
        super(url, 'posts')
    }

    async createPost(channelKey:string, postContent:any, attachments:any, parentId?:number) {
        try {
            const attachmentsKeys:string[] = [];
            attachments.map((a:any) => attachmentsKeys.push(a.key));
            let data:ChannelPost;
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
            const request = new XMLHttpRequest();
            request.open('POST', `channel/${channelKey}/posts`, true);
            const requestPromise = new Promise<ChannelPost>((resolve, reject) => {
                this.createHeaders(request);
                request.onreadystatechange = () => {
                    if(request.status === 201)
                        resolve(JSON.parse(request.responseText));
                    else
                        reject(new Error(`Error ${request.status} : ${request.responseText}`))
                }
                request.send(JSON.stringify(data));
            });
            return await requestPromise;
        }catch(error) {
            console.log(error);
        }
    }
}