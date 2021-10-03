using System;
using System.IO;
using System.Linq;
using System.Reflection;
using BlackSheep.Core.Infrastructure;
using Microsoft.AspNetCore.Builder;
using Microsoft.AspNetCore.Http;
using Microsoft.Extensions.DependencyInjection;

namespace BlackSheep.Core.Host
{
    public class Startup
    {
        public void Configure(IApplicationBuilder builder)
        {
            
            builder.UseWebSockets();
            builder.UseStaticFiles();
            builder.UseDeveloperExceptionPage();
            builder.Use((context, next) =>
            {
                return next();
            });
            builder.UseRouting();
            builder.UseEndpoints(endpoints =>
            {
                endpoints.MapControllers();
                //TODO : add signalR hubs using dependencies injection
            });
            //TODO : specify a configuration to use authentication or not
            builder.UseAuthentication();
            builder.Run((context) => context.Response.WriteAsync("Hello World !"));
        }

        public void ConfigureServices(IServiceCollection services)
        {
            //TODO add configuration to specify usage of signal R;
            services.AddSignalR();
            var servicesBuilder = services.AddMvc();
            foreach (var catalog in Directory.EnumerateFiles(Path.Combine(
                Path.GetDirectoryName(Assembly.GetEntryAssembly().Location), "Catalog")))
            {
                var assembly = Assembly.LoadFile(catalog);
                servicesBuilder.AddApplicationPart(assembly);
                var configureServicesClasses = assembly.GetTypes().Where(t =>
                    t.GetCustomAttributes<ConfigureServicesAttribute>().Any());
                foreach (var configureServicesClass in configureServicesClasses)
                {
                    var configureServicesMethods = configureServicesClass.GetMethods(BindingFlags.Public |
                        BindingFlags.Static).Where(m => m.GetCustomAttributes<ConfigureServicesAttribute>().Any());
                    foreach (var configureServiceMethod in configureServicesMethods)
                    {
                        configureServiceMethod.Invoke(null, new object[]
                        {
                            services
                        });
                    }
                }
            }
            services.AddControllers();
            services.AddAuthentication(options =>
            {

            });
        }
    }
}