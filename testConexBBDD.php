<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Configuración de conexión

$host='127.0.0.1'; // Cambia si es necesario
$usuario = 'root'; // Cambia este valor si tienes un usuario diferente
$contraseña = 'Elpana.123'; // Cambia a la contraseña correcta
$base_datos = 'dwes'; // El nombre de la base de datos

// Crear la conexión
$conn = new mysqli($host, $usuario, $contraseña, $base_datos);

// Comprobar la conexión
if ($conn->connect_error) {
 die("Error de conexión: " . $conn->connect_error);
} else {
 echo "Conexión exitosa a la base de datos!";
}

// Cerrar la conexión
$conn->close();
?>