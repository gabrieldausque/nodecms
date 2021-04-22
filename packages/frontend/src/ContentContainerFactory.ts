export class ContentContainerFactory {
    registeredConstructors: {
        constructor: any
        title?: string,
        cssClasses?: string
    }

    constructor() {
        this.registeredConstructors = {}
    }

    registerContentContainer(key:string, contentContainerConstructor:any, title?:string, cssClasses?:string, editorConstructor?:any){
        this.registeredConstructors[key] = {
            constructor: contentContainerConstructor,
            title: title,
            cssClasses: cssClasses,
            editorConstructor:editorConstructor
        };
    }

    getContentContainer(key:string) {
        if(this.registeredConstructors.hasOwnProperty(key)){
            return this.registeredConstructors[key].constructor;
        }
        throw new Error(`No ctor registered with key ${key}`);
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

    getConstructors() {
        const constructors = [];
        for(const c in this.registeredConstructors){
            if(this.registeredConstructors.hasOwnProperty(c)){
                constructors.push(this.registeredConstructors[c]);
            }
        }
        return constructors;
    }
}

export const globalContentContainerFactory = new ContentContainerFactory();

(window as any).globalContainerFactory = globalContentContainerFactory;