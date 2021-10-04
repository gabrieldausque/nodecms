using System;
using System.Net;
using Microsoft.AspNetCore.Hosting;
using BlackSheepServer = BlackSheep.Core.Host.Server;
namespace ConsoleServer
{
    class Program
    {
        static void Main(string[] args)
        {
            var server = new BlackSheepServer();
            server.Start();
        }
    }
}
