import { writable } from "svelte/store";

export class Project {
    id:number
    key:string
    label:string
    description:string
}

export const ProjectStore = writable(new Array<Project>());