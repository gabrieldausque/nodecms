import {getBackendClient, AttachmentHelpers} from '@nodecms/backend-client';
import {globalFEService} from "../FEServices";
import {observableGenericDataStore} from "../stores/ObservableGenericDataStore";
import {DocumentStore} from "../stores/DocumentStore";
import ImageAttachment from "../components/Attachments/ImageAttachment.svelte";
import VideoAttachment from "../components/Attachments/VideoAttachment.svelte";
import AudioAttachment from "../components/Attachments/AudioAttachment.svelte";
import DownloadAttachment from "../components/Attachments/DownloadAttachment.svelte";
import {channelsCache, observableChannelCache} from "../stores/ChannelStore";
import type {Field, Channel, Entity} from "@nodecms/backend-data";
import {InterfaceMetadata} from '@nodecms/backend-data';
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
        const webThumbnails = Array.from(contentElement.querySelectorAll('a[data-link=true]'));
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
                observableGenericDataStore.update(s => {
                    s.data = newDocuments
                    return s;
                })
            } else {
                observableGenericDataStore.update( s => {
                    s.data = [];
                    return s;
                })
            }
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
            console.log(`subscribing to ${channelKey} ##`);
            let channel:Channel;
            const backendClient = await getBackendClient();

            if(!channelsCache.hasChannel(channelKey)){
                channel = await backendClient.channelsService.getChannel(channelKey);
                channelsCache.addChannel(channel);
            }
            channel = channelsCache[channelKey].channel;


            if(channel.isReader){
                await backendClient.channelsService.subscribeToChannel(channel.key, async (mc) => {
                    console.log('receiving message from ' + channel.key);
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
        if(containers){
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
                for(const c of row){
                    if(!(typeof c.properties.row === 'number')){
                        c.properties.row = rowIndex
                    }
                    if((!(typeof c.properties.col === 'number'))) {
                        if(typeof c.properties.order === 'number') {
                            c.properties.col = c.properties.order;
                        }
                    } else {
                        c.properties.col = row.indexOf(c);
                    }
                }
                rows.push(row)
            }
        }
        return rows;
    }

    static getLastRowIndex(containers) {
        if(containers){
            const rowIndexes = containers.map(c => typeof c.properties.row === 'number'? c.properties.row : 0).sort();
            return Math.max(...rowIndexes);
        }
        return 0;
    }

    static updateEditableDocumentStore() {
        EditableDocumentStore.update(eds => {
            return eds;
        })
    }

    static readonly shortLabelsDayOfWeek = ['Dim.', 'Lun.', 'Mar.', 'Mer.','Jeu.','Ven.','Sam.']
    static getShortDayOfWeekLabel(day: Date){
        return Helpers.shortLabelsDayOfWeek[day.getDay()];
    }

    static readonly longLabelsDayOfWeek = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi','Jeudi','Vendredi','Samedi']
    static getLongDayOfWeekLabel(day: Date){
        return Helpers.longLabelsDayOfWeek[day.getDay()];
    }

    static readonly longLabelsMonth = ['Janvier','Février', 'Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre']
    static getLongLabelMonth(date: Date) {
        return Helpers.longLabelsMonth[date.getMonth()]
    }

    static fromDateToString(d:Date):string{
        const date = d.getDate();
        const month = d.getMonth() + 1;
        const year = d.getFullYear();
        return [year,(month < 10?'0' + month:month), (date < 10?'0' + date:date)].join('-');
    }

    static fromTimeToString(d:Date):string{
        const hour = d.getHours();
        const minutes = d.getMinutes();
        return [hour<10?'0' + hour:hour, minutes<10?'0' + minutes:minutes].join(':');
    }

    static fromStringToDate(dateAsString:string, timeAsString:string):Date {
        const splittedDate = dateAsString.split('-');
        const splittedTime = timeAsString.split(':')
        return new Date(parseInt(splittedDate[0]),parseInt(splittedDate[1]) - 1,
            parseInt(splittedDate[2]), parseInt(splittedTime[0]), parseInt(splittedTime[1]));
    }

    static fromStringToTime(dateAsString:string):Date {
        const splitted = dateAsString.split(':');
        return new Date(parseInt(splitted[0]),parseInt(splitted[1]) - 1, parseInt(splitted[2]))
    }

    static getAllDaysBetween(startDate: Date, endDate: Date) {
        const newDays = [];
        newDays.push(startDate);
        while (newDays.length < endDate.getDate() - 1) {
            const nextDay = new Date(startDate.getFullYear(), startDate.getMonth(), startDate.getDate() + newDays.length);
            if (!newDays.find(d => d === nextDay.getTime()) && nextDay) {
                newDays.push(nextDay);
            }
        }
        newDays.push(endDate);
        newDays.sort((d1, d2) => {
            if(d1.getTime() > d2.getTime())
                return 1;
            if(d1.getTime() > d2.getTime())
                return -1;
            return 0
        });
        return newDays;
    }

    static getDefaultFields(typeName:string):Field[] {
        if(InterfaceMetadata.hasOwnProperty(typeName)){
            return InterfaceMetadata[typeName].fields;
        }
        return []
    }

    static isDescending(typeName:string):boolean {
        if(InterfaceMetadata.hasOwnProperty(typeName)){
            return InterfaceMetadata[typeName].isDescending ? true: false;
        }
        return false;
    }

    static getInterfaceLabel(dataType: string):string {
        if(InterfaceMetadata.hasOwnProperty(dataType)){
            return InterfaceMetadata[dataType].label;
        }
        return 'unknown'
    }
}