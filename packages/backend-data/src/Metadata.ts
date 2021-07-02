import {Entity, EntityFields} from "./Entity";
import {InterfaceMeta} from "./Metadata/InterfaceMeta";

export interface Metadata extends Entity {
    key: string;
    value?: any;
    isPublic?: boolean;
    ownerType?: string | null;
    ownerId?: number | null;
}

export const Meta:InterfaceMeta = {
    label:'Métadonnées',
    name:'metadata',
    fields: [
        ...EntityFields,
        {
            name:'key',
            type:'string',
            label:'Clé',
            description:'Clé unique de la metadonnée',
            visible:true,
            editable:true
        },
        {
            name:'value',
            type:'string',
            visible:true,
            editable:true,
            label:'Valeur',
            description:'Valeur de la metadonnée'
        },
        {
            name:'isPublic',
            label:'Visibilité',
            type:'boolean',
            description:'Visibilité de la métadonnée. Vrai si public, sinon privé',
            visible: true,
            editable: true
        },
        {
            name:'ownerType',
            label:'Type de propriétaire',
            type:'string',
            visible:true,
            editable:true,
            description:'Type de propriétaire (user, document, etc ...)'
        },
        {
            name: 'ownerId',
            label: 'Propriétaire',
            type:'user',
            description: 'Identifiant unique du propriétaire',
            visible:true,
            editable:true
        }
    ]
}