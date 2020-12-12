export class ContentContainerFactory {
    registeredConstructors:object;
    constructor() {
        this.registeredConstructors = {}
    }

    registerContentContainer(key:string, contentContainerConstructor:any){
        this.registeredConstructors[key] = contentContainerConstructor;
    }

    getContentContainer(key:string) {
        if(this.registeredConstructors.hasOwnProperty(key)){
            return this.registeredConstructors[key];
        }
        throw new Error(`No ctor registered with key ${key}`);
    }

}

export const globalContentContainerFactory = new ContentContainerFactory();