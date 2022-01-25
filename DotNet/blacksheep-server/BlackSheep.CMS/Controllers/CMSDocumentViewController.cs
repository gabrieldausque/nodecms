using BlackSheep.CMS.Models;
using BlackSheep.Core;
using BlackSheep.Core.MVC;
using BlackSheep.Core.Services;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Configuration;

namespace BlackSheep.CMS.Controllers
{
    [Route("/view/document")]
    public class CMSDocumentViewController : Controller
    {

        private readonly CRUDService<CMSDocument, CMSDocumentFilter> _model;
        
        private readonly CRUDService<CMSConfiguration, CMSConfigurationFilter> _globalConfigurationModel;

        public CMSDocumentViewController(CRUDService<CMSDocument, CMSDocumentFilter> model,
            CRUDService<CMSConfiguration, CMSConfigurationFilter> globalConfigurationModel,
            IConfigurationRoot configuration)
        {
            Configuration = configuration;
            _model = model;
            _globalConfigurationModel = globalConfigurationModel;
        }

        public IConfigurationRoot Configuration { get; set; }

        [HttpGet]
        [Route("{documentId:int}")]
        public ViewResult Get(int documentId)
        {
            var document = _model.Get(documentId);
            var applicationTitle = 
            ViewData["ApplicationTitle"] = Configuration.GetSection("BlackSheepCMS:Application:Title").Value;
            return View("DocumentView", document);
        }

        [HttpGet]
        [Route("{documentId:int}/edit")]
        public ViewResult Edit(int documentId)
        {
            var document = _model.Get(documentId);

            return View("DocumentEdit", document);
        }
    }
}
