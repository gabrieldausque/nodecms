using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using Microsoft.Extensions.DependencyInjection;

namespace Sample
{
    public static class ServiceCollectionExtensions
    {
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
