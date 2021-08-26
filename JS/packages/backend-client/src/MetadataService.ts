import {BaseServiceClient} from "./BaseServiceClient";
import {Metadata} from "@nodecms/backend-data/dist";

export class MetadataService extends BaseServiceClient<Metadata> {
    constructor(url: string) {
        super(url, 'metadata');
    }
}