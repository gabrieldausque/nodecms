using System.ComponentModel.DataAnnotations;
using System.Diagnostics.Eventing.Reader;
using BlackSheep.CMS.Models;
using BlackSheep.CMS.Views.Shared;
using BlackSheep.Core.MVC.Models;
using BlackSheep.Core.Services;

namespace BlackSheep.CMS.Rules;

public class CMSConfigurationRules : BlackSheepEntityRules<CMSConfiguration, CMSConfigurationFilter>
{
    public CMSConfigurationRules(CRUDService<CMSConfiguration, CMSConfigurationFilter> model) : base(model)
    {
    }
}