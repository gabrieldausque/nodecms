using BlackSheep.Core.MVC;
using BlackSheep.Core.MVC.Models;
using BlackSheep.Core.Services;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Configuration;

namespace BlackSheep.Playground.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class ScenesController : BlackSheepBaseController<Scene, SceneFilter>
    {
        public ScenesController(CRUDService<Scene, SceneFilter> model, 
            BlackSheepEntityRules<Scene, SceneFilter> rules, 
            IConfigurationRoot configuration, string route) : base(model, rules, configuration, route)
        {
        }
    }

    public class SceneFilter 
    {
    }

    public class Scene : IBlackSheepEntity
    {
        public int Id { get; set; }
        public string Key { get; set; }
    }
}
