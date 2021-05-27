import {BaseServiceClient} from "./BaseServiceClient";
import type {Project} from '@nodecms/backend-data';

//TODO : Move this to extensions projects

export class ProjectsService extends BaseServiceClient<Project> {

    projects:Array<Project>;

    constructor(url:string) {
        super(url, 'project');
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