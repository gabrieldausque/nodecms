using BlackSheep.Core.Infrastructure;
using BlackSheep.Core.MVC;
using BlackSheep.Core.MVC.Models;
using BlackSheep.Core.Services;
using BlackSheep.Playground.Controllers;

namespace BlackSheep.Playground
{
    public static class ServicesCollectionExtension
    {
        [ConfigureServices]
        public static IServiceCollection ConfigureServices(this IServiceCollection services)
        {
            services.AddBlackSheepControllerServices<Scene,
                SceneFilter,
                SceneRules>("BlackSheepPlayground:Databases:Configurations");

            return services;
        }
    }

    public class SceneRules : BlackSheepEntityRules<Scene, SceneFilter>
    {
        public SceneRules(CRUDService<Scene, SceneFilter> model) : base(model)
        {
        }
    }
}
