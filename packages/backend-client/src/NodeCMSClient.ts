//@ts-ignore
import {MediaService} from "./MediaService";
import {PostService} from "./PostService";
import {DocumentService} from "./DocumentService";
import {ChannelsService} from "./ChannelsService";
import {UserService} from "./UserService";
import {UtilsService} from "./UtilsService";
import {ProjectsService} from "./ProjectsService";
import {MetadataService} from "./MetadataService";
import {NodeCMSClientContract} from "./NodeCMSClientContract";
import {UserEventService} from "./UserEventService";
import {BaseServiceClient} from "./BaseServiceClient";
import {Channel, ChannelPost, Document, Media, User, WebThumbnail, Metadata, UserEvent} from "@nodecms/backend-data";

export class NodeCMSClient implements NodeCMSClientContract {
    private readonly url: string;
    private readonly env?:string;

    private readonly services: { [serviceLabel:string] : BaseServiceClient<any> }

    mediaService: MediaService;
    postService: PostService;
    documentService: DocumentService;
    channelsService: ChannelsService;
    userService: UserService;
    utilsService: UtilsService;
    metadataService: MetadataService;
    userEventService: UserEventService;

    constructor(cmsUrl:string = "/", socketIoHost:string = "/", env?:string) {
        this.url = cmsUrl;
        this.env = env;
        this.services = {}
        this.mediaService = new MediaService(this.url);
        this.registerNewClientService<Media>('media',this.mediaService);
        this.postService = new PostService(this.url);
        this.registerNewClientService<ChannelPost>('channel-post', this.postService);
        this.documentService = new DocumentService(this.url, socketIoHost, this.env);
        this.registerNewClientService<Document>('document', this.documentService);
        this.channelsService = new ChannelsService(this.url, socketIoHost, this.env);
        this.registerNewClientService<Channel>('channel', this.channelsService);
        this.userService = new UserService(this.url);
        this.registerNewClientService<User>('user', this.userService);
        this.utilsService = new UtilsService(this.url);
        this.registerNewClientService<WebThumbnail>('utils', this.utilsService);
        this.metadataService = new MetadataService(this.url);
        this.registerNewClientService<Metadata>('metadata', this.metadataService);
        this.userEventService = new UserEventService(this.url);
        this.registerNewClientService<UserEvent>('user-event', this.userEventService);
    }

    async getMetadata(key: string) {
        return await this.metadataService.get(key);
    }

    registerNewClientService<T>(serviceLabel:string, service:BaseServiceClient<T>) {
        this.services[serviceLabel] = service
    }

    getService<T>(serviceLabel:string) : BaseServiceClient<T> {
        return this.services[serviceLabel];
    }

    getDataService(serviceLabel: string) {
        return this.services[serviceLabel];
    }

}
