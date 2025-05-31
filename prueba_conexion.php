<?php
$host = "localhost"; // o 127.0.0.1
$usuario = "root"; // Usuario por defecto de XAMPP
$contrasena = ""; // Si no le has puesto contraseña, déjalo vacío
$base_datos = "libreria"; // Reemplaza con el nombre real

// Crear conexión
$conn = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verificar conexión
if ($conn->connect_error) {
    die("❌ Error al conectar: " . $conn->connect_error);
} else {
    echo "✅ Conexión exitosa a la base de datos '$base_datos'";
}

// Cerrar conexión
$conn->close();
?>
