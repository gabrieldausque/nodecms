export class ComponentMetadata {
    controlType:string;
    controlProperties: any;

    constructor(controlType:string, controlProperties:any) {
        this.controlType = controlType;
        this.controlProperties = controlProperties;
    }
}