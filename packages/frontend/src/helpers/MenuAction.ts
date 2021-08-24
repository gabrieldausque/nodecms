export class MenuAction {
    label:string
    cssClasses: string[]
    action: (...args:any) => Promise<void>

    constructor(label:string, action:(...args:any) => Promise<void>, cssClasses:string[] = []) {
        this.label = label;
        this.action = action;
        this.cssClasses = cssClasses;
    }
}