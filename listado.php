<?php
// Mostrar errores durante la depuración (quitar en producción)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conexión a la base de datos
$dsn = 'mysql:host=127.0.0.1;port=3306;dbname=dwes;charset=utf8';
$usuario = 'root';
$clave = 'Elpana.123';

try {
    $pdo = new PDO($dsn, $usuario, $clave);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    // En un entorno real, no mostrarías el error detallado al usuario
    die("<div class='container'><p>Error de conexión a la base de datos. Por favor, inténtelo más tarde.</p></div>");
}

// Obtener familias para el desplegable
try {
    $stmt = $pdo->query("SELECT cod, nombre FROM familia ORDER BY nombre ASC");
    $familias = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    http_response_code(500);
    die("<div class='container'><p>Error al obtener las familias.</p></div>");
}

// Procesar selección de familia
$productos = [];
$familia_seleccionada = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['familia'])) {
    $familia_seleccionada = $_POST['familia'];
    if (!empty($familia_seleccionada)) {
        try {
            $stmt = $pdo->prepare("SELECT cod, nombre_corto, PVP FROM producto WHERE familia = ? ORDER BY nombre_corto ASC");
            $stmt->execute([$familia_seleccionada]);
            $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            http_response_code(500);
            die("<div class='container'><p>Error al obtener los productos.</p></div>");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Productos</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap');

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            background-color: #f8f9fa;
            color: #212529;
            margin: 0;
            padding: 2rem;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 800px;
            background-color: #ffffff;
            padding: 2rem 2.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        h1 {
            color: #343a40;
            margin-bottom: 0.5rem;
            text-align: center;
        }
        
        .subtitle {
            text-align: center;
            color: #6c757d;
            margin-bottom: 2rem;
        }

        form {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2.5rem;
            flex-wrap: wrap;
        }

        label {
            font-weight: 500;
            color: #495057;
        }

        select, button {
            padding: 0.65rem 1rem;
            border-radius: 6px;
            border: 1px solid #ced4da;
            font-size: 1rem;
            transition: all 0.2s ease-in-out;
            height: 40px;
        }

        select {
            min-width: 220px;
        }

        select:focus, button:focus {
            outline: none;
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        button {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
            cursor: pointer;
            font-weight: 500;
        }

        button:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th, td {
            padding: 0.9rem 1rem;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
            vertical-align: middle;
        }

        th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #495057;
            border-top: 1px solid #dee2e6;
        }

        tr:hover {
            background-color: #f1f3f5;
        }

        td a {
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
            padding: 0.3rem 0.6rem;
            border-radius: 4px;
            border: 1px solid transparent;
        }

        td a:hover {
            background-color: #e7f3ff;
            border-color: #cce5ff;
            text-decoration: none;
        }

        .no-products {
            text-align: center;
            font-size: 1.1rem;
            color: #6c757d;
            padding: 2rem;
            background-color: #f8f9fa;
            border-radius: 6px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Listado de Productos</h1>
        <p class="subtitle">Seleccione una familia para ver los productos asociados.</p>
        
        <form method="post">
            <label for="familia">Familia:</label>
            <select name="familia" id="familia" onchange="this.form.submit()">
                <option value="">-- Seleccione una --</option>
                <?php foreach ($familias as $f): ?>
                    <option value="<?= htmlspecialchars($f['cod']) ?>"
                        <?= ($familia_seleccionada == $f['cod']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($f['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <noscript><button type="submit">Mostrar</button></noscript>
        </form>

        <?php if (!empty($productos)): ?>
            <h2>Productos de la familia</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>PVP (€)</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?= htmlspecialchars($producto['nombre_corto']) ?></td>
                            <td><?= htmlspecialchars(number_format($producto['PVP'], 2, ',', '.')) ?></td>
                            <td>
                                <a href="editar.php?cod=<?= urlencode($producto['cod']) ?>">Editar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
            <p class="no-products">No hay productos para la familia seleccionada.</p>
        <?php endif; ?>
    </div>
</body>
</html>
