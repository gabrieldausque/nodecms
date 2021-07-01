export interface Entity {
  id?: number,
  isReader?: boolean,
  isEditor?: boolean,
  [key: string]: any
}
