export interface ViewPlugin {
  getView(viewName:string, context:any):string;
}
