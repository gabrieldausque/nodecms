import {BaseComponentFactory} from "./BaseComponentFactory";

export class PanelFactory extends BaseComponentFactory {
    constructor() {
        super();
    }
}

export const panelFactory = new PanelFactory()