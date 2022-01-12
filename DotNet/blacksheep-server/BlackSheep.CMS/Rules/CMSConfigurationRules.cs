using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Threading.Tasks;
using BlackSheep.CMS.Models;
using BlackSheep.CMS.Views.Shared;
using BlackSheep.Core.Services;

namespace BlackSheep.CMS.Rules;

public class CMSConfigurationRules
{
    private readonly CRUDService<CMSConfiguration, CMSConfigurationFilter> _model;

    public CMSConfigurationRules(CRUDService<CMSConfiguration, CMSConfigurationFilter> model)
    {
        _model = model;
    }

    public async Task<BlackSheepValidationResult> ValidateForUpdate(int entityId, CMSConfiguration newConfiguration)
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
            if (newConfiguration.Id == 0)
            {
                result.IsOk = false;
                result.Messages.Add($"Id must be greater than 0.");
            }

            if (entityId != newConfiguration.Id)
            {
                result.IsOk = false;
                result.Messages.Add($"Expected id for new entity is : {entityId}. Current is {newConfiguration.Id}.");
            }

            if (existingEntity.Key != newConfiguration.Key &&
                await _model.Exists(newConfiguration.Key))
            {
                result.IsOk = false;
                result.Messages.Add($"New key already exists.");
            }
        }

        return result;
    }

    public async Task<BlackSheepValidationResult> ValidateForUpdate(string entityKey, CMSConfiguration newConfiguration)
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
            if (existingEntity.Id != newConfiguration.Id)
            {
                result.IsOk = false;
                result.Messages.Add($"Id mismatch between existing entity and new entity with key {entityKey}");
            }

            if (existingEntity.Key != newConfiguration.Key)
            {
                result.IsOk = false;
                result.Messages.Add($"Key mismatch between existing and new entity. Update of key is not possible when key is used for update. Use id instead.");
            }
        }

        return result;
    }
}

public class BlackSheepValidationResult
{
    public BlackSheepValidationResult()
    {
        Messages = new List<string>();
        IsOk = true;
    }

    public IList<string> Messages { get; set; }

    public bool IsOk { get; set; }
}