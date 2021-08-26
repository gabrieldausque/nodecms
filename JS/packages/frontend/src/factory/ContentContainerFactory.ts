import {BaseComponentFactory} from "./BaseComponentFactory";

export class ContentContainerFactory extends BaseComponentFactory {
    constructor() {
        super();
    }

    getContentContainerTitle(key:string){
        if(this.registeredConstructors.hasOwnProperty(key)){
            return this.registeredConstructors[key].title;
        }
        throw new Error(`No ctor registered with key ${key}`);
    }

    getContentContainerCssClasses(key:string){
        if(this.registeredConstructors.hasOwnProperty(key)){
            return this.registeredConstructors[key].cssClasses;
        }
        throw new Error(`No ctor registered with key ${key}`);
    }
}

export const globalContentContainerFactory = new ContentContainerFactory();

(window as any).globalContainerFactory = globalContentContainerFactory;