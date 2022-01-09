﻿using System;
using BlackSheep.CMS.Models;
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
            var cmsConfigurationDbServiceIdentifier =
                Startup.Configuration.GetSection("BlackSheepCMS:Databases:Configurations:ProviderName");
            var cmsConfigurationDbService =
                ServicesFactory.Instance.GetServiceInstance<
                    CRUDService<CMSConfiguration, CMSConfigurationFilter>, 
                    CMSConfiguration, 
                    CMSConfigurationFilter>(
                    cmsConfigurationDbServiceIdentifier.Value);
            cmsConfigurationDbService.Init(
                Startup.Configuration.GetSection("BlackSheepCMS:Databases:Configurations"));
            services.Add(new ServiceDescriptor(
                typeof(CRUDService<CMSConfiguration, CMSConfigurationFilter>), 
                cmsConfigurationDbService)
            );

            var documentDbServiceIdentifier = Startup.Configuration.GetSection("BlackSheepCMS:Databases:Documents:ProviderName");
            var documentDbService =
                ServicesFactory.Instance.GetServiceInstance<
                    CRUDService<CMSDocument, CMSDocumentFilter>, 
                    CMSDocument, 
                    CMSDocumentFilter>(documentDbServiceIdentifier.Value);
            var documentDbServiceConfiguration = Startup.Configuration.GetSection("BlackSheepCMS:Databases:Documents");
            documentDbService.Init(documentDbServiceConfiguration);
            services.Add(new ServiceDescriptor(typeof(CRUDService<CMSDocument, CMSDocumentFilter>), documentDbService));
            
            return services;
        }
    }
}