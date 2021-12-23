using System.Linq;
using BlackSheep.CMS.Models;
using BlackSheep.Core.Services;
using Microsoft.AspNetCore.Mvc;

namespace BlackSheep.CMS.Controllers
{

    // ReSharper disable once InconsistentNaming
    public class CMSDocumentController : Microsoft.AspNetCore.Mvc.Controller
    {

        private readonly CRUDService<CMSDocument, CMSDocumentFilter> _model;

        public CMSDocumentController(CRUDService<CMSDocument, CMSDocumentFilter> model)
        {
            _model = model;
        }

        [HttpGet]
        [Route("api/document/{id:int}")]
        public ActionResult<CMSDocument> GetDocument([FromRoute] int id)
        {
            var document = _model.Get(id);
            if (document != null)
                return Ok(document);
            return NotFound();
        }

        [HttpGet]
        [Route("api/document/{key:alpha}")]
        public ActionResult<CMSDocument> GetDocument([FromRoute] string key)
        {
            var document = _model.Get(key);
            if (document != null)
                return Ok(document);
            return NotFound();
        }

        [HttpGet]
        [Route("api/document")]
        public ActionResult<CMSDocument[]> FindDocument([FromQuery] CMSDocumentFilter filter)
        {
            if (filter != null)
            {
                var found = _model.Find(filter);
                if(found.Any())
                    return Ok(found);
            }
            return Ok(new CMSDocument[]{});
        }
    }
}