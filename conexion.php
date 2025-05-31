<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "libreria"; // el nombre de tu base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica si falló la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
