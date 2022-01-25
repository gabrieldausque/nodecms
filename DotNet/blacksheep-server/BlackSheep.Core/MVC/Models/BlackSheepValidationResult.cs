using System.Collections.Generic;

namespace BlackSheep.Core.MVC.Models;

public class BlackSheepValidationResult
{
    public BlackSheepValidationResult()
    {
        Messages = new List<string>();
        IsOk = true;
    }

    public IList<string> Messages { get; set; }

    public bool IsOk { get; set; }
}