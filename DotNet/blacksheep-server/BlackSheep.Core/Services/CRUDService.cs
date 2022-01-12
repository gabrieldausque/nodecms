using System;
using System.Collections;
using System.Collections.Generic;
using System.Threading.Tasks;
using Microsoft.Extensions.Configuration;

namespace BlackSheep.Core.Services
{
    public abstract class CRUDService<T, TF> where T:class,IBlackSheepEntity
    {
        protected CRUDService()
        {
        }

        public abstract void Init(IConfigurationSection configuration);

        public abstract T Get(int id);

        public abstract Task<T> GetAsync(int id);

        public abstract IEnumerable<T> Find(TF filter);

        public abstract Task<IEnumerable<T>> FindAsync(TF filter);

        public abstract T Get(string key);
        
        public abstract Task<T> GetAsync(string key);

        public virtual async Task<bool> Exists(string key)
        {
            return (await GetAsync(key)) != null;
        }

        public virtual async Task<bool> Exists(int id)
        {
            return (await GetAsync(id)) != null;
        }

        public abstract Task<T> Create(T newEntity);

        public abstract Task<T> Update(int id, T entityToUpdate);
        public abstract Task<T> Update(string key, T entityToUpdate);


    }
}