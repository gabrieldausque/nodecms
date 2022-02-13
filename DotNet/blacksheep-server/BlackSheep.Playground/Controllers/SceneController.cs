using BlackSheep.Core.MVC;
using BlackSheep.Core.MVC.Models;
using BlackSheep.Core.Services;
using BlackSheep.Playground.Data;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Configuration;

namespace BlackSheep.Playground.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class SceneController : BlackSheepBaseController<Scene, SceneFilter>
    {
        public SceneController(CRUDService<Scene, SceneFilter> model, 
            BlackSheepEntityRules<Scene, SceneFilter> rules, 
            IConfigurationRoot configuration) : base(model, rules, configuration, "api/scene")
        {
        }
    }
}
