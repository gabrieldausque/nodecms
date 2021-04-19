import {getBackendClient} from "../api/NodeCMSClient";
import {globalFEService} from "../FEServices";
import {AttachmentHelpers} from "../api/AttachmentHelpers";
import {DocumentsStore} from "../stores/DocumentsStore";
import {DocumentStore} from "../stores/DocumentStore";

export class Helpers {
    static styleOpeningLabel = '<style>';
    static styleClosingLabel = '</style>';

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
    
}