using System;
using System.Collections.Generic;
using System.Linq;
using System.Linq.Expressions;
using BlackSheep.Core.Infrastructure;
using BlackSheep.Core.Services;
using BlackSheep.MongoDb.Configuration;
using Microsoft.Extensions.Configuration;
using MongoDB.Bson;
using MongoDB.Bson.Serialization;
using MongoDB.Driver;

namespace BlackSheep.MongoDb
{
    public class MongoDBCRUDService<T, TF> : CRUDService<T, TF> where T:class,IBlackSheepModel
    {

        private MongoDbServiceConfiguration _configurationModel;

        private MongoClient _client;
        
        public override void Init(IConfigurationSection configuration)
        {
            
            _configurationModel = new MongoDbServiceConfiguration();
            configuration.Bind(_configurationModel);

            if (!string.IsNullOrWhiteSpace(_configurationModel.Username) &&
                !string.IsNullOrWhiteSpace(_configurationModel.Password) &&
                !string.IsNullOrWhiteSpace(_configurationModel.Database) &&
                _configurationModel.Servers is {Length: > 0})
            {
                var credential = MongoCredential.CreateCredential(_configurationModel.Database,
                    _configurationModel.Username,
                    _configurationModel.Password);
                var servers = new List<MongoServerAddress>();
                foreach (var server in _configurationModel.Servers)
                {
                    MongoServerAddress address = MongoServerAddress.Parse(server);
                    servers.Add(address);
                }

                var settings = new MongoClientSettings()
                {
                    Credential = credential,
                    Servers = servers
                };
                _client = new MongoClient(settings);
            } else
                _client = new MongoClient(_configurationModel.ConnectionString);

            if (!BsonClassMap.IsClassMapRegistered(typeof(T)))
            {
                BsonClassMap.RegisterClassMap<T>(cm =>
                {
                    cm.AutoMap();
                    cm.UnmapProperty("Id");
                    cm.MapProperty(t => t.Id)
                        .SetElementName("Id")
                        .SetIsRequired(true)
                        .SetOrder(0);
                    cm.SetIgnoreExtraElements(true);
                });
            }
        }

        public override T Get(int id)
        {
            var db = _client.GetDatabase(_configurationModel.Database);
            var collection = db.GetCollection<T>(_configurationModel.Collection);
            var findTask = collection.FindAsync(t => t.Id == id);
            findTask.Wait();
            if (findTask.IsCompletedSuccessfully)
                return findTask.Result.ToList().FirstOrDefault();
            return null;
        }

        public override IEnumerable<T> Find(TF filter)
        {
            var db = _client.GetDatabase(_configurationModel.Database);
            var collection = db.GetCollection<T>(_configurationModel.Collection);
            var filters = new List<FilterDefinition<T>>();
            foreach (var filterProperty in filter.GetType().GetProperties())
            {
                var filterValue = filterProperty.GetValue(filter);
                if (filterValue != null)
                {
                    filters.Add(Builders<T>.Filter.Eq(filterProperty.Name, filterValue));
                }
            }

            if (filters.Any())
            {
                var finalFilter = Builders<T>.Filter.And(filters);
                var findTask = collection.FindAsync(finalFilter);
                findTask.Wait();
                if (findTask.IsCompletedSuccessfully)
                    return findTask.Result.ToList();
            }
            
            return new List<T>();
        }

        public override T Get(string key)
        {
            var db = _client.GetDatabase(_configurationModel.Database);
            var findTask = db.GetCollection<T>(_configurationModel.Collection).FindAsync(t => t.Key == key);

            findTask.Wait();

            if (findTask.IsCompletedSuccessfully)
                return findTask.Result.ToList().FirstOrDefault();

            return null;
        }
    }
}