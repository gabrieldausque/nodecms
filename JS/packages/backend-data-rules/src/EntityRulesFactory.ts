import {EntityRules} from "./EntityRules";
import {Entity} from "@nodecms/backend-data";

export class EntityRulesFactory {

    create<T extends Entity, ER extends EntityRules<T>>(type: (new () => ER)) : ER {
        return new type();
    }

}