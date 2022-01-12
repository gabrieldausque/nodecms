using System;
using System.Collections.Generic;
using System.Linq;
using System.Linq.Expressions;
using System.Reflection;
using System.Threading.Tasks;
using BlackSheep.Core.Infrastructure;
using BlackSheep.Core.Services;
using BlackSheep.MongoDb.Configuration;
using Microsoft.Extensions.Configuration;
using MongoDB.Bson;
using MongoDB.Bson.Serialization;
using MongoDB.Bson.Serialization.Attributes;
using MongoDB.Driver;

namespace BlackSheep.MongoDb
{
    public class MongoDBCRUDService<T, TF> : CRUDService<T, TF> where T:class,IBlackSheepEntity
    {

        private static readonly string COUNTERS_COLLECTION_NAME = "counters";

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

        public override async Task<T> GetAsync(int id)
        {
            var db = _client.GetDatabase(_configurationModel.Database);
            var collection = db.GetCollection<T>(_configurationModel.Collection);
            var results = await collection.FindAsync(t => t.Id == id);
            return results.FirstOrDefault();
        }

        public override IEnumerable<T> Find(TF filter, bool noFilterReturnAll = false)
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
            else if (noFilterReturnAll)
            {
                return collection.Find(e => true).ToList();
            }
            
            return new List<T>();
        }

        public override async Task<IEnumerable<T>> FindAsync(TF filter, bool noFilterReturnAll = false)
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
                    return (await collection.FindAsync(finalFilter)).ToList();
            } 
            else if (noFilterReturnAll)
            {
                return await (await collection.FindAsync(e => true)).ToListAsync();
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

        public override async Task<T> GetAsync(string key)
        {
            var db = _client.GetDatabase(_configurationModel.Database);
            return (await db.GetCollection<T>(_configurationModel.Collection)
                .FindAsync(t => t.Key == key)).FirstOrDefault();
        }

        public override async Task<T> Create(T newEntity)
        {
            var db = _client.GetDatabase(_configurationModel.Database);
            var entityCollection = db.GetCollection<T>(_configurationModel.Collection);
            newEntity.Id = await GetNewId(_configurationModel.Collection);
            await entityCollection.InsertOneAsync(newEntity);
            return await GetAsync(newEntity.Id);
        }

        public override async Task<T> Update(int id, T entityToUpdate)
        {
            var db = _client.GetDatabase(_configurationModel.Database);
            var entityCollection = db.GetCollection<T>(_configurationModel.Collection);
            var currentEntity = await GetAsync(id);
            return await InternalUpdate(entityToUpdate, currentEntity, entityCollection);
        }

        public override async Task<T> Update(string key, T entityToUpdate)
        {
            var db = _client.GetDatabase(_configurationModel.Database);
            var entityCollection = db.GetCollection<T>(_configurationModel.Collection);
            var currentEntity = await GetAsync(key);
            return await InternalUpdate(entityToUpdate, currentEntity, entityCollection);
        }

        protected virtual async Task<T> InternalUpdate(T entityToUpdate, T currentEntity, IMongoCollection<T> entityCollection)
        {
            var builder = Builders<T>.Update;
            UpdateDefinition<T> update = null;
            foreach (var entityProperty in currentEntity.GetType().GetProperties())
            {
                var existingValue = entityProperty.GetValue(currentEntity);
                var newValue = entityProperty.GetValue(entityToUpdate);
                if (existingValue != null && !existingValue.Equals(newValue))
                {
                    var bsonPropName = entityProperty.Name;
                    if (entityProperty.GetCustomAttributes().Any(ca => ca is BsonElementAttribute))
                    {
                        bsonPropName = entityProperty.GetCustomAttribute<BsonElementAttribute>().ElementName;
                    }

                    if (update == null)
                        update = builder.Set(bsonPropName, entityProperty.GetValue(entityToUpdate));
                    else
                        update.Set(bsonPropName, entityProperty.GetValue(entityToUpdate));
                }
            }

            T entityToReturn = currentEntity;
            if (update != null)
            {
                entityToReturn = await entityCollection.FindOneAndUpdateAsync<T, T>(
                    e => e.Id == currentEntity.Id,
                    update, new FindOneAndUpdateOptions<T, T>()
                    {
                        ReturnDocument = ReturnDocument.After
                    });
            }

            return entityToReturn;
        }

        private async Task<int> GetNewId(string collectionName)
        {
            var db = _client.GetDatabase(_configurationModel.Database);
            var countersCollection = db.GetCollection<MongoDbCollectionLastId>(COUNTERS_COLLECTION_NAME);
            var newId = await countersCollection
                .FindOneAndUpdateAsync<MongoDbCollectionLastId, MongoDbCollectionLastId>(
                c => c.Name == collectionName,
                $"{{ $inc: {{ lastId : 1 }} }}",
                new FindOneAndUpdateOptions<MongoDbCollectionLastId, MongoDbCollectionLastId>()
                {
                    ReturnDocument = ReturnDocument.After,
                    IsUpsert = true
                });
            return newId.LastId;
        }


    }

    public class MongoDbCollectionLastId
    {
        [BsonId]
        public ObjectId Id { get; set; }

        [BsonElement("name")]
        public string Name { get; set; }

        [BsonElement("lastId")]
        public int LastId { get; set; }
    }
}