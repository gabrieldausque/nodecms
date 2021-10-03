using Microsoft.AspNetCore.Mvc;

namespace Sample
{
    [Route("api/[controller]")]
    public class OtherSampleController : Controller
    {
        [HttpGet]
        public string GetOtherSample()
        {
            return "Tata";
        }
    }
}