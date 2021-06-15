import {setBackendClient, getClientConfig} from "./services-factory";
import {NodeCMSClient} from "./NodeCMSClient";

export {AttachmentHelpers} from './AttachmentHelpers';
export {BaseServiceClient} from './BaseServiceClient';
export {ChannelsService, channelsEventNames} from './ChannelsService';
export {DocumentService, documentsEventName} from './DocumentService';
export {MediaService} from './MediaService';
export {PostService} from './PostService';
export {ProjectsService} from './ProjectsService';
export {TempCache} from './TempCache';
export {UserService} from './UserService';
export {UtilsService} from './UtilsService';
export {NodeCMSClient} from './NodeCMSClient';
export {NodeCMSFrontEndEvents} from './NodeCMSFrontEndEvents';
export {NodeCMSClientContract} from "./NodeCMSClientContract";
export {getClientConfig, setBackendClient, getBackendClient} from './services-factory';

const config:any = getClientConfig()
setBackendClient(new NodeCMSClient(config.backendHost, config.socketIoHost, config.env));


