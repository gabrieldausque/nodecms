using System;
using Microsoft.AspNetCore.Components;
using Microsoft.VisualBasic;

namespace BlackSheep.CMS.Model
{
    public class CMSDocument
    {
        public CMSDocument()
        {
            Headers = new Zone();
            Bodies = new Zone();
            Footers = new Zone();
        }
        
        public int Id { get; set; }

        public string Key { get; set; }

        public Zone Headers { get; set; }

        public Zone Bodies { get; set; }
        
        public Zone Footers { get; set; }

        public int ownerId { get; set; }

        public DateTime CreationDate { get; set; }

        public DateTime UpdateDate { get; set; }

        public Visibility Visibility { get; set; }
        
        
    }
}