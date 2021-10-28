using System;
using System.Collections;
using System.Collections.Generic;
using Microsoft.Extensions.Configuration;

namespace BlackSheep.Core.Services
{
    public abstract class CRUDService<T, TF> where T:class,IBlackSheepModel
    {
        protected CRUDService()
        {
        }

        public abstract void Init(IConfigurationSection configuration);

        public abstract T Get(int id);

        public abstract IEnumerable<T> Find(TF filter);

        public abstract T Get(string key);
    }
}