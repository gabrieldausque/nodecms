export class AttachmentHelpers {

    static getImageUrl(media) {
        return `url(${AttachmentHelpers.getDownloadUrl(media)})`;
    }

    static getDownloadUrl(media) {
        const localBuffer = new Uint8Array(media.blob.data);
        const blob = new Blob([localBuffer], {type: media.mediaType});
        return URL.createObjectURL(blob)
    }

}