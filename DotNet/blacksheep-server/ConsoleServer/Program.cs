using System;
using System.Net;
using System.Threading;
using Microsoft.AspNetCore.Hosting;
using BlackSheepServer = BlackSheep.Core.Host.Server;
using BlackSheepBlazorServer = BlackSheep.Core.Host.BlazorServer;
namespace ConsoleServer
{
    class Program
    {
        static void Main(string[] args)
        {
            var server = new BlackSheepBlazorServer();
            server.Start();
        }
    }
}
