using System;
using System.Collections.Generic;
using System.Linq;
using System.Security.Cryptography.X509Certificates;
using System.Text;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;

namespace BlackSheep.CMS.Components
{
    [ViewComponent(Name = "title")]
    public class TitleViewComponent : ViewComponent
    {
        public async Task<IViewComponentResult> InvokeAsync(bool isEditMode = false)
        {
            var layout = isEditMode ? "TitleEdit" : "Title";
            return await Task.Run(() => View(layout));
        }

    }
}
