using System.Collections.Generic;

namespace BlackSheep.CMS.Model
{
    public class Zone
    {
        public Zone()
        {
            Content = new List<CMSDocumentBlocMetadata>();
        }
        
        public IList<CMSDocumentBlocMetadata> Content { get; set; }

        public ZoneLayout Layout { get; set; }
    }
}