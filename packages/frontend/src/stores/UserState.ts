import {writable} from "svelte/store";

export class Authentication  {
    isLogin:boolean
    login?:string;
}

export const UserState = writable(new Authentication())