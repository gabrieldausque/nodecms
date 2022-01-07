using System.Collections.Generic;

namespace BlackSheep.CMS.Models
{
    public class CMSDocumentBlocMetadata
    {
        public CMSDocumentBlocMetadata()
        {
            Properties = new Dictionary<string, object>();
        }

        public string BlocType { get; set; }

        public Dictionary<string, object> Properties { get; set; }

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
    }
}