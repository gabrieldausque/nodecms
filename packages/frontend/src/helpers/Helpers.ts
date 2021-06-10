import {getBackendClient, AttachmentHelpers} from '@nodecms/backend-client';
import {globalFEService} from "../FEServices";
import {DocumentsStore} from "../stores/DocumentsStore";
import {DocumentStore} from "../stores/DocumentStore";
import ImageAttachment from "../components/contentComponents/Channel/Attachments/ImageAttachment.svelte";
import VideoAttachment from "../components/contentComponents/Channel/Attachments/VideoAttachment.svelte";
import AudioAttachment from "../components/contentComponents/Channel/Attachments/AudioAttachment.svelte";
import DownloadAttachment from "../components/contentComponents/Channel/Attachments/DownloadAttachment.svelte";
import {channelsCache, observableChannelCache} from "../stores/ChannelStore";
import type {Channel} from "@nodecms/backend-data";
import {EditableDocumentStore} from "../stores/EditableDocumentStore";


export class Helpers {
    static styleOpeningLabel = '<style>';
    static styleClosingLabel = '</style>';

    static documentEventsSubscribed:string[] = []

    static readonly visibilityTooltips = {
        private: "Un document privé n'est accessible et visible que par ses lecteurs et les administrateurs",
        protected: "Un document protégé n'est accessible que par les utilisateurs valides et authentifiés",
        public: "Un document public est accessible par les utilisateurs et les non utilisateurs"
    }

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

    static async getChannelContentAndSubscribe(channelKey:string) {
        if(channelKey){
            let channel:Channel;
            const backendClient = await getBackendClient();

            if(!channelsCache.hasChannel(channelKey)){
                channel = await backendClient.channelsService.getChannel(channelKey);
                channelsCache.addChannel(channel);
            }
            channel = channelsCache[channelKey].channel;
            if(channel.isReader){
                await backendClient.channelsService.subscribeToChannel(channel.key, async (mc) => {
                    if(mc.content){
                        await Helpers.preloadContentPreview(mc.content)
                    }
                    if(Array.isArray(mc.attachments) && mc.attachments.length > 0){
                        const attachmentsMetadata = [];
                        for(const a of mc.attachments){
                            const m = await backendClient.mediaService.getMediaMetadata(a);
                            attachmentsMetadata.push(m);
                        }
                        mc.attachments = attachmentsMetadata;
                    }
                    mc.isNew = true;
                    observableChannelCache.update(occ => {
                        for(const p of occ[channelKey].posts){
                            p.isNew = false;
                            if(typeof mc.parentPost === 'number' && p.id === mc.parentPost){
                                if(typeof p.answerCount !== 'number')
                                    p.answerCount = 0;
                                p.answerCount++;
                            }
                        }
                        occ[channelKey].posts.push(mc);
                        occ[channelKey].posts.sort((p1,p2) => {
                            if(p1.id > p2.id)
                                return -1;
                            if(p1.id < p2.id)
                                return 1
                            return 0;
                        })
                        return occ;
                    })
                })
                channelsCache[channelKey].posts = await backendClient.channelsService.getChannelPosts(channelKey);
                for(const p of channelsCache[channelKey].posts) {
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
            observableChannelCache.update(occ => {
                return occ;
            })
        }
    }

    static getRows(containers){
        const rows = []
        const rowIndexes = containers.map(c => typeof c.properties.row === 'number'? c.properties.row : 0).sort();
        const rowUniqueIndexes = [];
        for(const ri of rowIndexes){
            if(rowUniqueIndexes.indexOf(ri) < 0)
                rowUniqueIndexes.push(ri);
        }
        for(const rowIndex of rowUniqueIndexes){
            const row = []
            for(const colContainer of containers.filter(c => {
                if(rowIndex === 0)
                    return c.properties.row === rowIndex || typeof c.properties.row === 'undefined' || c.properties.row === null;
                else
                    return c.properties.row === rowIndex;
            })){
                row.push(colContainer);
            }
            row.sort((c1,c2) => {
                if(c1.properties.col > c2.properties.col)
                    return 1;
                if(c1.properties.col < c2.properties.col)
                    return -1;
                return 0;
            })
            rows.push(row)
        }
        return rows;
    }

    static getLastRowIndex(containers) {
        const rowIndexes = containers.map(c => typeof c.properties.row === 'number'? c.properties.row : 0).sort();
        return Math.max(...rowIndexes);
    }

    static async updateEditableDocumentStore() {
        EditableDocumentStore.update(eds => {
            return eds;
        })
    }
}