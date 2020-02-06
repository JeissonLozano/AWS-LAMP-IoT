<?php
require 'consultas.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ejemplo Guía 5</title>
    <!-- Librerias de CSS -->
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Librerias de JavaScript -->
    <script src="js/mqttws31.js"></script>
    <script src="https://momentjs.com/downloads/moment.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
</head>
<body>

 <!-- Inicio Grid Layout -->

 <div class="container">
     <div class="row">
         <!-- Inicio Grafica1 -->
         <div class="col-md-6">
             <div class="card">
                 <div class="card-body">
                     <div class="chart-container">
                         <canvas id="grafica1" style="display: block; height: 250px; width: 250px;"></canvas>
                     </div>
                 </div>
             </div>
         </div>
         <!-- Fin Grafica1 -->

         <!-- Inicio Sección de LEDS -->
         <div class="col-md-6">
             <div class="card">
                 <div class="card-body">
                     <h5 class="card-title">Sección de LEDS</h5>

                    <ul class="list-group list-group-flush">
                        <!-- Inicio Item 1 -->
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <h5>Led 1</h5>
                            <label class="switch ml-auto">
                                <main>
                                    <input class="l" type="checkbox" onclick="OnOff()">
                                </main>   
                            </label>
                        </li>
                        <!-- Fin Item 1 -->

                        <!-- Inicio Item 2 -->
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <h5>Led 2</h5>
                            <label class="switch ml-auto">
                                <main>
                                    <input class="l" type="checkbox" onclick="OnOff2()">
                                </main>   
                            </label>
                        </li>
                        <!-- Fin Item 2 -->
                    </ul>

                 </div>
             </div>
         </div>
         <!-- Fin Sección de LEDS -->

         <!-- Inicio Grafica2 -->
         <div class="col-md-6">
             <div class="card">
                 <div class="card-body">
                     <!-- Inicio del formulario -->
                     <form method="post">
                         <input type="date" name="FechaSeleccionada" class="btn btn-outline-primary">
                         <input type="submit" name="Enviar" class="btn btn-outline-primary">
                     </form>
                     <!-- Fin del formulario -->
                     <div class="chart-container">
                         <canvas id="grafica2" style="display: block; height: 250px; width: 250px;"></canvas>
                     </div>
                 </div>
             </div>
         </div>
         <!-- Fin Grafica2 -->
     </div>
 </div>

 <!-- Fin del Grid Layout -->   

 <script src="js/iot-mqtt.js"></script>
 <?php
require 'graficas.php';
?>
</body>
</html>