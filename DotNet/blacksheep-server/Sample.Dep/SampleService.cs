namespace Sample.Dep
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
