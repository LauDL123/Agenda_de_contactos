<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $email, $password);
    $stmt->execute();
    $stmt->close();
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Registro</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<div class="container">
    <div class="Register_Duenio_container">
    <h2>Registrarse</h2>
        <form method="post">
            <div class="input-group">
                <label for="register_username">Usuario 🔓</label>
                <input type="text" name="nombre" placeholder="Nombre" required>
                </div>
            <div class="input-group">
                <label for="register_email">Correo electrónico 📧</label>
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-group">
                <label for="register_password">Contraseña 🔑</label>
                <input type="password" name="password" placeholder="Contraseña" required>
            </div>
            <button type="submit">Registrarse</button>
        </form>
        <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
       </div>
    </div>
</body>
</html>
