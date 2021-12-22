using System.Collections.Generic;
using Microsoft.AspNetCore.DataProtection;

namespace BlackSheep.CMS.Model
{
    public class CMSDocumentBlocMetadata
    {
        public CMSDocumentBlocMetadata()
        {
            Properties = new Dictionary<string, object>();
        }

        public string BlocType { get; set; }

        public Dictionary<string, object> Properties { get; set; }
    }
}