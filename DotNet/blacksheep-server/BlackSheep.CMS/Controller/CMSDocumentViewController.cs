using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.IO;
using System.Linq;
using System.Reflection;
using System.Text;
using System.Threading.Tasks;
using BlackSheep.CMS.Model;
using BlackSheep.Core.Services;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.ViewEngines;

namespace BlackSheep.CMS.Controller
{
    [Route("/view/document")]
    public class CMSDocumentViewController : Microsoft.AspNetCore.Mvc.Controller
    {

        private readonly CRUDService<CMSDocument, CMSDocumentFilter> _model;


        public CMSDocumentViewController(CRUDService<CMSDocument, CMSDocumentFilter> model)
        {
            _model = model;
        }

        [HttpGet]
        [Route("{documentId:int}")]
        public ViewResult GetDocumentView(int documentId)
        {
            var document = _model.Get(documentId);

            return View("DocumentView", document);
        }
    }
}
