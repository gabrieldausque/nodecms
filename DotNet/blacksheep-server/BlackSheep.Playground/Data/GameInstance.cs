using System;
using BlackSheep.Core.MVC.Models;

namespace BlackSheep.Playground.Data;

public class GameInstance : IBlackSheepEntity
{
    public int Id { get; set; }
    public string Key { get; set; }

    public int GameTemplateId { get; set; }

    public Game GameState { get; set; }

    public GameInstance()
    {
        Key = Guid.NewGuid().ToString();
    }
}