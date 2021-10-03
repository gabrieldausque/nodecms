using System.Net;
using Microsoft.AspNetCore.Hosting;

namespace ConsoleServer
{
    class Program
    {
        static void Main(string[] args)
        {
            var host = new WebHostBuilder()
                .UseKestrel(options =>
                {
                    options.Listen(IPAddress.Any, 6060);
                })
                .UseStartup<Startup>()
                .Build();

            host.Run();
        }
    }
}
