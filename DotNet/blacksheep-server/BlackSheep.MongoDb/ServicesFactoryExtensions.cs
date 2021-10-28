using BlackSheep.Core.Infrastructure;

namespace BlackSheep.MongoDb
{
    [RegisterServiceType]
    public static class ServicesFactoryExtensions
    {
        [RegisterServiceType]
        public static void RegisterServices()
        {
            ServicesFactory.Instance.RegisterType("mongodb", typeof(MongoDBCRUDService<,>));
        }
    }
}