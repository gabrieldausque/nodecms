using System.Collections;
using System.Collections.Generic;
using BlackSheep.Core.MVC.Models;

namespace BlackSheep.Playground.Data
{
    public class Game : IBlackSheepEntity
    {
        public Game()
        {
            Scenes = new List<int>();
        }

        public int Id { get; set; }
        
        public string Key { get; set; }

        public string Owner { get; set; }

        public IList<int> Scenes { get; set; }

    }
}
