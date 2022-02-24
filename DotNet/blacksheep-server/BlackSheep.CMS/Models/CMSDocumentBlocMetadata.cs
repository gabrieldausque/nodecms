using System;
using System.Collections.Generic;
using System.Text.Encodings.Web;
using System.Text.Json.Serialization;
using BlackSheep.Core.Utils;

namespace BlackSheep.CMS.Models
{
    public class CMSDocumentBlocMetadata
    {
        private Guid _htmlId;

        public CMSDocumentBlocMetadata()
        {
            _htmlId = Guid.NewGuid();
            Properties = new Dictionary<string, object>();
        }

        public string BlocType { get; set; }

        private Dictionary<string, object> _properties;

        [JsonConverter(typeof(PropertiesConverter))]
        public Dictionary<string, object> Properties
        {
            get => _properties;
            set
            {
                if (value != null && value.ContainsKey("HtmlId") 
                                  && value["HtmlId"] is string existingGuidAsString 
                                  && Guid.TryParse(existingGuidAsString, out var existingGuid))
                {
                    _htmlId = existingGuid;
                }
                else
                {
                    value["HtmlId"] = _htmlId.ToString();
                }
                _properties = value;
            }
        }

        public int Row
        {
            get {
                if(Properties.TryGetValue("ZoneRow", out var zoneRowObjectValue))
                {
                    if (zoneRowObjectValue is int zoneRow)
                        return zoneRow;
                }

                return 0;
            }

            set => Properties["ZoneRow"] = value;
        }

        public int Column
        {
            get
            {
                if (Properties.TryGetValue("ZoneColumn", out var zoneRowObjectValue))
                {
                    if (zoneRowObjectValue is int zoneRow)
                        return zoneRow;
                }

                return 0;

            }

            set => Properties["ZoneColumn"] = value;
        }

        public string Id => Properties["HtmlId"].ToString();
    }
}