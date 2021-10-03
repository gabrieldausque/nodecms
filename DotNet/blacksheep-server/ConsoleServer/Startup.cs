using System;
using System.Reflection;
using Microsoft.AspNetCore.Builder;
using Microsoft.AspNetCore.Http;
using Microsoft.Extensions.DependencyInjection;
using Sample;

namespace ConsoleServer
{
    public class Startup
    {
        public void Configure(IApplicationBuilder builder)
        {
            
            builder.UseWebSockets();
            builder.UseStaticFiles();
            builder.UseRouting();
            builder.UseEndpoints(endpoints =>
            {
                endpoints.MapControllers();
                //TODO : add signalR hubs
            });
            builder.UseAuthentication();
            builder.Use((context, next) =>
            {
                if (context.WebSockets.IsWebSocketRequest)
                {
                    Console.WriteLine($"WebSocket received ...");
                }

                return next();
            });
            builder.Run((context) => context.Response.WriteAsync("Hello World !"));
        }

        public void ConfigureServices(IServiceCollection services)
        {
            services.AddSignalR();
            services.AddSampleServices();
            var servicesBuilder = services.AddControllers();
            servicesBuilder.AddApplicationPart(Assembly.GetAssembly(typeof(SampleController)));
            services.AddAuthentication(options =>
            {

            });
        }
    }
}