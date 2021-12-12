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
        protected readonly string MainConfigurationSectionName = "BlackSheepServer";

        public static IConfigurationRoot Configuration { get; set; }

        public Startup(IWebHostEnvironment env)
        {
            AppDomain.CurrentDomain.AssemblyResolve += CurrentDomain_AssemblyResolve;
            var builder = new ConfigurationBuilder()
                .SetBasePath(env.ContentRootPath)
                .AddJsonFile("appsettings.json",optional:true, reloadOnChange: true);
            Configuration = builder.Build();
        }

        /// <summary>
        /// resolve dependencies under catalog ...
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="args"></param>
        /// <returns></returns>
        private Assembly CurrentDomain_AssemblyResolve(object sender, ResolveEventArgs args)
        {
            try
            {
                var callingPath = Path.GetDirectoryName(args.RequestingAssembly.Location);
                var assemblyToLoad = Path.Combine(callingPath, $"{args.Name.Split(',')[0]}.dll");
                if(File.Exists(assemblyToLoad))
                    return Assembly.LoadFile(assemblyToLoad);
            }
            catch (Exception e)
            {
                Console.WriteLine(e);
            }
            return null;
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
            var pluginsToLoad = Configuration.GetSection($"{MainConfigurationSectionName}:Plugins").Get<string[]>();
            //dynamic injection of services
            var pluginAssemblyNames = new List<string>(Directory.EnumerateFiles(Path.Combine(
                Path.GetDirectoryName(Assembly.GetEntryAssembly().Location), "Catalog"), "*.dll", SearchOption.AllDirectories));
            var pluginAssemblies = new List<Assembly>();
            pluginAssemblyNames.ForEach(n =>
            {
                if (pluginsToLoad.Contains(Path.GetFileNameWithoutExtension(n)) &&
                    pluginAssemblies.All(a => a.GetName().Name != Path.GetFileNameWithoutExtension(n)))
                {
                    var assembly = Assembly.LoadFile(n);
                    pluginAssemblies.Add(assembly);
                    servicesBuilder.AddApplicationPart(assembly);
                }
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