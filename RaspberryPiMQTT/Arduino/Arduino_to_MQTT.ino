//programmed by Hector Barajas UTT

#include "WiFiEsp.h"
#include <PubSubClient.h>
#include <DHT.h>
#include <ArduinoJson.h>

// Set DHT pin:
#define DHTPIN 4

// Set DHT type, uncomment whatever type you're using!
#define DHTTYPE DHT22   // DHT 11 
//#define DHTTYPE DHT22   // DHT 22  (AM2302)
//#define DHTTYPE DHT21   // DHT 21 (AM2301)

// Initialize DHT sensor for normal 16mhz Arduino:
DHT dht = DHT(DHTPIN, DHTTYPE);



// Emulate Serial1 on pins 6/7 if not present
#ifndef HAVE_HWSERIAL1
#include "SoftwareSerial.h"
SoftwareSerial Serial1(2, 3); // RX, TX
#endif

char ssid[] = "Totalplay-56A2";            // your network SSID (name)
char pass[] = "56A20FD7zNwZWrCk";        // your network password
const char* broker = "broker.hivemq.com";
const char* topic = "utt0317115032/test";
char tempS[5];
int analogPin = A0;
int analogPin2 = A2;
float analogValue = 0;
float analogValue2 = 0;
int status = WL_IDLE_STATUS;     // the Wifi radio's status

char server[] = "arduino.cc";

// Initialize the Ethernet client object
WiFiEspClient clientEsp;
PubSubClient client(clientEsp);

void setup()
{
  // Setup sensor:
  dht.begin();

  
  // initialize serial for debugging
  Serial.begin(115200);
  // initialize serial for ESP module
  Serial1.begin(9600);
  // initialize ESP module
  WiFi.init(&Serial1);

  // check for the presence of the shield
  if (WiFi.status() == WL_NO_SHIELD) {
    Serial.println("WiFi shield not present");
    // don't continue
    while (true);
  }

  // attempt to connect to WiFi network
  while ( status != WL_CONNECTED) {
    Serial.print("Attempting to connect to WPA SSID: ");
    Serial.println(ssid);
    // Connect to WPA/WPA2 network
    status = WiFi.begin(ssid, pass);
  }

  // you're connected now, so print out the data
  Serial.println("You're connected to the network");
  Serial.println("Connecting to MQTT Server..");
  client.setServer(broker, 1883);
}

void reconnect(){
  
  
  while(!client.connected()){
    Serial.println("\nConnecting to broker...");
    if(client.connect("1")){
      Serial.println("\nConnected to broker");
    }else{
      Serial.println("\nTrying to connect again");
      delay(5000);
    }
  }
}

void loop()
{
  
  // Read the temperature as Celsius:
  float t = dht.readTemperature();
  float hr = dht.readHumidity();
  
  analogValue = analogRead(analogPin);  // read the input pin
  analogValue2 = analogRead(analogPin2);
  StaticJsonBuffer<300> JSONbuffer;
  JsonObject& JSONencoder = JSONbuffer.createObject();
 
  JSONencoder["T"] = t;
  JSONencoder["HR"] = analogValue;
  JSONencoder["HRDOS"] = analogValue2;
  JSONencoder["HRA"] = hr;
 
  char JSONmessageBuffer[100];
  JSONencoder.printTo(JSONmessageBuffer, sizeof(JSONmessageBuffer));
  Serial.println("Sending message to MQTT topic..");
  Serial.println(JSONmessageBuffer);
  
  if(!client.connected()){
    reconnect();
  }
  client.loop();
  Serial.print("Trying to publish to ");
  Serial.println(broker);
  client.publish(topic, JSONmessageBuffer);
  /*
   Serial.print("Humedad 1: ");
   Serial.println(analogValue);
   Serial.print("Humedad 2: ");
   Serial.println(analogValue2);
   */
  delay(60000);
}
