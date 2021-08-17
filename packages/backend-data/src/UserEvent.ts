import {Entity, EntityFields} from "./Entity";
import {InterfaceMeta} from "./Metadata/InterfaceMeta";

export const UserEventVisibility = {
    protected:"protected",
    private:"private",
    isValidVisibility(visibility?:string){
        return visibility === this.protected ||
            visibility === this.private;
    }
}

export const UserAvailabilityStatus = {
    busy: "busy",
    available: "available",
    isValidAvailability(ownerAvailabilityStatus?: string): boolean {
        return ownerAvailabilityStatus === this.busy ||
            ownerAvailabilityStatus === this.available
    }
}

export interface UserEvent extends Entity {
    startDate: Date,
    endDate: Date,
    category: string,
    ownerId?: number,
    ownerAvailabilityStatus: string,
    visibility: string,
    label: string,
    description: string,
    location: string,
    color: string
}

export const Meta:InterfaceMeta = {
    name:'user-event',
    label:'Evènements',
    fields: [
        ...EntityFields,
        {
            name: 'startDate',
            type:'date',
            visible:true,
            editable:true,
            description: 'Date de début de l\'évènement',
            label: 'Début',
            masked:false
        },
        {
            name: 'endDate',
            type:'date',
            visible:true,
            editable:true,
            description: 'Date de fin de l\'évènement',
            label: 'Fin',
            masked:false
        },
        {
            name: 'ownerId',
            label: 'Propriétaire',
            type:'user',
            description: 'Identifiant unique du propriétaire',
            visible:true,
            editable:false,
            masked:false
        },
        {
            name: 'category',
            label: 'Catégorie',
            type:'string',
            description: 'Catégorie de l\'évènement',
            visible:true,
            editable:true,
            masked:false
        },
        {
            name: 'ownerAvailabilityStatus',
            label: 'Disponibilité',
            type:'string',
            description: 'Disponibilité du propriétaire de l\'évènement',
            visible:true,
            editable:true,
            masked:false
        },
        {
            name: 'description',
            label: 'Description',
            type: 'string',
            visible: true,
            editable: true,
            description: 'Description de l\'évènement',
            masked:false
        },
        {
            name: 'label',
            label: 'Label',
            type: 'string',
            visible: true,
            editable: true,
            description: 'Label du media',
            masked:false
        },
        {
            name:'visibility',
            type:'string',
            visible: true,
            editable: true,
            label: 'Visibilité',
            description: 'Visibilité de l\'évènement',
            masked:false
        },
        {
            name:'location',
            type:'string',
            visible: true,
            editable: true,
            label: 'Localisation',
            description: 'Localisation',
            masked:false
        },
        {
            name:'color',
            type:'color',
            visible: true,
            editable: true,
            label: 'Couleur',
            description: 'Couleur de l\'évènement',
            masked:false
        }
    ]
}