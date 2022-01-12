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
using Microsoft.Extensions.Configuration;

namespace BlackSheep.CMS.Controllers
{
    [ApiController]
    [Route("api/configuration")]
    public class CMSConfigurationController : BaseCMSController
    {
        private readonly CRUDService<CMSConfiguration, CMSConfigurationFilter> _model;

        public CMSConfigurationController(CRUDService<CMSConfiguration, CMSConfigurationFilter> model, 
            IConfigurationRoot configuration):base(configuration)
        {
            _model = model;
        }

        [HttpGet]
        [Route("{id:int}")]
        public async Task<ActionResult<CMSConfiguration>> Get(int id)
        {
            var configuration = await _model.GetAsync(id);
            if (configuration != null)
                return Ok(configuration);
            return NotFound();
        }
        
        [HttpGet]
        [Route("{key:alpha}")]
        public async Task<ActionResult<CMSConfiguration>> Get(string key)
        {
            var configuration = await _model.GetAsync(key);
            if (configuration != null)
                return Ok(configuration);
            return NotFound();
        }
        
        [HttpGet]
        public async Task<ActionResult<IEnumerable<CMSConfiguration>>> Find([FromQuery] CMSConfigurationFilter filter = null)
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

        [HttpPut]
        [Route("{id:int}")]
        public async Task<ActionResult<CMSConfiguration>> Update([FromRoute] int id, [FromBody] CMSConfiguration configuration)
        {
            if (await _model.Exists(id))
            {
                if (id != configuration.Id)
                    return BadRequest($"Id in route and id in entity are not the same. Please Correct");

                var updated = await _model.Update(configuration.Id, configuration);
                return Ok(updated);
            }

            return NotFound(configuration);
        }
        
        [HttpPut]
        [Route("{key:string}")]
        public async Task<ActionResult<CMSConfiguration>> Update([FromRoute] string key, [FromBody] CMSConfiguration configuration)
        {
            if (await _model.Exists(key))
            {
                if (key != configuration.Key)
                    return BadRequest($"Key in route and key in entity are not the same. Please Correct");

                var updated = await _model.Update(configuration.Key, configuration);
                return Ok(updated);
            }

            return NotFound(configuration);
        }

        [HttpPatch]
        [Route("{id:int}")]
        public async Task<ActionResult<CMSConfiguration>> Patch([FromRoute] int id, [FromBody] Dictionary<string, object> partialConfiguration)
        {
            if (await _model.Exists(id))
            {
                //TODO : remove id from the partialConfiguration and then pass to model entity
            }

            return NotFound($"Entity of type {nameof(CMSConfiguration)} with id {id} doesn't exist.");
        }
    }
}
