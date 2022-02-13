
using BlackSheep.Core.Host;
using System;
using System.Net;
using System.Threading;
using Microsoft.AspNetCore.Hosting;
using BlackSheepServer = BlackSheep.Core.Host.Server;
using BlackSheepBlazorServer = BlackSheep.Core.Host.BlazorServer;

namespace VideoGame
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
