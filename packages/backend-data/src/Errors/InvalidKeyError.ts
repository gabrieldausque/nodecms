export class InvalidKeyError extends Error {

  constructor(message:string = 'Key is invalid') {
    super(message);
  }

}
