//@ts-ignore
import assert from 'assert';

//@ts-ignore
import chai from 'chai';
chai.use(require('chai-as-promised'));
import {expect} from 'chai';

import app from '../../src/app';
import {Server} from "http";
import {getUrl, initMongoDbTestDatabase} from "../../src/tests/TestsHelpers";
import axios from "axios";
import {v4 as uuid} from "uuid";

const port = app.get('port') || 3030;

describe('Webthumbnail service', () => {

  let server: Server;
  let finalCookie = '';
  let clientUniqueId = uuid();
  let params:any = {
    route:{}
  };

  before(async () => {
    await initMongoDbTestDatabase();
    server = app.listen(port);
    const p = new Promise((resolve => {
      server.once('listening', async () => {
        const authResponse = await axios.request({
          url: getUrl('authentication'),
          method: "POST",
          data: {
            login: "localtest",
            password: "apassword",
            clientUniqueId:clientUniqueId
          }
        })
        for(const cookie of authResponse.headers['set-cookie']) {
          const cookieString = cookie.split(';')[0];
          const cookieName = cookieString.split('=')[0];
          const cookieValue = cookieString.split('=')[1];
          switch(cookieName) {
            case 'ncms-uniqueid': {
              params.clientId = cookieValue
              break;
            }
            case 'ncms-token': {
              params.authenticationToken = cookieValue;
              break;
            }
            default: {
              params[cookieName] = cookieValue;
            }
          }
          finalCookie += `${cookieString}; `
        }
        resolve(undefined);
      });
    }))
    await p;
  })

  beforeEach(async () => {
    await initMongoDbTestDatabase();
  })

  after((done) => {
    server.close(done);
  })

  it('registered the service', () => {
    const service = app.service('webthumbnail');
    assert.ok(service, 'Registered the service');
  });

  it('Should return a thumbnail data for a specific url figaro', async() => {
    const service = app.service('webthumbnail');
    const webThumbnail = await service.get(
      'https://www.lefigaro.fr/actualite-france/2018/12/13/01016-20181213ARTFIG00163-raid-gign-sentinelle-qui-fait-quoi-et-comment-ils-se-coordonnent.php',
      params
    );
    expect(webThumbnail).is.ok;
    expect(webThumbnail).to.be.eql({
      description: "FOCUS - En p??riode d'attentat, plusieurs unit??s d'??lites sont amen??es ?? intervenir. Depuis avril 2016, leur d??ploiement r??pond ?? un ??sch??ma national d'intervention?? qui vise ?? ??viter une ??guerre des polices??.",
      mediaId: 0,
      title: "RAID, GIGN, Sentinelle... qui fait quoi et comment ils se coordonnent",
      url: "https://www.lefigaro.fr/actualite-france/2018/12/13/01016-20181213ARTFIG00163-raid-gign-sentinelle-qui-fait-quoi-et-comment-ils-se-coordonnent.php"
    })
  })


    it('Should return a thumbnail data for a specific url le monde', async() => {
      const service = app.service('webthumbnail');
      const webThumbnail = await service.get(
        'https://www.lemonde.fr/les-decodeurs/article/2015/11/18/raid-gign-bri-qui-fait-quoi_4812824_4355770.html',
        params
      );
      expect(webThumbnail).is.ok;
      expect(webThumbnail).to.be.eql({
        "description": "    Le point sur le fonctionnement et les missions de ces unit??s d?????lite, appel??es ?? intervenir lors des attentats terroristes. ",
        "mediaId": 0,
        "title": "RAID, GIGN, BRI&nbsp;: qui fait quoi&nbsp;?",
        "url": "https://www.lemonde.fr/les-decodeurs/article/2015/11/18/raid-gign-bri-qui-fait-quoi_4812824_4355770.html"
      })
    })

});
