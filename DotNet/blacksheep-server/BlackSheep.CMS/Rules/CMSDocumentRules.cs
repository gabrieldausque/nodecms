using BlackSheep.CMS.Models;
using BlackSheep.Core.MVC.Models;
using BlackSheep.Core.Services;

namespace BlackSheep.CMS.Rules;

public class CMSDocumentRules : BlackSheepEntityRules<CMSDocument, CMSDocumentFilter>
{
    public CMSDocumentRules(CRUDService<CMSDocument, CMSDocumentFilter> model) : base(model)
    {
    }
}