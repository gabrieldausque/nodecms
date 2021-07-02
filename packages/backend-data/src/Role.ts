import {Entity, EntityFields} from "./Entity";
import {InterfaceMeta} from "./Metadata/InterfaceMeta";

export interface Role extends Entity {
    key: string;
    description?: any;
    members?: number[];
    ownerId?: number;
    ownerRoles?: number[];
    creationDate?: Date
}

export const Meta:InterfaceMeta = {
    label:'Rôles',
    name:'role',
    fields: [
        ...EntityFields,
        {
            name: 'key',
            type: 'string',
            visible: true,
            editable: true,
            description: 'Clé unique du role',
            label: 'Clé'
        },
        {
            name: 'description',
            label: 'Description',
            type: 'string',
            visible: true,
            editable: true,
            description: 'Description du role'
        },
        {
            name:'members',
            label: 'Membres',
            type: 'array:user',
            description: 'Membres du role',
            visible: true,
            editable: true
        },
        {
            name: 'ownerId',
            label: 'Propriétaire',
            type:'user',
            description: 'Identifiant unique du propriétaire',
            visible:true,
            editable:true
        },
        {
            name: 'ownerRoles',
            label: 'Propriétaires',
            type:'array:role',
            description: 'Identifiants unique des roles éditeurs de ce rôle',
            visible:true,
            editable:true
        },
        {
            name: 'creationDate',
            type:'date',
            visible: true,
            editable: false,
            label: 'Date de création',
            description: 'Date de création'
        }
    ]
}
