using BlackSheep.Core.Infrastructure;
using BlackSheep.Core.MVC;
using BlackSheep.Playground.Controllers;
using BlackSheep.Playground.Data;
using Microsoft.Extensions.DependencyInjection;

namespace BlackSheep.Playground
{
    [ConfigureServices]
    public static class ServicesCollectionExtension
    {
        [ConfigureServices]
        public static IServiceCollection ConfigureServices(this IServiceCollection services)
        {
            services.AddBlackSheepControllerServices<Scene,
                SceneFilter,
                SceneRules>("BlackSheepPlayground:Databases:Scenes");
            services.AddBlackSheepControllerServices<Game,
                GameFilter,
                GameRules>("BlackSheepPlayground:Databases:Games");
            services.AddBlackSheepControllerServices<GameInstance, 
                GameInstanceFilter,
                GameInstanceRules>("BlackSheepPlayground:Databases:GameInstances");
            return services;
        }
    }
}
