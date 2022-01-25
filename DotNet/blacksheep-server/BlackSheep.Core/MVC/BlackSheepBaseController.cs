using System.Collections.Generic;
using System.Threading.Tasks;
using BlackSheep.Core.MVC.Models;
using BlackSheep.Core.Services;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Configuration;

namespace BlackSheep.Core.MVC
{
    public abstract class BlackSheepBaseController<TEntity, TEntityFilter> : Controller 
        where TEntity : class, IBlackSheepEntity
    {
        protected IConfigurationRoot Configuration { get; }

        protected readonly CRUDService<TEntity, TEntityFilter> _model;
        protected readonly BlackSheepEntityRules<TEntity, TEntityFilter> _rules;
        protected readonly string _route;

        protected BlackSheepBaseController(CRUDService<TEntity, TEntityFilter> model,
            BlackSheepEntityRules<TEntity,TEntityFilter> rules,
            IConfigurationRoot configuration, string route)
        {
            Configuration = configuration;
            _model = model;
            _rules = rules;
            _route = route;
        }

        [HttpPost]
        public virtual async Task<ActionResult<TEntity>> Create([FromBody] TEntity newEntity)
        {
            var validationResult = await _rules.ValidateForCreate(newEntity);
            if (validationResult.IsOk)
            {
                var created = await _model.Create(newEntity);
                return Created($"{_route}/{created.Id}", created);
            }

            return BadRequest(validationResult);
        }


        [HttpGet]
        [Route("{id:int}")]
        public virtual async Task<ActionResult<TEntity>> Get(int id)
        {
            var configuration = await _model.GetAsync(id);
            if (configuration != null)
                return Ok(configuration);
            return NotFound();
        }

        [HttpGet]
        [Route("{key:alpha}")]
        public virtual async Task<ActionResult<TEntity>> Get(string key)
        {
            var configuration = await _model.GetAsync(key);
            if (configuration != null)
                return Ok(configuration);
            return NotFound();
        }

        [HttpGet]
        public virtual async Task<ActionResult<IEnumerable<TEntity>>> Find([FromQuery] TEntityFilter filter = default(TEntityFilter))
        {
            var configurations = await _model.FindAsync(filter, true);
            if (configurations != null)
                return Ok(configurations);
            return NotFound();
        }


        [HttpPut]
        [Route("{id:int}")]
        public virtual async Task<ActionResult<TEntity>> Update([FromRoute] int id, [FromBody] TEntity entityUpdated)
        {
            var validationResult = await _rules.ValidateForUpdate(id, entityUpdated);

            if (validationResult.IsOk)
            {
                var updated = await _model.Update(entityUpdated.Id, entityUpdated);
                return Ok(updated);
            }

            return BadRequest(validationResult);
        }

        [HttpPut]
        [Route("{key:alpha}")]
        public virtual async Task<ActionResult<TEntity>> Update([FromRoute] string key, [FromBody] TEntity entityUpdated)
        {
            var validationResult = await _rules.ValidateForUpdate(key, entityUpdated);

            if (validationResult.IsOk)
            {
                var updated = await _model.Update(entityUpdated.Id, entityUpdated);
                return Ok(updated);
            }

            return BadRequest(validationResult);
        }

        [HttpPatch]
        [Route("{id:int}")]
        public virtual async Task<ActionResult<TEntity>> Patch([FromRoute] int id, [FromBody] Dictionary<string, object> partialEntity)
        {
            var validationResult = await _rules.ValidateForPatch(id, partialEntity);
            if (validationResult.IsOk)
            {
                var patch = await _model.Patch(id, partialEntity);
                return Ok(patch);
            }

            return BadRequest(validationResult);
        }

        [HttpPatch]
        [Route("{key:alpha}")]
        public virtual async Task<ActionResult<TEntity>> Patch([FromRoute] string key, [FromBody] Dictionary<string, object> partialEntity)
        {
            var validationResult = await _rules.ValidateForPatch(key, partialEntity);
            if (validationResult.IsOk)
            {
                var patch = await _model.Patch(key, partialEntity);
                return Ok(patch);
            }

            return BadRequest(validationResult);
        }

        [HttpDelete]
        [Route("{id:int}")]
        public  virtual async Task<ActionResult<TEntity>> Delete([FromRoute] int id)
        {
            var validationResult = await _rules.ValidateForDelete(id);
            if (!validationResult.IsOk) return BadRequest(validationResult);
            var deleted = await _model.Delete(id);
            return Ok(deleted);

        }

        [HttpDelete]
        [Route("{key:alpha}")]
        public virtual async Task<ActionResult<TEntity>> Delete([FromRoute] string key)
        {
            var validationResult = await _rules.ValidateForDelete(key);
            if (!validationResult.IsOk) return BadRequest(validationResult);
            var deleted = await _model.Delete(key);
            return Ok(deleted);

        }
    }
}
