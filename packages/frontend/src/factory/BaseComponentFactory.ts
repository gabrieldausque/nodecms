export abstract class BaseComponentFactory {
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

    protected constructor() {
        this.registeredConstructors = {}
    }

    registerComponent(key:string,
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

    getComponent(key:string) {
        if(this.registeredConstructors.hasOwnProperty(key)){
            return this.registeredConstructors[key].constructor;
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