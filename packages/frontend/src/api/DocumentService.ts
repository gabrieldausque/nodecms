import {BaseServiceClient} from "./BaseServiceClient";
import type {AxiosInstance} from "axios";
import axios from "axios";
import {globalFEService} from "../FEServices";

export class DocumentService extends BaseServiceClient {

    constructor(axiosInstance: AxiosInstance, url:string) {
        super(axiosInstance, url);
    }

    async getDocument(key:string) {
        try{
            const response = await axios.request({
                method:'get',
                baseURL:this.url,
                url:`document/${key}`,
                headers: this.createHeaders()
            })
            return response.data;
        }catch(error){
            globalFEService.getService('displayError').displayError('Erreur lors de la lecture d\'un document', error.response.data.message);
            throw(error);
        }
    }

}