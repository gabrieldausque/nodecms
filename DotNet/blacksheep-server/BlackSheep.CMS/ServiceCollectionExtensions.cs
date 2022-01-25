using BlackSheep.CMS.Models;
using BlackSheep.CMS.Rules;
using BlackSheep.Core.Host;
using BlackSheep.Core.Infrastructure;
using BlackSheep.Core.MVC;
using BlackSheep.Core.MVC.Models;
using BlackSheep.Core.Services;
using Microsoft.Extensions.Configuration;
using Microsoft.Extensions.DependencyInjection;
using Microsoft.Extensions.Options;

namespace BlackSheep.CMS
{
    [ConfigureServices]
    public static class ServiceCollectionExtensions
    {
        [ConfigureServices]
        public static IServiceCollection ConfigureServices(this IServiceCollection services)
        {
            services.AddBlackSheepControllerServices<CMSConfiguration, 
                CMSConfigurationFilter, 
                CMSConfigurationRules>("BlackSheepCMS:Databases:Configurations");
            services.AddBlackSheepControllerServices<CMSDocument, 
                CMSDocumentFilter, 
                CMSDocumentRules>("BlackSheepCMS:Databases:Documents");

            return services;
        }

    }
}