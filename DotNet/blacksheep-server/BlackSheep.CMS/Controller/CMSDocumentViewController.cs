using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.IO;
using System.Linq;
using System.Reflection;
using System.Text;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.ViewEngines;

namespace BlackSheep.CMS.Controller
{
    public class CMSDocumentViewController : Microsoft.AspNetCore.Mvc.Controller
    {
        [HttpGet]
        [Route("/document")]
        public ViewResult GetDocumentView()
        {
            return View();
        }
    }
}
