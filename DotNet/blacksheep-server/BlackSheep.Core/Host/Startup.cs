using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Net.WebSockets;
using System.Reflection;
using BlackSheep.Core.Infrastructure;
using Microsoft.AspNetCore.Builder;
using Microsoft.AspNetCore.Hosting;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc.Razor;
using Microsoft.CodeAnalysis;
using Microsoft.Extensions.Configuration;
using Microsoft.Extensions.DependencyInjection;

namespace BlackSheep.Core.Host
{
    public class Startup
    {
        public static IConfigurationRoot Configuration { get; set; }

        public Startup(IWebHostEnvironment env)
        {
            var builder = new ConfigurationBuilder()
                .SetBasePath(env.ContentRootPath)
                .AddJsonFile("appsettings.json",optional:true, reloadOnChange: true);
            Configuration = builder.Build();
        }
        
        public virtual void Configure(IApplicationBuilder builder)
        {
            builder.UseStaticFiles();
            builder.UseDeveloperExceptionPage();
            builder.UseRouting();
            builder.UseEndpoints(endpoints =>
            {
                endpoints.MapControllers();
            });
        }

        public virtual void ConfigureServices(IServiceCollection services)
        {
            services.AddOptions();
            var servicesBuilder = services.AddMvc();
            //dynamic injection of services
            var pluginAssemblyNames = new List<string>(Directory.EnumerateFiles(Path.Combine(
                Path.GetDirectoryName(Assembly.GetEntryAssembly().Location), "Catalog")));
            var pluginAssemblies = new List<Assembly>();
            pluginAssemblyNames.ForEach(n =>
            {
                var assembly = Assembly.LoadFile(n);
                pluginAssemblies.Add(assembly);
                servicesBuilder.AddApplicationPart(assembly);
            });
            //Register all services classes first
            pluginAssemblies.ForEach(assembly =>
            {
                var registerServicesClasses = assembly.GetTypes().Where(t =>
                    t.GetCustomAttributes<RegisterServiceTypeAttribute>().Any());
                
                foreach (var registerServicesClass in registerServicesClasses)
                {
                    var registerServicesMethods = registerServicesClass.GetMethods(BindingFlags.Public |
                        BindingFlags.Static).Where(m => m.GetCustomAttributes<RegisterServiceTypeAttribute>().Any());
                    foreach (var registerServiceMethod in registerServicesMethods)
                    {
                        registerServiceMethod.Invoke(null, new object[]{});
                    }   
                }
            });
            //Then inject all services in aspnet core DI engine
            pluginAssemblies.ForEach(assembly =>
            {
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
            });
            // Now Add all controllers
            services.AddControllersWithViews()
                .AddJsonOptions(opts => opts.JsonSerializerOptions.PropertyNamingPolicy = null);
        }
    }
}