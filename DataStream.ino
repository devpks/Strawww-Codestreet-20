
#include <ESP8266WiFi.h>

String apiKey = "7IAUW13FV0BW730H";     //  Enter your Write API key from ThingSpeak

const char *ssid =  "Workstation";     // replace with your wifi ssid and wpa2 key
const char *pass =  "romeshchandra";
const char *server = "api.thingspeak.com";
int sensorValue = random(100,200);


WiFiClient client;

void setup()
{

       Serial.begin(115200);
       delay(10);

       Serial.println("Connecting to ");
       Serial.println(ssid);


       WiFi.begin(ssid, pass);

      while (WiFi.status() != WL_CONNECTED)
     {
            delay(500);
            Serial.print(".");
     }
      Serial.println("");
      Serial.println("WiFi connected");

}

void loop()
{



              if (isnan(sensorValue))
                 {
                     Serial.println("Failed to read from DHT sensor!");
                      return;
                 }

                         if (client.connect(server,80))   //   "184.106.153.149" or api.thingspeak.com
                      {

                             String postStr = apiKey;
                             postStr +="&field1=";
                             postStr += String(sensorValue);

                             client.print("POST /update HTTP/1.1\n");
                             client.print("Host: api.thingspeak.com\n");
                             client.print("Connection: close\n");
                             client.print("X-THINGSPEAKAPIKEY: "+apiKey+"\n");
                             client.print("Content-Type: application/x-www-form-urlencoded\n");
                             client.print("Content-Length: ");
                             client.print(postStr.length());
                             client.print("\n\n");
                             client.print(postStr);

                             Serial.print("Data: ");
                             Serial.print(sensorValue);

                        }
          client.stop();

          Serial.println("Waiting...");

  // thingspeak needs minimum 15 sec delay between updates, i've set it to 30 seconds
  delay(15000);
}
