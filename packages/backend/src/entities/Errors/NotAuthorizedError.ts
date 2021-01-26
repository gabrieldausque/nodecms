export class NotAuthorizedError extends Error {
  constructor(message:string = 'Not Authorized Error') {
    super(message);
  }
}
