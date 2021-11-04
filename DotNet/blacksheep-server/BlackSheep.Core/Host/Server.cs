using System.IO;
using System.Net;
using Microsoft.AspNetCore.Hosting;

namespace BlackSheep.Core.Host
{
    public class Server
    {
        private IWebHost _host;

        public void Start()
        {
            _host = new WebHostBuilder()
                .UseKestrel(options =>
                {
                    // TODO : read configuration for listening port
                    options.Listen(IPAddress.Any, 6060);
                })
                .UseStartup<Startup>()
                .Build();

            _host.Run();
        }

        public async void Stop()
        {
            await _host.WaitForShutdownAsync();
        }
    }
}