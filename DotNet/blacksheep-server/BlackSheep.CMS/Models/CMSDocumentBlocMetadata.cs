using System;
using System.Collections.Generic;
using System.Text.Encodings.Web;
using System.Text.Json;
using System.Text.Json.Serialization;

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
    }

    public class PropertiesConverter : JsonConverter<Dictionary<string, object>>
    {   
        public override Dictionary<string, object>? Read(ref Utf8JsonReader reader, Type typeToConvert, JsonSerializerOptions options)
        {
            var properties = new Dictionary<string, object>();
            string currentPropertyName = string.Empty;
            while (reader.TokenType != JsonTokenType.EndObject)
            {
                reader.Read();
                switch (reader.TokenType)
                {
                    case JsonTokenType.PropertyName:
                    {
                        currentPropertyName = reader.GetString();
                        properties.TryAdd(currentPropertyName, null);
                        break;
                    }
                    case JsonTokenType.String:
                    {
                        if (!string.IsNullOrWhiteSpace(currentPropertyName))
                        {
                            properties[currentPropertyName] = reader.GetString();
                            currentPropertyName = string.Empty;
                        }
                        break;
                    }
                    case JsonTokenType.False:
                    case JsonTokenType.True:
                    {
                        if (!string.IsNullOrWhiteSpace(currentPropertyName))
                        {
                            properties[currentPropertyName] = reader.GetBoolean();
                            currentPropertyName = string.Empty;
                        }
                        break;
                    }
                    //TODO : manage number type
                }
            }

            if (!properties.ContainsKey("HtmlId"))
            {
                properties.Add("HtmlId",Guid.NewGuid().ToString().Replace("-",string.Empty));
            }
            return properties;
        }

        public override void Write(Utf8JsonWriter writer, Dictionary<string, object> value, JsonSerializerOptions options)
        {
            if (value != null)
            {
                writer.WriteStartObject();
                foreach (var kvp in value)
                {
                    if(kvp.Value is string valueAsString)
                        writer.WriteString(JsonEncodedText.Encode(kvp.Key), JsonEncodedText.Encode(valueAsString));
                    else if(kvp.Value is bool valueAsBool)
                        writer.WriteBoolean(JsonEncodedText.Encode(kvp.Key), valueAsBool);
                    //TODO : manage numerics ...
                }
                writer.WriteEndObject();
            }
        }
    }
}