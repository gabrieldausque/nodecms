export class ContentContainerFactory {
    public registeredConstructors: {
        [constructorKey:string ] : {
            type:string,
            constructor: any,
            title?: string,
            cssClasses?: string,
            editorConstructor?: any,
            canDisplayInEditMode: boolean
        }
    }

    constructor() {
        this.registeredConstructors = {}
    }

    registerContentContainer(key:string,
                             contentContainerConstructor:any,
                             titleForEdition?:string,
                             cssClassesForEdition?:string,
                             editorConstructor?:any,
                             canDisplayInEditMode:boolean = true){
        this.registeredConstructors[key] = {
            type: key,
            constructor: contentContainerConstructor,
            title: titleForEdition,
            cssClasses: cssClassesForEdition,
            editorConstructor:editorConstructor,
            canDisplayInEditMode: canDisplayInEditMode
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