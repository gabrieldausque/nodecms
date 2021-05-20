import axios, {AxiosInstance} from "axios";
//@ts-ignore
import https from 'https';
import {MediaService} from "./MediaService";
import {PostService} from "./PostService";
import {DocumentService} from "./DocumentService";
import {ChannelsService} from "./ChannelsService";
import {UserService} from "./UserService";
import {UtilsService} from "./UtilsService";
import {ProjectsService} from "./ProjectsService";


export class NodeCMSClient {
    private url: string;

    private axiosInstance: AxiosInstance;
    private env:string;

    public mediaService:MediaService;
    public postService: PostService;
    public documentService: DocumentService;
    public channelsService: ChannelsService;
    public userService: UserService;
    public utilsService: UtilsService;
    public projectsService: ProjectsService;

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
        this.utilsService = new UtilsService(this.axiosInstance, this.url);
        this.projectsService = new ProjectsService(this.axiosInstance, this.url);
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

let configuration = null;
const getClientConfig = async () => {
    if(!configuration)
        configuration = await axios.get(`${window.location.origin}/clientConfiguration.json`);
    return configuration;
}

let backendClient = null;

export const getBackendClient = async ():Promise<NodeCMSClient> => {
    const configuration = await getClientConfig();
    if(!backendClient){
        backendClient = new NodeCMSClient(configuration.data.backendHost, configuration.data.socketIoHost, configuration.data.env);
    }
    return backendClient;
};