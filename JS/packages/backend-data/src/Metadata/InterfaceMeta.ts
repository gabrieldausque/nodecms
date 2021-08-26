import {Field} from "./Field";

export interface InterfaceMeta {
    name: string,
    label: string,
    isDescending?: boolean,
    fields: Field[]
}