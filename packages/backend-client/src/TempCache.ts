export class TempCache {

    private readonly innerCache: { [key:string] : any};
    constructor() {
        this.innerCache = {};
    }
    put(key:string, data:any){
        this.innerCache[key] = data;
    }

    get(key:string):any {
        const data = this.innerCache[key];
        return data;
    }
}