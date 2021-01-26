import {writable} from "svelte/store";

export class Authentication  {
    isLogin:boolean
    login?:string;
}

export const UserStore = writable(new Authentication())