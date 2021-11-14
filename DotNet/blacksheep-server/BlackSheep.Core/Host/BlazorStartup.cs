using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Reflection;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Builder;
using Microsoft.AspNetCore.Hosting;
using Microsoft.AspNetCore.Http;
using Microsoft.Extensions.DependencyInjection;

namespace BlackSheep.Core.Host
{
    public class BlazorStartup : Startup
    {
        public BlazorStartup(IWebHostEnvironment env)
            : base(env)
        {
        }

        public override void Configure(IApplicationBuilder builder)
        {
            builder.UseDeveloperExceptionPage();
            builder.UseWebAssemblyDebugging();
            builder.UseBlazorFrameworkFiles();
            builder.UseStaticFiles();
            builder.UseRouting();
            builder.UseEndpoints(endpoints =>
            {
                endpoints.MapRazorPages();
                endpoints.MapControllers();
                endpoints.MapFallbackToFile("index.html");
            });
        }

        public override void ConfigureServices(IServiceCollection services)
        {
            base.ConfigureServices(services);
            //Add razor app assembly
            services.AddRazorPages();
        }
    }
    
}
