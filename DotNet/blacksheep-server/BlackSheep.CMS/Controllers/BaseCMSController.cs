using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Configuration;

namespace BlackSheep.CMS.Controllers
{
    public abstract class BaseCMSController : Controller
    {
        protected IConfigurationRoot Configuration { get; }

        public BaseCMSController(IConfigurationRoot configuration)
        {
            Configuration = configuration;
        }
    }
}
