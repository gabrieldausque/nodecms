import {UseCases} from "./UseCases";
import {UseCaseConfiguration} from "./UseCaseConfiguration";
import {RoleEntityRules} from "../entities/RoleEntityRules";
import {Role} from "../entities/Role";
import {User} from "../entities/User";
import {AlreadyExistsError} from "../entities/Errors/AlreadyExistsError";
import {InvalidKeyError} from "../entities/Errors/InvalidKeyError";

interface RoleUseCasesConfiguration extends UseCaseConfiguration {};

export class RoleUseCases extends UseCases<Role> {

  public static metadata:any[] = [
    {
      contractType:'UseCases',
      contractName:'Role',
      isShared:true
    }
  ]


  constructor(configuration:RoleUseCasesConfiguration) {
    super('role','RoleStorage', configuration);
  }

  async create(entity: Partial<Role>, executingUser:User): Promise<Role> {
    if(!entity.key)
      throw new InvalidKeyError(`Key can't be empty and must be unique`)
    RoleEntityRules.validate(entity, executingUser);
    if(await this.storage.exists(entity.key))
      throw new AlreadyExistsError(`Role with key ${entity.key} already exists. Please change.`)
    return await this.storage.create(entity);
  }

  async delete(id: string | number, executingUser:User): Promise<Role> {
    const usableId = RoleEntityRules.convertId(id);
    if(!usableId || typeof usableId !== 'number')
      throw new Error('Please provide a correct id for delete.')
    return await this.storage.delete(usableId)
  }

  async find(filter: Partial<Role>, executingUser:User): Promise<Role[]> {
    const found = await this.storage.find(filter);
    return found
  }

  async get(id: string | number, executingUser?:User): Promise<Role> {
    if(RoleEntityRules.validateId(id)) {
      const usableId = RoleEntityRules.convertId(id);
      return await this.storage.get(usableId)
    }
    return await this.storage.get(id);
  }

  async update(id: string | number, entityToUpdate: Partial<Role>, executingUser?:User): Promise<Role> {
    const usableId = RoleEntityRules.convertId(id);
    if(!usableId && typeof usableId !== 'number')
      throw new Error('Please provide a correct id for update.');
    const existingRole = await this.get(usableId, executingUser);
    if(entityToUpdate.key && entityToUpdate.key !== existingRole.key){
      RoleEntityRules.validateKey(entityToUpdate.key);
      if(await this.storage.exists(entityToUpdate.key))
        throw new AlreadyExistsError(`The new key ${entityToUpdate.key} is already used. Please change`)
    }
    const updated = {
      ...entityToUpdate,
      ...{
        id:existingRole.id
      }
    }
    if(!updated.key){
      updated.key = existingRole.key;
    }
    return await this.storage.update(updated);
  }

  async addMember(role: Role, user: User, executingUser: User) {
    if(Array.isArray(role.members) &&
      typeof role.id === 'number' &&
      user.id &&
      !(role.members.indexOf(user.id) >= 0) &&
      await this.isDataAuthorized(role, 'w', executingUser)) {
      role.members.push(user.id);
      await this.update(role.id, role, executingUser);
    }
  }

  async removeMember(role: Role, user: User, executingUser: User) {
    if(Array.isArray(role.members) &&
      typeof role.id === 'number' &&
      user.id &&
      (role.members.indexOf(user.id) >= 0) &&
      await this.isDataAuthorized(role, 'w', executingUser)) {
      role.members.splice(role.members.indexOf(user.id),1);
      await this.update(role.id, role, executingUser);
    }
  }

  async isDataAuthorized(data:Role, right:string='r', user?:any):Promise<boolean> {
    if(right === 'w' && user && typeof user.id === 'number'){
      if(data.ownerId === user.id){
        return true;
      } else if(Array.isArray(data.ownerRoles)) {
        for(const roleId of data.ownerRoles){
          const role = await this.get(roleId, user);
          if(await this.roleHasMember(role, user)){
            return true;
          }
        }
      }
    }
    return super.isDataAuthorized(data, right, user);
  }

  public async roleHasMember(role: Role, user: User):Promise<boolean> {
    if(Array.isArray(role.members) && typeof user.id === 'number'){
      return role.members.indexOf(user.id) >= 0;
    }
    return false;
  }
}
