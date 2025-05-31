<?php
session_start();

// Verificar que existan las variables de sesión necesarias
if (!isset($_SESSION['emocion'], $_SESSION['usuario_id'])) {
    echo "<script>
        alert('⚠️ Debes iniciar sesión y seleccionar una emoción primero.');
        window.location.href = 'login.php';
    </script>";
    exit;
}

$emocion = escapeshellarg($_SESSION['emocion']);
$usuario_id = intval($_SESSION['usuario_id']);

// Ejecutar el script Python
$comando = "python3 recomendar_por_emocion.py $emocion $usuario_id";
$output = shell_exec($comando);

// Asegurar codificación UTF-8 para evitar errores con acentos
$output_utf8 = mb_convert_encoding($output, 'UTF-8', 'UTF-8');
$resultado = json_decode($output_utf8, true);

// Validar si el script devolvió recomendaciones
if (!is_array($resultado) || !isset($resultado['recomendaciones'])) {
    echo "<p>Error al obtener recomendaciones. Asegúrate de que el script Python funcione correctamente.</p>";
    echo "<pre>Salida bruta: " . htmlspecialchars($output_utf8) . "</pre>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recomendaciones según tu emoción</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        .libro {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .libro h3 {
            margin: 0 0 10px 0;
        }
        .libro p {
            margin: 0;
        }
    </style>
</head>
<body>
    <h1>📚 Recomendaciones para tu emoción: <em><?= htmlspecialchars($_SESSION['emocion']) ?></em></h1>

    <?php if (count($resultado['recomendaciones']) > 0): ?>
        <?php foreach ($resultado['recomendaciones'] as $libro): ?>
            <div class="libro">
                <h3><?= htmlspecialchars($libro['titulo']) ?> <small>(<?= htmlspecialchars($libro['genero']) ?>)</small></h3>
                <p><?= htmlspecialchars($libro['descripcion']) ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No se encontraron libros que coincidan con esta emoción. Intenta con otra emoción más adelante.</p>
    <?php endif; ?>
</body>
</html>
