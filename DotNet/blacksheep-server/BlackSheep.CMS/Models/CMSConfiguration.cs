using BlackSheep.Core.Services;

namespace BlackSheep.CMS.Models;

public class CMSConfiguration : IBlackSheepEntity
{
    public CMSConfiguration()
    {
    }

    public int Id { get; set; }
    public string Key { get; set; }

    public string Value { get; set; }
}