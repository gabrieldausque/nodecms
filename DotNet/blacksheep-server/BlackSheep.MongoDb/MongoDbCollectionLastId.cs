using MongoDB.Bson;
using MongoDB.Bson.Serialization.Attributes;

namespace BlackSheep.MongoDb;

public class MongoDbCollectionLastId
{
    [BsonId]
    public ObjectId Id { get; set; }

    [BsonElement("name")]
    public string Name { get; set; }

    [BsonElement("lastId")]
    public int LastId { get; set; }
}