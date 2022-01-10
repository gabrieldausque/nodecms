using System.Collections;
using System.Collections.Generic;
using System.Net;
using System.Threading.Tasks;
using BlackSheep.CMS.Models;
using BlackSheep.Core.Exceptions;
using BlackSheep.Core.Services;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.ModelBinding;

namespace BlackSheep.CMS.Controllers
{
    [ApiController]
    [Route("api/configuration")]
    public class CMSConfigurationController : ControllerBase
    {
        private readonly CRUDService<CMSConfiguration, CMSConfigurationFilter> _model;

        public CMSConfigurationController(CRUDService<CMSConfiguration, CMSConfigurationFilter> model)
        {
            _model = model;
        }

        [HttpGet]
        [Route("{id:int}")]
        public async Task<ActionResult<CMSConfiguration>> GetConfig(int id)
        {
            var configuration = await _model.GetAsync(id);
            if (configuration != null)
                return Ok(configuration);
            return NotFound();
        }
        
        [HttpGet]
        [Route("{key:alpha}")]
        public async Task<ActionResult<CMSConfiguration>> GetConfig(string key)
        {
            var configuration = await _model.GetAsync(key);
            if (configuration != null)
                return Ok(configuration);
            return NotFound();
        }
        
        [HttpGet]
        public async Task<ActionResult<IEnumerable<CMSConfiguration>>> FindConfig([FromQuery] CMSConfigurationFilter filter = null)
        {
            var configurations = await _model.FindAsync(filter);
            if (configurations != null)
                return Ok(configurations);
            return NotFound();
        }

        [HttpPost]
        public async Task<ActionResult<CMSConfiguration>> Create([FromBody] CMSConfiguration configuration)
        {
            if (!(await _model.Exists(configuration.Key)))
            {
                var created = await _model.Create(configuration);
                return Created($"api/configuration/{created.Id}", created);
            }

            return Conflict(new ExistingEntityException(configuration));
        }
    }
}
