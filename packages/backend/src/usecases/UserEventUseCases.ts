import {UseCases} from "./UseCases";
import {
  Entity,
  InvalidAuthenticationError,
  InvalidDataError,
  User,
  UserEvent,
  UserEventVisibility
} from "@nodecms/backend-data";
import {UserEventEntityRules} from "@nodecms/backend-data-rules";
import {UseCaseConfiguration} from "./UseCaseConfiguration";

interface UserEventUseCasesConfiguration extends UseCaseConfiguration {};

export class UserEventUseCases extends UseCases<UserEvent, UserEventEntityRules> {

  public static metadata:any[] = [
    {
      contractType:'UseCases',
      contractName:'UserEvent',
      isShared:true
    }
  ]

  constructor(configuration:UserEventUseCasesConfiguration) {
    super('userEvent',
      'UserEventStorage',
      configuration,
      false,
      UserEventEntityRules);
  }

  async find(filter:Partial<UserEvent>, lastIndex?:number | string, executingUser?:User): Promise<UserEvent[]>{
    const found = await super.find(filter, lastIndex, executingUser);
    for(const userEvent of found){
      if(executingUser &&
        typeof executingUser.id === 'number' &&
        userEvent.ownerId !== executingUser.id &&
        userEvent.visibility === UserEventVisibility.private
      ) {
        userEvent.label = 'private';
        userEvent.description = '';
        userEvent.location = '';
        userEvent.category = '';
        userEvent.attachments = [];
      }
    }
    return found;
  }

  async get(id : string | number, executingUser?:User) : Promise<UserEvent> {
    const userEvent = await super.get(id, executingUser);
    //in case visibility is private and user is not owner, hiding private fields, leave only availability of owner
    if(executingUser &&
      typeof executingUser.id === 'number' &&
      userEvent.ownerId !== executingUser.id &&
      userEvent.visibility === UserEventVisibility.private
    ) {
      userEvent.label = '';
      userEvent.description = '';
      userEvent.location = '';
      userEvent.category = '';
      userEvent.attachments = [];
    }
    return userEvent
  }

  async create(entity:UserEvent, executingUser?:User): Promise<UserEvent> {
    if(!executingUser || !(typeof executingUser.id === 'number')){
      throw new InvalidAuthenticationError('Only user authenticated can create UserEvents');
    }
    if(entity.ownerId !== executingUser.id){
      entity.ownerId = executingUser.id;
    }
    return super.create(entity, executingUser)
  }

  async isDataAuthorized(data:Entity, right:string='r', user?:any):Promise<boolean> {
    const userEvent:UserEvent = data as UserEvent;
    const realUser = user as User;
    if(userEvent === null || !realUser){
      return false;
    }

    if(userEvent.ownerId === realUser.id)
      return true;

    return right === 'r'

  }
}
