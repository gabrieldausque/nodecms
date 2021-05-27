import {WebThumbnail} from "@nodecms/backend-dataWebThumbnail";
import {NotImplementedError} from "@nodecms/backend-dataErrors/NotImplementedError";
import {JSDOM} from 'jsdom';
import axios from 'axios';
import html = Mocha.reporters.html;
import {MediaUseCases} from "./MediaUseCases";
import {globalInstancesFactory} from "@hermes/composition";
import {v4} from 'uuid';
import {MediaVisibility} from "@nodecms/backend-dataMedia";
import {User} from "@nodecms/backend-dataUser";

export class WebThumbnailUseCase {

  public static metadata:any[] = [
    {
      contractType:'UseCases',
      contractName:'WebThumbnail',
      isShared:true
    }
  ]

  static readonly regexpUrl:RegExp = /^(https*?:\/\/[^\s]+)$/g

  private sanitizeHtml(htmlString:string){
    return htmlString.replace(/(<([^>]+)>)/g, '');
  }

  async get(URL:string, executingUser:User):Promise<Partial<WebThumbnail>>{
      const result = URL.match(WebThumbnailUseCase.regexpUrl);
      if(!result){
        throw new  Error(`${URL} is not a correct url`);
      }
      let htmlFromUrl = null;
      try{
        htmlFromUrl = (await axios.get(URL, {
          headers: { 'User-Agent': 'Mozilla/5.0' }
        })).data
      }catch(error){
        console.error(error);
        throw new Error(error.response.message)
      }

      const dom = new JSDOM(htmlFromUrl);
      const doc = dom.window.document;
      const title = doc.querySelector('h1');

      if(!title)
        throw new Error('No title on url');

      const description = doc.querySelector('h1 + p')

      if(!description)
        throw new Error('No description on url');

      const firstImage = doc.querySelector('article img');

      if(!firstImage)
        throw new Error('No first image');

      let imageUrl = firstImage.getAttribute('src');

      if(!imageUrl){
        const imageSrcSet = firstImage.getAttribute('data-srcset');
        if(imageSrcSet) {
          const imagesSrc = imageSrcSet.split(' ');
          imageUrl = imagesSrc[0];
        }
      }

      if(!imageUrl)
        throw new Error('Image has no url');

      const imageBlob = (await axios.get(imageUrl, {
        responseType: 'arraybuffer'
      })).data;
      const mediaUseCases:MediaUseCases = globalInstancesFactory.getInstanceFromCatalogs('UseCases','Media');
      const createdMedia = await mediaUseCases.create({
        blob: imageBlob,
        key: v4(),
        visibility: MediaVisibility.protected
      }, executingUser);
      return {
        title: this.sanitizeHtml(title.innerHTML),
        description: this.sanitizeHtml(description.innerHTML),
        mediaId:typeof createdMedia.id === 'number'?createdMedia.id:undefined,
        url: URL
      }
  }
}
