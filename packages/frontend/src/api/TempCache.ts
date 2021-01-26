export class TempCache {
    private innerCache: { [key:string] : any};
    constructor() {
        this.innerCache = {};
    }
    put(key:string, data:any){
        this.innerCache[key] = data;
    }

    get(key):any {
        const data = this.innerCache[key];
        return data;
    }
}