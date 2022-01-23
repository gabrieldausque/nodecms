using System.Linq;
using BlackSheep.CMS.Models;
using BlackSheep.Core.MVC;
using BlackSheep.Core.MVC.Models;
using BlackSheep.Core.Services;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Configuration;

namespace BlackSheep.CMS.Controllers
{

    // ReSharper disable once InconsistentNaming
    [ApiController]
    [Route("api/document")]
    public class CMSDocumentController : BlackSheepBaseController<CMSDocument, CMSDocumentFilter>
    {
        public CMSDocumentController(CRUDService<CMSDocument, CMSDocumentFilter> model, 
            BlackSheepEntityRules<CMSDocument, CMSDocumentFilter> rules,
            IConfigurationRoot configuration):
            base(model,rules, configuration, "api/document")
        {
        }
    }
}