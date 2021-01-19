import {WebThumbnail} from "../entities/WebThumbnail";
import {NotImplementedError} from "../entities/Errors/NotImplementedError";

export class WebThumbnailUseCase {

  public static metadata:any[] = [
    {
      contractType:'UseCases',
      contractName:'WebThumbnail',
      isShared:true
    }
  ]

  async createWebSiteThumbnail(URL:string):Promise<WebThumbnail>{
      throw new NotImplementedError();
  }
}
