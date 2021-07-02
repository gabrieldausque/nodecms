import {Entity, EntityFields} from "./Entity";
import {InterfaceMeta} from "./Metadata/InterfaceMeta";

export interface Project extends Entity {
    key:string
    label:string
    description:string
}

export const Meta:InterfaceMeta = {
    label:'Projets',
    name:'project',
    fields: [
        ...EntityFields,
        {
            name: 'key',
            label: 'Clé',
            type: 'string',
            visible: true,
            editable: true,
            description: 'Clé unique du projet'
        },
        {
            name: 'label',
            label: 'Label',
            type: 'string',
            visible: true,
            editable: true,
            description: 'Label du projet'
        },
        {
            name: 'description',
            label: 'Description',
            type: 'string',
            visible: true,
            editable: true,
            description: 'Description du projet'
        }
    ]
}