export class AlreadyExistsError extends Error {

  constructor(message:string = 'Entity already exists') {
    super(message);
  }

}
