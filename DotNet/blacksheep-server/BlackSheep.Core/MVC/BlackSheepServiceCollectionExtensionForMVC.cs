using System;
using System.Reflection;
using BlackSheep.Core.Host;
using BlackSheep.Core.Infrastructure;
using BlackSheep.Core.MVC.Models;
using BlackSheep.Core.Services;
using Microsoft.Extensions.DependencyInjection;

namespace BlackSheep.Core.MVC;

public static class BlackSheepServiceCollectionExtensionForMVC
{

    public static void AddBlackSheepControllerServices<TEntity, TEntityFilter, TEntityRules>(
        this IServiceCollection services,
        string entityConfigurationSectionName
    ) where TEntity: class, IBlackSheepEntity
        where TEntityRules: BlackSheepEntityRules<TEntity,TEntityFilter>
    {
        var dbServiceIdentifier =
            Startup.Configuration.GetSection($"{entityConfigurationSectionName}:ProviderName");
        var dbService =
            ServicesFactory.Instance.GetServiceInstance<
                CRUDService<TEntity, TEntityFilter>,
                TEntity,
                TEntityFilter>(dbServiceIdentifier.Value);
        var dbServiceConfiguration = Startup.Configuration.GetSection(entityConfigurationSectionName);
        dbService.Init(dbServiceConfiguration);
        services.Add(new ServiceDescriptor(typeof(CRUDService<TEntity, TEntityFilter>), dbService));
        services.AddSingleton<BlackSheepEntityRules<TEntity, TEntityFilter>>(provider =>
        {
            var model = provider.GetService<CRUDService<TEntity, TEntityFilter>>();
            var rulesType = typeof(TEntityRules);
            var ctorWithModel = rulesType.GetConstructor(
                new[] { typeof(CRUDService<TEntity, TEntityFilter>) });
            if (ctorWithModel == null)
            {
                throw new ApplicationException(
                    $"Type {nameof(TEntityRules)} must implement constructor with a model of type {nameof(CRUDService<TEntity, TEntityFilter>)}");
            }

            if (ctorWithModel.Invoke( new object[] { model }) is not TEntityRules rules)
                throw new ApplicationException($"Unable to create rules of type {nameof(TEntityRules)}");
                
            return rules;
        });
    }

}