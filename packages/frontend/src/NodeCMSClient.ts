import axios from "axios";

export class NodeCMSClient {
    private url: string;
    constructor(cmsUrl:string = "http://localhost:3030") {
        this.url = cmsUrl;
    }
    async getMetadata(key:string) {
        const response = await axios.request({
            method:'get',
            baseURL:this.url,
            url:`metadata/${key}`
        });
        return response.data.value
    }
}