using System;
using System.Collections.Generic;
using System.Text.Json.Serialization;
using BlackSheep.Core.MVC.Models;
using BlackSheep.Core.Utils;

namespace BlackSheep.Playground.Data;

public class Scene : IBlackSheepEntity
{
    public Scene()
    {
        Entities = new List<GameEntityMetadata>();
    }

    public int Id { get; set; }
    public string Key { get; set; }
    public IList<GameEntityMetadata> Entities { get; set; }
}

public class GameEntityMetadata
{
    public GameEntityMetadata()
    {
        Id = Guid.NewGuid().ToString();
        Components = new List<GameEntityComponent>();
        Behaviors = new List<GameEntityBehavior>();
    }

    public string Id { get; set; }

    public IList<GameEntityComponent> Components { get; set; }

    public IList<GameEntityBehavior> Behaviors { get; set;  }
}

public class GameEntityBehavior
{
    public string TypeIdentifier { get; set; }
}

public class GameEntityComponent
{
    public GameEntityComponent()
    {
        Properties = new Dictionary<string, object>();
    }

    public string TypeIdentifier { get; set; }

    [JsonConverter(typeof(PropertiesConverter))]
    private Dictionary<string,object> Properties { get; set; } 
}