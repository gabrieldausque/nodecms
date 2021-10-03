using System;
using Microsoft.AspNetCore.Mvc;

namespace Sample
{
    [Route("api/[controller]")]
    public class OtherSampleController : Controller
    {
        public OtherSampleController()
        {
            Console.WriteLine("hello");
        }
        
        [HttpGet]
        public string GetOtherSample()
        {
            return "Tata";
        }
    }
}