import {getBackendClient, AttachmentHelpers} from '@nodecms/backend-client';
import {globalFEService} from "../FEServices";
import {DocumentsStore} from "../stores/DocumentsStore";
import {DocumentStore} from "../stores/DocumentStore";
import ImageAttachment from "../components/contentComponents/Channel/Attachments/ImageAttachment.svelte";
import VideoAttachment from "../components/contentComponents/Channel/Attachments/VideoAttachment.svelte";
import AudioAttachment from "../components/contentComponents/Channel/Attachments/AudioAttachment.svelte";
import DownloadAttachment from "../components/contentComponents/Channel/Attachments/DownloadAttachment.svelte";
import {ChannelContent} from "../stores/ChannelStore";


export class Helpers {
    static styleOpeningLabel = '<style>';
    static styleClosingLabel = '</style>';

    static documentEventsSubscribed:string[] = []

    static async preloadContentPreview(content){
        const contentElement = document.createElement('div');
        contentElement.innerHTML = content;
        const backendService = await getBackendClient();
        const webThumbnails = contentElement.querySelectorAll('a[data-link=true]')
        const tempCache = globalFEService.getService('TempCache');
        for(const link of webThumbnails){
            const URL = link.getAttribute('href');
            console.log('getting tw for ' + URL);
            if(!tempCache.get(URL)) {
                const linkPreview = await backendService.utilsService.getWebsiteThumbnail(URL.trim())
                if(linkPreview) {
                    const media = await backendService.mediaService.getMedia(linkPreview.mediaId);
                    const mediaUrl = AttachmentHelpers.getDownloadUrl(media);
                    link.innerHTML = `
                                        <div class="link-preview">
                                            <img src="${mediaUrl}"><div><h6>${linkPreview.title}</h6><br><p>${linkPreview.description}</p></div>
                                        </div>
                                    `
                    tempCache.put(link.getAttribute('href'),link.innerHTML)
                }
            }
        }
    }

    static async displayDocument(documentKey:string) {
        if(documentKey){
            if(documentKey === 'documents'){
                const services = await getBackendClient();
                const newDocuments = await services.documentService.findDocument();
                for(const doc of newDocuments){
                    doc.author = await services.userService.getUser(doc.ownerId);
                }
                DocumentsStore.update(s => {
                    s.documents = newDocuments
                    return s;
                })
            };
            DocumentStore.update((store) => {
                store.key = documentKey;
                return store;
            })
        }
    }

    static getAttachmentComponent(attachmentMediaType:string) {
        if(attachmentMediaType){
            if(attachmentMediaType.indexOf('image') >= 0){
                return ImageAttachment;
            } else if (attachmentMediaType.indexOf('video') >= 0) {
                return VideoAttachment;
            } else if (attachmentMediaType.indexOf('audio') >= 0) {
                return AudioAttachment;
            }
        }
        return DownloadAttachment;
    }

    static subscribeToDocumentEvent(eventName:string, handler:any){
        if(Helpers.documentEventsSubscribed.indexOf(eventName) < 0){
            document.addEventListener(eventName, handler);
            Helpers.documentEventsSubscribed.push(eventName);
        }
    }

    static async getChannelContentAndSubscribe(channelKey:string, onMessageReceived:(mc:any) => Promise<void>) {
        if(channelKey){
            const backendClient = await getBackendClient();
            const newChannelContentStore = new ChannelContent();
            newChannelContentStore.key = channelKey;
            newChannelContentStore.channel = await backendClient.channelsService.getChannel(channelKey);

            if(newChannelContentStore.channel.isReader){
                await backendClient.channelsService.subscribeToChannel(newChannelContentStore.channel.key, onMessageReceived)
                newChannelContentStore.posts = await backendClient.channelsService.getChannelPosts(channelKey, );
                for(const p of newChannelContentStore.posts) {
                    if(p.content){
                        await Helpers.preloadContentPreview(p.content)
                    }
                    if(Array.isArray(p.attachments) && p.attachments.length > 0){
                        const attachmentsMetadata = [];
                        for(const a of p.attachments){
                            const m = await backendClient.mediaService.getMediaMetadata(a);
                            attachmentsMetadata.push(m);
                        }
                        p.attachments = attachmentsMetadata;
                    }

                }
            }
            return newChannelContentStore;
        }
    }

}