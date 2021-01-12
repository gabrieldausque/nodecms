import axios, {AxiosInstance} from "axios";
//@ts-ignore
import https from 'https';
import io from 'socket.io-client';
import {SocketIOTopicServiceClientProxy} from "../../includes/SocketIOTopicServiceClientProxy.js";
import {MediaService} from "./MediaService";
import {PostService} from "./PostService";
import {globalFEService} from "../FEServices";
import {DocumentService} from "./DocumentService";
import {ChannelsService} from "./ChannelsService";
import {UserService} from "./UserService";



export class NodeCMSClient {
    private url: string;

    private axiosInstance: AxiosInstance;
    private env:string;

    public mediaService:MediaService;
    public postService: PostService;
    public documentService: DocumentService;
    public channelsService: ChannelsService;
    public userService: UserService;

    constructor(cmsUrl:string = "/", socketIoHost:string = "/", env?) {
        this.url = cmsUrl;
        axios.defaults.withCredentials = true;
        this.env = env;
        if(this.env === 'dev') {
            axios.defaults.httpsAgent = new https.Agent({
                rejectUnauthorized: false
            })
        }
        this.axiosInstance = axios.create();
        this.mediaService = new MediaService(this.axiosInstance, this.url);
        this.postService = new PostService(this.axiosInstance, this.url);
        this.documentService = new DocumentService(this.axiosInstance, this.url);
        this.channelsService = new ChannelsService(this.axiosInstance, this.url, socketIoHost, this.env);
        this.userService = new UserService(this.axiosInstance, this.url);
    }

    createHeaders() {
        return {
            crossDomain:true,
            withCredentials: true
        };
    }

    async getMetadata(key:string) {
        const response = await axios.request({
            method:'get',
            baseURL:this.url,
            url:`metadata/${key}`,
            headers: this.createHeaders()
        });
        //TODO : manage notauthenticate error
        //TODO : manage renewal of method on notacceptable
        return response.data.value
    }

}

const getClientConfig = async () => {
    const configuration = await axios.get(`${window.location.href}/clientConfiguration.json`);
    return configuration;
}

let backendClient = null;

export const getBackendClient = async ():Promise<NodeCMSClient> => {
    const configuration = await getClientConfig();
    if(!backendClient){
        console.log(backendClient);
        backendClient = new NodeCMSClient(configuration.data.backendHost, configuration.data.socketIoHost, configuration.data.env);
    }
    return backendClient;
};