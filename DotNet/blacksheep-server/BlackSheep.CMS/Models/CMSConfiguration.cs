using BlackSheep.Core.Services;

namespace BlackSheep.CMS.Models;

public class CMSConfiguration : IBlackSheepModel
{
    public CMSConfiguration()
    {
    }

    public int Id { get; set; }
    public string Key { get; set; }

    public string Value { get; set; }
}