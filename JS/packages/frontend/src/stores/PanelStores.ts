import {writable} from 'svelte/store';
import type {ComponentMetadata} from "../helpers/ComponentMetadata";

export class PanelContext {

    isShown:boolean;
    components: ComponentMetadata[];

    constructor() {
        this.isShown = false;
        this.components = [];
    }

    clearComponents(){
        this.components = [];
    }

    addComponent(componentMetadata:ComponentMetadata){
        this.components.push(componentMetadata);
    }
}

export const allPanelsContext: { [panelName:string] : any} = [];
export const leftPanelContext = writable(new PanelContext());
export const rightPanelContext = writable(new PanelContext());
allPanelsContext.left = leftPanelContext;
allPanelsContext.right = rightPanelContext;
