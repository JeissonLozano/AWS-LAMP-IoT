//Ejemplo MQTT-WebSocket & ESP8266 y la tarjeta de entrenamiento 

//--------------Librerias---------------------------------------- 

#include <ESP8266WiFi.h>
#include <PubSubClient.h>
#include <stdlib.h>
 
//-------------------VARIABLES GLOBALES--------------------------
int contconexion = 0;

const char* ssid = "NOMBRE DE LA RED";
const char* password = "CONTRASEÑA";
const char* mqtt_server = "sERVIDOR AWS";
const int mqttPort = 1883;
 
WiFiClient espClient;
PubSubClient client(espClient);

//Para el sensor de temperatura
unsigned long previousMillis = 0;
String strtemp = "";

//---------------------------  CALLBACK ------------------------------------------------

void callback(char* topic, byte* payload, unsigned int length) {
 char PAYLOAD[5] = "    ";

if( String(topic) == "IoT/Led1"){
  if(payload[1] == 'N'){ //Cuando llegue un ON
    digitalWrite(5, HIGH);
  }
  if(payload[1] == 'F'){ //Cuando llegue un OFF
    digitalWrite(5, LOW);
  }
}
if( String(topic) == "IoT/Led2"){
  if(payload[1] == 'N'){ //Cuando llegue un ON
    digitalWrite(4, HIGH);
  }
  if(payload[1] == 'F'){ //Cuando llegue un OFF
    digitalWrite(4, LOW);
  }
}

}

//------------------------------------------------------------------------------

void reconnect() {
  // Loop hasta que nos reconectemos
    while (!client.connected()) 
    {
        Serial.print("Conectando MQTT...");
              
        if (client.connect("IoT-ESP8266-B")) 
        {
          Serial.println("Conectado");
          client.subscribe("inTopic");
          client.subscribe("IoT/Led1");
          client.subscribe("IoT/Led2");
        } 
        
        else 
        {
          Serial.print("Error de conexion");
          Serial.print(client.state());
          delay(2000);
        }
    }
}

//--------------------------------------------------------------------------------------

void setup() {

  Serial.begin(115200); //Start Serial

  pinMode(5,OUTPUT); //D1 Como salida
  digitalWrite(5, LOW);

  pinMode(4,OUTPUT); //D2 Como salida
  digitalWrite(4, LOW);
  
  // Conexión WIFI
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED and contconexion <50) 
  { //Cuenta hasta 50 si no se puede conectar lo cancela
    ++contconexion;
    delay(500);
    Serial.print(".");
  }
      if (contconexion <50) 
    {       
        Serial.println("");
        Serial.println("WiFi conectado");
        Serial.println(WiFi.localIP());
    }
  
      else 
      { 
          Serial.println("");
          Serial.println("Error de conexion");
      }
  
    
  client.setServer(mqtt_server, mqttPort);
  client.setCallback(callback);
  


}
 
void loop() {

  if (!client.connected()) 
    {
      reconnect();
    }
  
  client.loop();

  // ----------------------------------------

   unsigned long currentMillis = millis();
    
  if (currentMillis - previousMillis >= 4000) 
  { //envia la temperatura cada 1 segundos
    previousMillis = currentMillis;
    int analog = analogRead(17);
    float temp = analog*0.322265625;
    strtemp = String(temp, 1); //1 decimal
    char tempstring[3];
    dtostrf(temp,3,1,tempstring);
    Serial.println("Enviando: [IoT/Temp] " + strtemp);
    client.publish("IoT/Temp", tempstring);
  }

  // ----------------------------------------

}