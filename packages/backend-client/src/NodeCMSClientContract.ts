import {MediaService} from "./MediaService";
import {PostService} from "./PostService";
import {DocumentService} from "./DocumentService";
import {ChannelsService} from "./ChannelsService";
import {UserService} from "./UserService";
import {UtilsService} from "./UtilsService";
import {ProjectsService} from "./ProjectsService";
import {MetadataService} from "./MetadataService";

export interface NodeCMSClientContract {

    mediaService: MediaService;
    postService: PostService;
    documentService: DocumentService;
    channelsService: ChannelsService;
    userService: UserService;
    utilsService: UtilsService;
    projectsService: ProjectsService;
    metadataService: MetadataService;

    getMetadata(key: string): Promise<any>;
}