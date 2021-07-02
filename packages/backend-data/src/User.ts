import {Entity, EntityFields} from "./Entity";
import {InterfaceMeta} from "./Metadata/InterfaceMeta";

export interface User extends Entity{
    login: string;
    password: string;
    isActive?: boolean;
}

export const Meta:InterfaceMeta = {
    label:'Utilisateurs',
    name:'user',
    fields:[
        ...EntityFields,
        {
            name:'login',
            label:'Login',
            editable:false,
            visible:true,
            description: 'Login de l\'utilisateur',
            type:'string'
        },
        {
            name:'password',
            label: 'Mot de passe',
            type: 'string',
            visible: true,
            editable: true,
            description: 'Mot de passe'
        },
        {
            name:'isActive',
            description:'Indique si l\'utilisateur est considéré comme actif',
            visible:true,
            editable:true,
            type: 'boolean',
            label: 'Actif ?'
        }
    ]
}


