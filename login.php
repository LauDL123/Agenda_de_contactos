<?php
include 'conexion.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $hashed_password);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $id;
        header("Location: contactos.php");
    } else {
        echo "Credenciales incorrectas";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<div class="container">
    <div class="Login_Duenio_container">
        <h2>Iniciar Sesión 🔒</h2>
            <form method="post">
                <div class="input-group">
                <label for="login_username">Correo Electronico 🔓</label>
                <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-group">
                <label for="login_password">Contraseña 🔑</label>
                <input type="password" name="password" placeholder="Contraseña" required>
                </div>
                <button type="submit">Iniciar sesión</button>
            </form>
            <p>¿No estás registrado? <a href="registro.php">Hazlo aquí</a></p>
       </div>
    </div>
</body>
</html>
