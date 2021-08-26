export * from './helpers';
export {Entity} from './Entity';
export * from './Errors';
export {Authentication} from './Authentication';
export {Authorization} from './Authorization';
export {Channel, ChannelVisibility} from './Channel';
export {ChannelPost} from './ChannelPost';
export {Document, DocumentVisibility, DocumentComponent} from './Document';
export {Media, MediaVisibility} from './Media';
export {Metadata} from './Metadata';
export {Project} from './Project';
export {Role} from './Role';
export {User} from './User';
export {WebThumbnail} from './WebThumbnail';
export {UserEvent, UserAvailabilityStatus, UserEventVisibility} from './UserEvent';
export {InterfaceMeta, Field} from './Metadata/index';

import {Meta as AuthenticationMeta} from './Authentication'
import {Meta as AuthorizationMeta} from './Authorization'
import {Meta as ChannelMeta} from './Channel'
import {Meta as ChannelPostMeta} from './ChannelPost'
import {Meta as DocumentMeta} from './Document'
import {Meta as MediaMeta} from './Media'
import {Meta as MetadataMeta} from './Metadata'
import {Meta as ProjectMeta} from './Project'
import {Meta as RoleMeta} from './Role'
import {Meta as UserMeta} from './User'
import {Meta as UserEventMeta} from './UserEvent'

export const InterfaceMetadata = {
    authentication: AuthenticationMeta,
    authorization: AuthorizationMeta,
    channel: ChannelMeta,
    'channel-post': ChannelPostMeta,
    document: DocumentMeta,
    media: MediaMeta,
    metadata: MetadataMeta,
    project: ProjectMeta,
    role: RoleMeta,
    user: UserMeta,
    'user-event': UserEventMeta
}
