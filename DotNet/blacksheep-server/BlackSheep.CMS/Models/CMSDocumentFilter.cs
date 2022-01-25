using System;
using System.Collections.Generic;

namespace BlackSheep.CMS.Models
{
    // ReSharper disable once InconsistentNaming
    public class CMSDocumentFilter
    {
        public int? Id { get; set; }

        public IEnumerable<string> Tags { get; set; }

        public string Key { get; set; }

        public  int? OwnerId { get; set; }

        public DateTime? CreationDate { get; set; }

        public DateTime? UpdateDate { get; set; }

        public Visibility? Visibility { get; set; }
    }
}