using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using BlackSheep.Core.Services;

namespace BlackSheep.Core.MVC.Models;

public abstract class BlackSheepEntityRules<TEntity, TEntityFilter>
    where TEntity : class, IBlackSheepEntity
{
    protected readonly CRUDService<TEntity, TEntityFilter> _model;

    protected BlackSheepEntityRules(CRUDService<TEntity, TEntityFilter> model)
    {
        _model = model;
    }

    public virtual async Task<BlackSheepValidationResult> ValidateForUpdate(int entityId, TEntity updatedEntity)
    {
        var result = new BlackSheepValidationResult();
        var existingEntity = await _model.GetAsync(entityId);

        if (existingEntity == null)
        {
            result.IsOk = false;
            result.Messages.Add($"Configuration with id {entityId} doesn't exists. No update possible.");
        }
        else
        {
            if (updatedEntity.Id == 0)
            {
                result.IsOk = false;
                result.Messages.Add($"Id must be greater than 0.");
            }

            if (entityId != updatedEntity.Id)
            {
                result.IsOk = false;
                result.Messages.Add($"Expected id for new entity is : {entityId}. Current is {existingEntity.Id}.");
            }

            if (existingEntity.Key != updatedEntity.Key &&
                await _model.Exists(updatedEntity.Key))
            {
                result.IsOk = false;
                result.Messages.Add($"New key already exists.");
            }
        }

        return result;
    }

    public virtual async Task<BlackSheepValidationResult> ValidateForUpdate(string entityKey, TEntity updatedEntity)
    {
        var existingEntity = await _model.GetAsync(entityKey);
        var result = new BlackSheepValidationResult();

        if (existingEntity == null)
        {
            result.IsOk = false;
            result.Messages.Add($"Configuration with Key {entityKey} doesn't exists. No update possible.");
        }
        else
        {
            if (existingEntity.Id != updatedEntity.Id)
            {
                result.IsOk = false;
                result.Messages.Add($"Id mismatch between existing entity and new entity with key {entityKey}");
            }

            if (existingEntity.Key != updatedEntity.Key)
            {
                result.IsOk = false;
                result.Messages.Add($"Key mismatch between existing and new entity. Update of key is not possible when key is used for update. Use id instead.");
            }
        }

        return result;
    }

    public async Task<BlackSheepValidationResult> ValidateForCreate(TEntity newEntity)
    {
        var result = new BlackSheepValidationResult();
        if (newEntity.Id != 0)
        {
            result.IsOk = false;
            result.Messages.Add("Id must be 0 for creation.");
        }

        if (string.IsNullOrWhiteSpace(newEntity.Key))
        {
            result.IsOk = false;
            result.Messages.Add("Key must not be empty");
        }

        if (await _model.Exists(newEntity.Key))
        {
            result.IsOk = false;
            result.Messages.Add($"An object with key {newEntity.Key} already exists");
        }

        return result;
    }

    public async Task<BlackSheepValidationResult> ValidateForPatch(int id, Dictionary<string, object> partialEntity)
    {
        var existingEntity = await _model.GetAsync(id);
        var result = new BlackSheepValidationResult();

        if (existingEntity == null)
        {
            result.IsOk = false;
            result.Messages.Add($"Entity of type {nameof(TEntity)} with id {id} doesn't exists.");
        }

        if (partialEntity.ContainsKey("Id"))
        {
            result.IsOk = false;
            result.Messages.Add($"Id can't be updated.");
        }

        if (partialEntity.Keys.Any(k => typeof(TEntity).GetProperties().All(p => p.Name != k)))
        {
            result.IsOk = false;
            result.Messages.Add($"Some of the properties in the argument doesn't exists in type {nameof(TEntity)}");
        }

        if (partialEntity.ContainsKey("Key"))
        {
            var key = partialEntity["key"] as string;
            if (string.IsNullOrWhiteSpace(key))
            {
                result.IsOk = false;
                result.Messages.Add("Key can't be empty.");
            }
            else if (await _model.Exists(key) && (await _model.GetAsync(key)).Id != id)
            {
                result.IsOk = false;
                result.Messages.Add($"Another entity use the same key.");
            }
        }

        return result;
    }

    public async Task<BlackSheepValidationResult> ValidateForPatch(string key, Dictionary<string, object> partialEntity)
    {
        var currentEntity = await _model.GetAsync(key);
        var result = new BlackSheepValidationResult();

        if (currentEntity == null)
        {
            result.IsOk = false;
            result.Messages.Add($"Entity of type {nameof(TEntity)} and key {key} doesn't exists");
        }
        else
        {
            result = await ValidateForPatch(currentEntity.Id, partialEntity);

            if (partialEntity.ContainsKey("Key"))
            {
                result.IsOk = false;
                result.Messages.Add($"Key can't be updated using Key as identifier. Please use id.");
            }
        }

        return result;
    }

    public async Task<BlackSheepValidationResult> ValidateForDelete(int id)
    {
        var currentEntity = await _model.GetAsync(id);
        var result = new BlackSheepValidationResult();

        if (currentEntity != null) return result;

        result.IsOk = false;
        result.Messages.Add($"Entity of type {nameof(TEntity)} with id {id} doesn't exists.");

        return result;
    }
    public async Task<BlackSheepValidationResult> ValidateForDelete(string key)
    {
        var currentEntity = await _model.GetAsync(key);
        var result = new BlackSheepValidationResult();

        if (currentEntity != null) return result;

        result.IsOk = false;
        result.Messages.Add($"Entity of type {nameof(TEntity)} with key {key} doesn't exists.");

        return result;
    }
}