<?php
// Lee las variables de entorno de Render
$host = getenv('DB_HOST');
$db   = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASSWORD');
$port = getenv('DB_PORT');
$charset = 'utf8mb4'; // Es una buena práctica definir el charset

// Define el "Data Source Name" (DSN)
$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";

try {
    // Crea la conexión PDO
    $conn = new PDO($dsn, $user, $pass);
    
    // Configura PDO para que lance excepciones en caso de error
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // Si la conexión falla, detiene el script y muestra el error
    die("❌ Error de conexión a la base de datos: " . $e->getMessage());
}
?>