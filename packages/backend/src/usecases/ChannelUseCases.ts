import {UseCases} from "./UseCases";
import {Channel} from "../entities/Channel";
import {User} from "../entities/User";
import {isNumber} from "../helpers";
import {UseCaseConfiguration} from "./UseCaseConfiguration";

interface ChannelUseCasesConfiguration extends UseCaseConfiguration {};

export class ChannelUseCases extends UseCases<Channel> {

  public static metadata:any[] = [
    {
      contractType:'UseCases',
      contractName:'Channel',
      isShared:true
    }
  ]

  constructor(configuration:ChannelUseCasesConfiguration) {
    super('channel', 'ChannelStorage', configuration);
  }

  async create(entity: Channel, executingUser: User): Promise<Channel> {
    throw new Error('not implemented');
  }

  async delete(id: string | number, executingUser: User): Promise<Channel> {
    throw new Error('not implemented');
  }

  async find(filter: Channel, executingUser: User | undefined): Promise<Channel[]> {
    throw new Error('not implemented');
  }

  async get(id: string | number, executingUser: User | undefined): Promise<Channel> {
    throw new Error('not implemented');
  }

  async update(id: string | number, entityToUpdate: Channel, executingUser: User): Promise<Channel> {
    throw new Error('not implemented');
  }

  async isUserMemberOf(channel:Channel, user:User, executingUser:User):Promise<boolean>{
    if(user &&
      typeof user.id === 'number' &&
      isNumber(user.id)){
      const usableId:number = parseInt(user.id.toString())
      return channel.readers.indexOf(user.id) >= 0 ||
      channel.contributors.indexOf(user.id) >= 0 ||
      channel.editors.indexOf(user.id) >= 0 ||
      channel.administrators.indexOf(user.id) >= 0;
    }
    return false
  }

}
