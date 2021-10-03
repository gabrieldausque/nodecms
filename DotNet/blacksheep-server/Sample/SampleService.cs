using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Sample
{
    public class SampleService : ISampleService
    {
        public string Get(int id)
        {
            return $"From Service With id : {id}";
        }
}

    public interface ISampleService
    {
        string Get(int id);

    }
}
