export class AttachmentHelpers {

    static getImageUrl(media:any) {
        return `url(${AttachmentHelpers.getDownloadUrl(media)})`;
    }

    static getDownloadUrl(media:any) {
        const localBuffer = new Uint8Array(media.blob.data);
        const blob = new Blob([localBuffer], {type: media.mediaType});
        return URL.createObjectURL(blob)
    }

}