import {EntityRules} from "./EntityRules";
import {User} from "@nodecms/backend-data";
import {Document, DocumentVisibility} from "@nodecms/backend-data"
import {isNumber} from "@nodecms/backend-data";

export class DocumentRules extends EntityRules<Document> {
  static validate(document:Partial<Document>, executingUser?:User):void{

    if(!executingUser || !isNumber(executingUser.id))
      throw new Error('Document must be validated with a valid user');

    if(!document.key)
      throw new Error('Document must have a valid key');


    if(executingUser && (executingUser.id || executingUser.id === 0))
    {
      let usableId = parseInt(executingUser.id.toString())
      document.ownerId = usableId;
    }

    DocumentRules.validateForRead(document);
  }

  static validateForRead(document:Partial<Document>) {
    if(!document.visibility)
      document.visibility = DocumentVisibility.private;

    if(!Array.isArray(document.editorRoles))
      document.editorRoles = [];

    if(!Array.isArray(document.editors))
      document.editors = [];

    if(!Array.isArray(document.readerRoles))
      document.readerRoles = [];

    if(!Array.isArray(document.readers))
      document.readers = [];

    if(!document.documentType)
      document.documentType = 'default';
  }
}
