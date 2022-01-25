using System;
using BlackSheep.Core.MVC.Models;
using BlackSheep.Core.Services;

namespace BlackSheep.Core.Exceptions;

public class ExistingEntityException : ApplicationException
{
    public ExistingEntityException(IBlackSheepEntity alreadyExistingEntity) : base(
        $"The entity of type {alreadyExistingEntity.GetType().Name} with key {alreadyExistingEntity.Key} already exists")
    {

    }
}