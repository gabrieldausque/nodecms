//@ts-ignore
import {MediaService} from "./MediaService";
import {PostService} from "./PostService";
import {DocumentService} from "./DocumentService";
import {ChannelsService} from "./ChannelsService";
import {UserService} from "./UserService";
import {UtilsService} from "./UtilsService";
import {ProjectsService} from "./ProjectsService";
import {MetadataService} from "./MetadataService";

export class NodeCMSClient {
    private readonly url: string;
    private readonly env?:string;

    public mediaService:MediaService;
    public postService: PostService;
    public documentService: DocumentService;
    public channelsService: ChannelsService;
    public userService: UserService;
    public utilsService: UtilsService;
    public projectsService: ProjectsService;
    private metadataService: MetadataService;

    constructor(cmsUrl:string = "/", socketIoHost:string = "/", env?:string) {
        this.url = cmsUrl;
        this.env = env;
        this.mediaService = new MediaService(this.url);
        this.postService = new PostService(this.url);
        this.documentService = new DocumentService(this.url, socketIoHost, this.env);
        this.channelsService = new ChannelsService(this.url, socketIoHost, this.env);
        this.userService = new UserService(this.url);
        this.utilsService = new UtilsService(this.url);
        this.projectsService = new ProjectsService(this.url);
        this.metadataService = new MetadataService(this.url);
    }

    async getMetadata(key:string) {
        return await this.metadataService.get(key);
    }

}

//TODO : type the client configuration
let configuration:any = null;
const getClientConfig = async () => {
    if(!configuration){
        const request = new XMLHttpRequest();
        request.open('GET',`${window.location.origin}/clientConfiguration.json`);
        const p = new Promise<any>((resolve, reject) => {
            request.onreadystatechange = () => {
                if(request.status === 200)
                    resolve(JSON.parse(request.responseText))
                else
                    reject(new Error(`Couldn\'t get config from server : ${request.responseText}`))
            }
            request.send();
        })
        configuration = await p;
    }
    return configuration;
}

let backendClient:NodeCMSClient;
export const getBackendClient = async ():Promise<NodeCMSClient> => {
    const configuration = await getClientConfig();
    if(!backendClient){
        backendClient = new NodeCMSClient(configuration.data.backendHost, configuration.data.socketIoHost, configuration.data.env);
    }
    return backendClient;
};