import {BaseServiceClient} from "./BaseServiceClient";
// @ts-ignore
import {AxiosInstance} from "axios";
import type {Project} from '@nodecms/backend-data';

export class ProjectsService extends BaseServiceClient {

    projects:Array<Project>;

    constructor(axiosInstance: AxiosInstance, url:string) {
        super(axiosInstance, url);
        this.projects = new Array<Project>();
    }

    getRandomInt(max:number) {
        let nextId = Math.floor(Math.random() * Math.floor(max));
        while(this.projects.find(p => p.id === nextId)){
            nextId = Math.floor(Math.random() * Math.floor(max));
        }
        return nextId;
    }

    async createProject(label:string,
                        key:string,
                        description?:string) {
        const p:Project = {
            label: '',
            key: '',
            description: ''
        };
        p.key = key;
        p.id = this.getRandomInt(10000);
        p.description = description?description:'';
        p.label = label;
        this.projects.push(p);
        console.log(this);
        return p;
    }

    async exists(value: any) {
        return this.projects.findIndex(p => p.key === value) >= 0;
    }
}