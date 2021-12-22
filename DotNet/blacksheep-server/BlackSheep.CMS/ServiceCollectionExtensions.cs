using System;
using BlackSheep.CMS.Model;
using BlackSheep.Core.Host;
using BlackSheep.Core.Infrastructure;
using BlackSheep.Core.Services;
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
            //TODO : regroup configurations under BlackSheepCMS:Databases
            var documentDbServiceIdentifier = Startup.Configuration.GetSection("BlackSheepCMS:Databases:Documents:ProviderName");
            var documentDbService =
                ServicesFactory.Instance.GetServiceInstance<CRUDService<CMSDocument, CMSDocumentFilter>, CMSDocument, CMSDocumentFilter>(documentDbServiceIdentifier.Value);
            var documentDbServiceConfiguration = Startup.Configuration.GetSection("BlackSheepCMS:Databases:Documents");
            documentDbService.Init(documentDbServiceConfiguration);
            services.Add(new ServiceDescriptor(typeof(CRUDService<CMSDocument, CMSDocumentFilter>), documentDbService));
            return services;
        }
    }
}