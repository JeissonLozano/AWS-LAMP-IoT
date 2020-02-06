var clientId = "ws" + Math.random();
// Create a client instance
var client = new Paho.MQTT.Client("100.25.254.82", 9001, clientId);

// set callback handlers
client.onConnectionLost = onConnectionLost;
client.onMessageArrived = onMessageArrived;

// connect the client
client.connect({onSuccess:onConnect});
ValorTemperatura = -1;
// Función para publicar el estado del Led
EstadoLed1 = "OFF";
EstadoLed2 = "OFF";

function OnOFF(){
  if(EstadoLed1 == "OFF"){
    message = new Paho.MQTT.Message("ON");
    message.destinationName = 'IoT/Led1'
    client.send(message);
  }
  else if (EstadoLed1 == "ON"){
    message = new Paho.MQTT.Message("OFF");
    message.destinationName = 'IoT/Led1'
    client.send(message);
  }
};
function OnOFF1(){
  if(EstadoLed2 == "OFF"){
    message = new Paho.MQTT.Message("ON");
    message.destinationName = 'IoT/Led2'
    client.send(message);
  }
  else if (EstadoLed2 == "ON"){
    message = new Paho.MQTT.Message("OFF");
    message.destinationName = 'IoT/Led2'
    client.send(message);
  }
};

// called when the client connects
function onConnect() {
  console.log("Conectado MQTT-WebSocket");
    client.subscribe("IoT/Temp");
    client.subscribe("IoT/Led1");
    client.subscribe("IoT/Led2");
}

// called when the client loses its connection
function onConnectionLost(responseObject) {
  if (responseObject.errorCode !== 0) {
    console.log("Conexión perdida:"+responseObject.errorMessage);
  }
}

// called when a message arrives
function onMessageArrived(message) {
  console.log(message.destinationName + ": " + message.payloadString);
    
  if(message.destinationName == 'IoT/Temp')
    {
        ValorTemperatura = parseFloat(message.payloadString);
    }
  if(message.destinationName == 'IoT/Led1')
    {
      EstadoLed1 = message.payloadString;
    }
  if(message.destinationName == 'IoT/Led2')
    {
      EstadoLed2 = message.payloadString;
    }
    
}
