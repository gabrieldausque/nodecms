using System.Collections.Generic;

namespace BlackSheep.CMS.Models
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