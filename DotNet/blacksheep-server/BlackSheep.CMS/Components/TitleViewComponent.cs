using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;

namespace BlackSheep.CMS.Components
{
    [ViewComponent(Name = "title")]
    public class TitleViewComponent : ViewComponent
    {
        public async Task<IViewComponentResult> InvokeAsync()
        {
            return View("Title");
        }

    }
}
