using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Sample.Dep;

namespace Sample
{
    public class SampleController : Controller
    {
        private readonly ISampleService _sampleService;

        public SampleController(ISampleService service)
        {
            _sampleService = service;
        }

        [HttpGet]
        [Route("api/[controller]")]
        [Route("api/[controller]/{id:int}")]
        public string GetSample([FromRoute] int id = 0)
        {
            return $"Toto {id}";
        }

        [HttpGet]
        [Route("api/[controller]/{id:int}/[action]")]
        [ActionName("other")]
        public string GetSampleOtherAction([FromRoute] int id = 0)
        {
            return _sampleService.Get(id);
        }
    }
}