using System.Collections.Generic;

namespace BlackSheep.CMS.Model
{
    public class CMSDocumentFilter
    {
        public int? Id { get; set; }

        public IEnumerable<string> Tags { get; set; }
    }
}