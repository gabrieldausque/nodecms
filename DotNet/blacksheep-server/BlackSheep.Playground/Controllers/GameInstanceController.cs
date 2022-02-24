using System.Security.Principal;
using BlackSheep.Core.MVC;
using BlackSheep.Core.MVC.Models;
using BlackSheep.Core.Services;
using BlackSheep.Playground.Data;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Configuration;

namespace BlackSheep.Playground.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class GameInstanceController : 
        BlackSheepBaseController<GameInstance, GameInstanceFilter>
    {
        public GameInstanceController(CRUDService<GameInstance, GameInstanceFilter> model,
            BlackSheepEntityRules<GameInstance, GameInstanceFilter> rules, 
            IConfigurationRoot configuration)
            :base(model, rules, configuration, "api/gameinstance")
        {
        }
    }
}
