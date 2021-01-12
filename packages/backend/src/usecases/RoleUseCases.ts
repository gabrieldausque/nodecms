import {UseCases} from "./UseCases";
import {UseCaseConfiguration} from "./UseCaseConfiguration";
import {RoleEntityRules} from "../entities/RoleEntityRules";
import {Role} from "../entities/Role";
import {User} from "../entities/User";
import {AlreadyExistsError} from "../entities/Errors/AlreadyExistsError";

interface RoleUseCasesConfiguration extends UseCaseConfiguration {
}

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

  async create(entity: Role, executingUser:User): Promise<Role> {
    RoleEntityRules.validate(entity);
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
    //TODO : change this to get all role with member in members array ...
    return await this.storage.find(filter);
  }

  async get(id: string | number, executingUser:User): Promise<Role> {
    if(RoleEntityRules.validateId(id)) {
      const usableId = RoleEntityRules.convertId(id);
      return await this.storage.get(usableId)
    }
    return await this.storage.get(id);
  }

  async update(id: string | number, entityToUpdate: Role, executingUser:User): Promise<Role> {
    const usableId = RoleEntityRules.convertId(id);
    if(!usableId || typeof usableId !== 'number')
      throw new Error('Please provide a correct id for update.');
    const existingRole = await this.get(usableId, executingUser);
    if(existingRole.id !== entityToUpdate.id || existingRole.key !== entityToUpdate.key) {
      throw new Error('Only description can be updated');
    }
    RoleEntityRules.validateKey(entityToUpdate.key);
    return await this.storage.update(entityToUpdate);
  }

  async addMember(role: Role, user: User, executingUser: User) {
    if(Array.isArray(role.members) && typeof role.id === 'number' && user.id && !(role.members.indexOf(user.id) >= 0)) {
      role.members.push(user.id);
      await this.update(role.id, role, executingUser);
    }
  }

}
