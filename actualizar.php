<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizando Producto</title>
    <style>
        body { font-family: sans-serif; padding: 20px; text-align: center; }
        .mensaje { padding: 15px; border-radius: 5px; margin: 20px auto; max-width: 500px; }
        .proceso { background-color: #e7f3fe; border-left: 6px solid #2196F3; }
        .exito { background-color: #dff0d8; border-left: 6px solid #4CAF50; }
        .error { background-color: #f2dede; border-left: 6px solid #f44336; }
        a { color: #007bff; text-decoration: none; font-size: 1.2em; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<h1>Proceso de Actualización</h1>

<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['accion']) || $_POST['accion'] !== 'actualizar') {
    echo "<div class='mensaje error'>Acceso no permitido.</div>";
    echo "<a href='listado.php'>Volver al listado</a>";
    exit;
}

echo "<div class='mensaje proceso'>Actualizando producto... Por favor, espere.</div>";
flush();
ob_flush();

// Conexión a la base de datos
require_once 'conexion.php';

// Recoge los datos del formulario
$cod = $_POST['cod'];
$nombre_corto = $_POST['nombre_corto'] ?? '';
$nombre = $_POST['nombre'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$PVP = floatval($_POST['PVP'] ?? 0);
$familia = $_POST['familia'] ?? '';

// Preparar y ejecutar la actualización
$sql = "UPDATE producto SET nombre_corto = ?, nombre = ?, descripcion = ?, PVP = ?, familia = ? WHERE cod = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $params = [$nombre_corto, $nombre, $descripcion, $PVP, $familia, $cod];
    
    // Simular un retraso para que el usuario vea el mensaje
    sleep(1); 

    if ($stmt->execute($params)) {
        echo "<div class='mensaje exito'>¡Finalizado! El producto ha sido actualizado correctamente.</div>";
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "<div class='mensaje error'>Error al ejecutar la actualización: " . htmlspecialchars(implode(' | ', $errorInfo)) . "</div>";
    }
    $stmt = null;
} else {
    $errorInfo = $conn->errorInfo();
    echo "<div class='mensaje error'>Error al preparar la consulta: " . htmlspecialchars(implode(' | ', $errorInfo)) . "</div>";
}

$conn = null;
?>

<br>
<a href="listado.php">Volver al listado de productos</a>

</body>
</html>