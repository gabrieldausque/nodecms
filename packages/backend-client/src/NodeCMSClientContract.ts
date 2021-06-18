import {MediaService} from "./MediaService";
import {PostService} from "./PostService";
import {DocumentService} from "./DocumentService";
import {ChannelsService} from "./ChannelsService";
import {UserService} from "./UserService";
import {UtilsService} from "./UtilsService";
import {MetadataService} from "./MetadataService";
import {BaseServiceClient} from "./BaseServiceClient";

export interface NodeCMSClientContract {

    mediaService: MediaService;
    postService: PostService;
    documentService: DocumentService;
    channelsService: ChannelsService;
    userService: UserService;
    utilsService: UtilsService;
    metadataService: MetadataService;

    getMetadata(key: string): Promise<any>;

    registerNewClientService<T>(serviceLabel:string, service:BaseServiceClient<T>) : void;

    getService<T>(serviceLabel:string) : BaseServiceClient<T>
}