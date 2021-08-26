export class NotImplementedError extends Error {
  constructor(message:string = 'Method is not implemented') {
    super(message);
  }
}
