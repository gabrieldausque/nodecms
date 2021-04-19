import {UseCases} from "./UseCases";
import {Document, DocumentVisibility} from "../entities/Document";
import {User} from "../entities/User";
import {DocumentRules} from "../entities/DocumentRules";
import {DocumentStorage} from "../plugins/Storages/Document/DocumentStorage";
import {UseCaseConfiguration} from "./UseCaseConfiguration";
import {globalInstancesFactory} from "@hermes/composition";
import {UserUseCases} from "./UserUseCases";
import {RoleUseCases} from "./RoleUseCases";
import {Role} from "../entities/Role";

export class DocumentUseCases extends UseCases<Document> {

  public static metadata:any[] = [
    {
      contractType:'UseCases',
      contractName:'Document',
      isShared:true
    }
  ]

  private documentStorage: DocumentStorage;

  constructor(configuration:UseCaseConfiguration) {
    super('document', 'DocumentStorage', configuration);
    this.documentStorage = this.storage as DocumentStorage;
  }

  async create(entity: Partial<Document>, executingUser: User): Promise<Document> {
    await DocumentRules.validate(entity, executingUser)
    entity.creationDate = new Date();
    entity.updateDate = entity.creationDate;
    return await this.storage.create(entity);
  }

  async delete(id: string | number, executingUser: User): Promise<Document> {
    return await this.storage.delete(id)
  }

  async find(filter: Partial<Document>, lastIndex?:number, executingUser?: User): Promise<Document[]> {
    const found = await this.storage.find(filter, lastIndex);
    for(const document of found){
      DocumentRules.validateForRead(document);
      document.isReader = executingUser?await this.isUserReader(document, executingUser):document.visibility === DocumentVisibility.public;
      document.isEditor = executingUser?await this.isUserEditor(document, executingUser):false;
    }
    return found;
  }

  async get(id: string | number, executingUser?: User): Promise<Document> {
    const entity = await this.storage.get(id);
    DocumentRules.validateForRead(entity);
    if(await this.isDataAuthorized(entity,'r', executingUser))
      return entity;
    else
      throw new Error(`User ${executingUser?.login} is not authorized to access document with id ${entity.id}`);
  }

  async update(id: string | number, entityToUpdate: Partial<Document>, executingUser: User): Promise<Document> {
    const data = await this.get(id);
    if(!await this.isDataAuthorized(data, 'w', executingUser))
      throw new Error('Not Authorized');
    else {
      data.updateDate = new Date();
      return await this.storage.update(data);
    }
  }

  async isDataAuthorized(data: Document, right: string = 'r', user?: any): Promise<boolean> {
    const userUseCases:UserUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'User');
    if(right === 'r'){
       return await this.isUserReader(data, user);
    } else if(right === 'w') {
      return await this.isUserEditor(data, user);
    }
    return super.isDataAuthorized(data, right, user);
  }

  private async isUserReader(data: Document, user: User):Promise<boolean> {
    const userUseCases:UserUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'User');
    if(user && typeof user.id === 'number'){
      let isExplicitReader:boolean = data.ownerId === user.id;
      if(!isExplicitReader){
        for(const readerId of data.readers){
          if(readerId === user.id)
          {
            isExplicitReader = true;
            break;
          }
        }
      }
      if(!isExplicitReader)
      {
        if(data.visibility === DocumentVisibility.public) {
          isExplicitReader = true
        } else if(data.visibility === DocumentVisibility.protected){
          isExplicitReader = await userUseCases.isValidUser(user);
        } else if(data.visibility === DocumentVisibility.private){
          const roleUseCases:RoleUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'Role');
          const userUseCases:UserUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','User');
          for(const readerRoleId of data.readerRoles){
            const role:Role = await roleUseCases.get(readerRoleId, user);
            if(await userUseCases.isMemberOf(role.key,user,user)){
              isExplicitReader = true;
              break;
            }
          }
        }
      }
      return isExplicitReader || (await this.isUserEditor(data, user))
    }
    return data.visibility === DocumentVisibility.public;
  }

  private async isUserEditor(data: Document, user: any):Promise<boolean> {
    const roleUseCases:RoleUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases', 'Role');
    const userUseCases:UserUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','User');
    let isExplicitEditor:boolean = data.ownerId === user.id;
    if(!isExplicitEditor){
      for(const editorId of data.editors){
        if(editorId === user.id)
        {
          isExplicitEditor = true;
          break;
        }
      }
    }
    if(!isExplicitEditor){
      for(const editorsRoleId of data.editorRoles){
        const role:Role = await roleUseCases.get(editorsRoleId, user);
        if(await userUseCases.isMemberOf(role.key,user,user)){
          isExplicitEditor = true;
          break;
        }
      }
    }
    return isExplicitEditor || userUseCases.isUserAdministrators(user,user);
  }
}
