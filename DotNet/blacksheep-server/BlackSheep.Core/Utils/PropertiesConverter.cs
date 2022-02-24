using System;
using System.Collections.Generic;
using System.Text.Json;
using System.Text.Json.Serialization;

namespace BlackSheep.Core.Utils;

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
                case JsonTokenType.Number:
                {
                    if (!string.IsNullOrWhiteSpace(currentPropertyName))
                    {
                        object numberAsObject = null;
                        var numberAsString = reader.GetString();
                        
                        if (Single.TryParse(numberAsString, out var f))
                        {
                            numberAsObject = f;
                        } 
                        else if (Double.TryParse(numberAsString, out var d))
                        {
                            numberAsObject = d;
                        } 
                        else if (int.TryParse(numberAsString, out var i))
                        {
                            numberAsObject = i;
                        }
                        else if (long.TryParse(numberAsString, out var l))
                        {
                            numberAsObject = l;
                        }

                        if (numberAsObject != null)
                        {
                            properties[currentPropertyName] = numberAsObject;
                        }

                        currentPropertyName = string.Empty;
                    }
                    break;
                }
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