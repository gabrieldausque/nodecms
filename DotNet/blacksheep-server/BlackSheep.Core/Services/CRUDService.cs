using Microsoft.Extensions.Configuration;

namespace BlackSheep.Core.Services
{
    public abstract class CRUDService<T>
    {
        protected CRUDService()
        {
        }

        public abstract void Init(IConfigurationSection configuration);
    }
}