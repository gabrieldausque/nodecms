using System.Threading.Tasks;
using BlackSheep.CMS.Models;
using Microsoft.AspNetCore.Mvc;

namespace BlackSheep.CMS.Components
{
    [ViewComponent(Name = "BlocEditor")]
    public class BlocEditorComponent : ViewComponent
    {

        public async Task<IViewComponentResult> InvokeAsync(CMSDocumentBlocMetadata bloc)
        {
            return View("BlocEditor");
        }



    }
}
