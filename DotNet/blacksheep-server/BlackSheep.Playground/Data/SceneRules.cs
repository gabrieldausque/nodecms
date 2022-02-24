using BlackSheep.Core.MVC.Models;
using BlackSheep.Core.Services;

namespace BlackSheep.Playground.Data;

public class SceneRules : BlackSheepEntityRules<Scene, SceneFilter>
{
    public SceneRules(CRUDService<Scene, SceneFilter> model) : base(model)
    {
    }
}