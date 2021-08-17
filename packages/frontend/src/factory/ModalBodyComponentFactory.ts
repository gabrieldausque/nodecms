import {BaseComponentFactory} from "./BaseComponentFactory";
import GenericEntityEditor from "../components/Editors/EntityEditors/GenericEntityEditor.svelte";

export class ModalBodyComponentFactory extends BaseComponentFactory {
    constructor() {
        super();
    }

    getComponent(key: string): any {
        if(this.registeredConstructors[key]){
            return super.getComponent(key);
        } else {
            return GenericEntityEditor;
        }
    }
}

export const globalModalBodyComponentFactory = new ModalBodyComponentFactory();

(window as any).globalModalBodyComponentFactory = globalModalBodyComponentFactory;