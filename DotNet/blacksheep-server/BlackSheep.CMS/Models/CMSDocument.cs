using System;
using System.Collections.Generic;
using BlackSheep.Core.MVC.Models;
using BlackSheep.Core.Services;

namespace BlackSheep.CMS.Models
{
    public class CMSDocument : IBlackSheepEntity
    {
        public CMSDocument()
        {
            Headers = new Zone();
            Bodies = new Zone();
            Footers = new Zone();
            CreationDate = DateTime.Now;
            UpdateDate = DateTime.Now;
            Tags = new List<string>();
            Visibility = Visibility.Private;
            Key = Guid.NewGuid().ToString();
        }
        
        public int Id { get; set; }

        public string Key { get; set; }

        public Zone Headers { get; set; }

        public Zone Bodies { get; set; }
        
        public Zone Footers { get; set; }

        public int OwnerId { get; set; }

        public DateTime CreationDate { get; set; }

        public DateTime UpdateDate { get; set; }

        public Visibility Visibility { get; set; }
        
        public IEnumerable<string> Tags { get; set; }
        public string Title { get; set; }
        public string Layout { get; set; }
    }
}