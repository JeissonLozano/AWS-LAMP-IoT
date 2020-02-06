# AWS LAMP IoT MQTT WebSocket

En esta cuarta etapa está divida en tres partes:

1- Programación del microcontrolador ESP8266.

2- Desarrollaremos del lado del cliente Frontend

3- Desarrollaremos del lado del servidor y del cliente con PHP y la conexión a la base de datos con MySQL a traves de un puente creado en un script en PHP.

# A continuación el esquema de conexión: 
![ESQUEMA DE CONEXIÓN ESP8266](https://github.com/JeissonLozano/AWS-LAMP-IoT/blob/master/CONEXI%C3%93N.png)

# Ejemplo de Frontend y Backend Usando MQTT y WebScocket
- En el lado del cliente se usó HTML5, CSS3 y JavaScript
- En el lado del servidor se usó PHP y en la base de datos MySQL.
[![](http://img.youtube.com/vi/SMA4ok8lX1c/0.jpg)](http://www.youtube.com/watch?v=SMA4ok8lX1c "EJEMPLO FRONTEND Y BACKEND USANDO MQTT-WEBSOCKET")
 
# A continuación video paso a paso de instalación LAMP en el servidor de AWS:
[![](http://img.youtube.com/vi/SMA4ok8lX1c/0.jpg)](http://www.youtube.com/watch?v=SMA4ok8lX1c "LAMP guía de instalación AWS")

# Listado de comandos usados para instalar base de datos MySQL + PHP + PHPMyAdmin

-Comenzamos instalando php y sus librerias:
 ```
$ apt-get install libapache2-mod-php php7.0-mbstring php-gettext php7.0-dev
$ phpize
```
-Instalamos MySQL donde nos pedirá una contraseña para acceder a la base de datos:
```
$ apt-get install mysql-server mysql-client libmysqlclient-dev 
```
*Instalamos phpmyadmin con la contraseña de MySQl
```
$ apt-get install phpmyadmin
$ ln -s /usr/share/phpmyadmin /var/www/html
```
-Damos los permisos para poder escribir sobre esta carpeta:
```
$ chmod 777 -R /var/www/html
$ service apache2 restart
```

-Adicional podemos subir nuestros proyectos por FTP con la siguiente explicación.
```
https://filezilla-project.org/
```
-Luego se configura filezilla con la ip de nuestro servidor de AWS

# Integrar MQTT y MySQL con PHP
```
https://www.hivemq.com/blog/mqtt-client-library-encyclopedia-mosquitto-php/

https://github.com/mgdm/Mosquitto-PHP

$ apt-add-repository ppa:mosquitto-dev/mosquitto-ppa
$ apt-get update
$ apt-get install libmosquitto-dev
$ pecl install Mosquitto-alpha

$ nano /etc/php/7.0/cli/php.ini
Agregamos lo siguiente en php.ini
----------------------------------
extension=mosquitto.so 
---------------------------------
```
-En PHPMyAdmin creamos una tabla 
```
CREATE TABLE `Datos`.`Contenido` ( 
`Id` INT(10) NOT NULL AUTO_INCREMENT ,  
`Topic` VARCHAR(20) NOT NULL ,  
`Payload` VARCHAR(20) NOT NULL ,  
`Recibido` TIMESTAMP NOT NULL ,    
PRIMARY KEY  (`Id`)) ENGINE = InnoDB DEFAULT CHARSET=utf8;
```

-Insertar en MySQL
```
INSERT INTO `Contenido` (`Id`, `Topic`, `Payload`, `Recibido`) VALUES (NULL, 'temp', '20.15', CURRENT_TIMESTAMP);
```
-EN PHP
```
INSERT INTO Contenido (Id, Topic, Payload, Recibido) VALUES (NULL, ?, ?, CURRENT_TIMESTAMP);
```
-Creamos una tarea para que se ejecute nuestro codigo en segundo plano.
```
$crontab -e 
------------------------------------------------------------
@reboot ( sleep 90 ; php -q /var/www/html/mqtt-mysql.php )
------------------------------------------------------------
```
Para configurar la hora del servidor..
```
$ sudo dpkg-reconfigure tzdata
America
Bogota
```
## Construido con 🛠️
* [VsCode](https://code.visualstudio.com/) - Editor de texto Visual Studio Code
* [PlatformIO](https://platformio.org/) - PlatformIO IDE

## Autor ✒️
* **Jeisson Lozano** - *Desarrollador* - [Jeisson Lozano](https://github.com/JeissonLozano)

