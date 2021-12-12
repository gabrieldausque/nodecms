using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using BlackSheep.Core.Infrastructure;
using Microsoft.Extensions.DependencyInjection;
using Sample.Dep;

namespace Sample
{
    [ConfigureServices]
    public static class ServiceCollectionExtensions
    {
        [ConfigureServices]
        public static IServiceCollection AddSampleServices(this IServiceCollection services)
        {
            services.Add(new ServiceDescriptor(
                typeof(ISampleService),
                typeof(SampleService),
                ServiceLifetime.Singleton
            ));
            return services;
        }
    }
}
