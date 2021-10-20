﻿using System;
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
            var documentDbServiceIdentifier = Startup.Configuration.GetSection("Databases:Documents:ProviderName");
            var documentDbService =
                ServicesFactory.Instance.GetServiceInstance<CRUDService<CMSDocument>, CMSDocument>(documentDbServiceIdentifier.Value);
            var documentDbServiceConfiguration = Startup.Configuration.GetSection("Databases:Documents");
            documentDbService.Init(documentDbServiceConfiguration);
            services.Add(new ServiceDescriptor(typeof(CRUDService<CMSDocument>), documentDbService));
            return services;
        }
    }
}