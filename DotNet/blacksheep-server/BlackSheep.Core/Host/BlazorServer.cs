using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Hosting;

namespace BlackSheep.Core.Host
{
    public class BlazorServer : Server
    {
        public override void Start()
        {
            var builder = new WebHostBuilder()
                .UseKestrel(options =>
                {
                    // TODO : read configuration for listening port
                    options.Listen(IPAddress.Any, 6060);
                }); 
            builder.UseStaticWebAssets();
            builder.UseStartup<BlazorStartup>();
            _host = builder.Build();
            _host.Run();
        }
    }
}
