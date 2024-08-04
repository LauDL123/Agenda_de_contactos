<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contactos";

// Crear la conexión
$mysqli = new mysqli("localhost", "usuario", "contraseña", "agenda_contactos");

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>