using BlackSheep.Core.MVC.Models;
using BlackSheep.Core.Services;

namespace BlackSheep.Playground.Data
{
    public class GameRules : BlackSheepEntityRules<Game, GameFilter>
    {
        public GameRules(CRUDService<Game, GameFilter> model) : base(model)
        {
        }
    }
}
