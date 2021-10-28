using System;
using System.Collections;
using System.Collections.Generic;
using BindingFlags = System.Reflection.BindingFlags;

namespace BlackSheep.Core.Infrastructure
{
    public class ServicesFactory
    {
        private static readonly object LockObject = new object();

        private static ServicesFactory instance;

        public static ServicesFactory Instance
        {
            get
            {
                lock (LockObject)
                {
                    instance ??= new ServicesFactory();
                }

                return instance;
            }
        }

        private ServicesFactory()
        {
            ServiceClasses = new Dictionary<string,Type>();
        }

        private Dictionary<string,Type> ServiceClasses { get; }

        public void RegisterType(string serviceTypeIdentifier, Type type)
        {
            ServiceClasses[serviceTypeIdentifier] = type;
        }

        public TS GetServiceInstance<TS, T, TF>(string serviceTypeIdentifier)
        {
            var serviceGenericType = ServiceClasses[serviceTypeIdentifier];

            if (!serviceGenericType.IsGenericType)
                throw new ApplicationException(
                    $"Service {serviceGenericType.FullName} is not a generic type.");
            var specializedType = serviceGenericType.MakeGenericType(typeof(T), typeof(TF));
            var service = specializedType.GetConstructor(new Type[] { })?.Invoke(null);
            if (service is not TS concreteService)
                throw new ApplicationException($"{service.GetType().FullName} is not if type {typeof(TS).FullName}");
            return concreteService;
        } 
    }
}