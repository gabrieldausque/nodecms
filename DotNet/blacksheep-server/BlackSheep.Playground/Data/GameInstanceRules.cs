using BlackSheep.Core.MVC.Models;
using BlackSheep.Core.Services;

namespace BlackSheep.Playground.Data;

public class GameInstanceRules :
    BlackSheepEntityRules<GameInstance, GameInstanceFilter>
{
    public GameInstanceRules(CRUDService<GameInstance, GameInstanceFilter> model) : base(model)
    {
    }
}