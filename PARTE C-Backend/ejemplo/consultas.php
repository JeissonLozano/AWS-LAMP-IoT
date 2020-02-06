<?php

    $BaseDeDatos = mysqli_connect("localhost", "root", "mysql.2019.IoT");
    mysqli_select_db($BaseDeDatos,"Datos");
    mysqli_query($BaseDeDatos,"SET NAMES 'utf8'");
                  
    $data = $_POST ['FechaSeleccionada'];
    $year = substr("$data", 0, 4);
    $month = substr("$data", 5, 2);
    $day = substr("$data", 8, 2);

    $consulta = mysqli_query($BaseDeDatos, "SELECT Recibido, Payload FROM Contenido WHERE year(`Recibido`) = '$year' AND month(`Recibido`) = '$month' AND day(`Recibido`) = '$day' AND `Topic`= 'IoT/Temp'");    

?>