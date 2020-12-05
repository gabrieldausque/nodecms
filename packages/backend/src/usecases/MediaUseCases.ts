import {UseCases} from "./UseCases";
import {Media} from "../entities/Media";
import {User} from "../entities/User";

export class MediaUseCases extends UseCases<Media> {
  async create(entity: Partial<Media>, executingUser: User): Promise<Media> {
    throw new Error('Not Implemented');
  }

  async delete(id: string | number, executingUser: User): Promise<Media> {
    throw new Error('Not Implemented');
  }

  async find(filter: Partial<Media>, executingUser: User | undefined): Promise<Media[]> {
    throw new Error('Not Implemented');
  }

  async get(id: string | number, executingUser: User | undefined): Promise<Media> {
    throw new Error('Not Implemented');
  }

  async update(id: string | number, entityToUpdate: Media, executingUser: User): Promise<Media> {
    throw new Error('Not Implemented');
  }

}
