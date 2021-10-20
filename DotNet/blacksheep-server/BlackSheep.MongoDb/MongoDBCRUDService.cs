using System;
using BlackSheep.Core.Infrastructure;
using BlackSheep.Core.Services;
using BlackSheep.MongoDb.Configuration;
using Microsoft.Extensions.Configuration;

namespace BlackSheep.MongoDb
{
    public class MongoDBCRUDService<T> : CRUDService<T> where T:class
    {
        private MongoDbServiceConfiguration _configurationModel;

        
        
        public override void Init(IConfigurationSection configuration)
        {
            _configurationModel = new MongoDbServiceConfiguration();
            configuration.Bind(_configurationModel);
        }
    }
}