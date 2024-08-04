<?php
// Formulario_agregar.php

// Iniciar sesión
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    die("Acceso denegado. Inicie sesión para agregar contactos.");
}

// Conectar a la base de datos
$mysqli = new mysqli("localhost", "usuario", "contraseña", "agenda_contactos");

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
}

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanitizar los datos del formulario
    $nombre = $mysqli->real_escape_string($_POST['nombre']);
    $apellido = $mysqli->real_escape_string($_POST['apellido']);
    $cedula = $mysqli->real_escape_string($_POST['cedula']);
    $numero = $mysqli->real_escape_string($_POST['numero']);
    $correo_electronico = $mysqli->real_escape_string($_POST['correo_electronico']);
    $id_usuario = intval($_POST['id_usuario']);

    // Preparar y ejecutar la consulta de inserción
    $stmt = $mysqli->prepare("INSERT INTO contactos (nombre, apellido, cedula, numero, correo_electronico, id_usuario) VALUES (?, ?, ?, ?, ?, ?)");
    
    if ($stmt) {
        $stmt->bind_param("sssssi", $nombre, $apellido, $cedula, $numero, $correo_electronico, $id_usuario);
        
        if ($stmt->execute()) {
            echo "Contacto agregado exitosamente.";
        } else {
            echo "Error al agregar el contacto: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $mysqli->error;
    }

    $mysqli->close();
} else {
    echo "Método de solicitud no válido.";
}
?>
