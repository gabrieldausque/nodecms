import {writable} from "svelte/store";

export class Authentication  {
    isLogin:boolean
    login?:string;
    id?:number;
}

export const UserStore = writable(new Authentication())