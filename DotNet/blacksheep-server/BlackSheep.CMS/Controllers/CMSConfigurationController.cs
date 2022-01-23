using System.Collections;
using System.Collections.Generic;
using System.Net;
using System.Threading.Tasks;
using BlackSheep.CMS.Models;
using BlackSheep.CMS.Rules;
using BlackSheep.Core;
using BlackSheep.Core.Exceptions;
using BlackSheep.Core.MVC;
using BlackSheep.Core.MVC.Models;
using BlackSheep.Core.Services;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.ModelBinding;
using Microsoft.Extensions.Configuration;

namespace BlackSheep.CMS.Controllers
{
    [ApiController]
    [Route("api/configuration")]
    public class ConfigurationController : BlackSheepBaseController<CMSConfiguration, CMSConfigurationFilter>
    {
        public ConfigurationController(CRUDService<CMSConfiguration, CMSConfigurationFilter> model,
            BlackSheepEntityRules<CMSConfiguration, CMSConfigurationFilter> rules,
            IConfigurationRoot configuration):base(model, rules, configuration,"api/configuration")
        {
        }
    }
}
