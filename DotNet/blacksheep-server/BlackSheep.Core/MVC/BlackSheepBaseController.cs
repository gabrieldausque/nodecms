using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Configuration;

namespace BlackSheep.Core.MVC
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
