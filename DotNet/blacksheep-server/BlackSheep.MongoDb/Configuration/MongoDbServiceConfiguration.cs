using BlackSheep.Core.Services;

namespace BlackSheep.MongoDb.Configuration
{
    public class MongoDbServiceConfiguration : ConfigurationForCRUDService
    {
        public MongoDbServiceConfiguration()
        {
            Servers = new string[] { };
        }

        public string ConnectionString { get; set; }
        public string Collection { get; set; }
        public string Username { get; set; }
        public string Password { get; set; }
        public string Database { get; set; }
        public string[] Servers { get; set; }
    }
}