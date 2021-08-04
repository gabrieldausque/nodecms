import {writable} from 'svelte/store';

export class FooterAction {
    label:string
    cssClasses: string[]
    action: (...args:any) => Promise<void>

}

export class ModalContext {
    title:string;
    bodyControlType:string;
    bodyControlProperties: any;
    actions: FooterAction[];
    close: boolean;

    constructor() {
        this.title ='';
        this.bodyControlType= '';
        this.bodyControlProperties = {};
        this.actions = [];
        this.close = false;
    }
}

export const ModalStore = writable(new ModalContext());