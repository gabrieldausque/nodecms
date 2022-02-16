using System.Threading.Tasks;
using BlackSheep.CMS.Models;
using Microsoft.AspNetCore.Mvc;

namespace BlackSheep.CMS.Components
{
    [ViewComponent(Name = "BlocEditorMenu")]
    public class BlocEditorMenuComponent : ViewComponent
    { 
        public async Task<IViewComponentResult> InvokeAsync(CMSDocumentBlocMetadata bloc)
        {
            return View("BlocEditorMenu", bloc);
        }
    }
}
