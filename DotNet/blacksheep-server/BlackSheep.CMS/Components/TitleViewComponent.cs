using System;
using System.Collections.Generic;
using System.Linq;
using System.Security.Cryptography.X509Certificates;
using System.Text;
using System.Threading.Tasks;
using BlackSheep.CMS.Models;
using Microsoft.AspNetCore.Mvc;

namespace BlackSheep.CMS.Components
{
    [ViewComponent(Name = "Title")]
    public class TitleViewComponent : ViewComponent
    {
        public async Task<IViewComponentResult> InvokeAsync(CMSDocumentBlocMetadata component)
        {
            return await Task.Run<IViewComponentResult>(() => View("Title", component));
        }

    }
}
