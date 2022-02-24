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
    public class GameController : BlackSheepBaseController<Game, 
        GameFilter>
    {
        public GameController(CRUDService<Game, GameFilter> model, 
            BlackSheepEntityRules<Game, GameFilter> rules, 
            IConfigurationRoot configuration) : base(model, rules, configuration, "api/game")
        {
        }
    }
}
