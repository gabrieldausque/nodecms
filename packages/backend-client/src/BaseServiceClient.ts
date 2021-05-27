import type {AxiosInstance} from "axios";

export abstract class BaseServiceClient {

    protected constructor(axiosInstance: AxiosInstance, url: string) {
        this.axiosInstance = axiosInstance;
        this.url = url;
    }

    protected axiosInstance: AxiosInstance;
    protected url: string;

    createHeaders() {
        return {
            crossDomain:true,
            withCredentials: true
        };
    }
}