<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" type="text/css" href="css_Login.css" />
</head>
<body>
   <div class="container">
       <!-- Formulario de Registro -->
       <div class="Register_Duenio_container">
        <?php
           // Verificar con un mensaje de registro exitoso
           if (isset($_GET['registro']) && $_GET['registro'] === 'exitoso') {
               echo "<script>alert('Registro exitoso');</script>";
           }
           ?>
           <h2>Registrarse</h2>
           <form action="backend_Register.php" method="POST">
              <div class="input-group">
                <label for="register_username">Usuario 🔓</label>
                <input type="text" id="register_username" name="username" required>
              </div>
              <div class="input-group">
                <label for="register_password">Contraseña 🔑</label>
                <input type="password" id="register_password" name="password" required>
              </div>
              <div class="input-group">
                <label for="register_password">Correo electrónico 📧</label>
                <input type="password" id="register_password" name="Correo" required>
              </div>
              <div class="input-group">
                <label for="register_password">Dirección 📍</label>
                <input type="password" id="Dirección" name="Dirección" required>
              </div>
              <div class="input-group">
                <label for="register_password">Teléfono 📱</label>
                <input type="password" id="Teléfono" name="Telefono" required>
              </div>
              <button type="submit">Registrarse</button>
           </form>
           <p>¿Ya tienes una cuenta? <a href="Login_P.php">Inicia sesión aquí</a></p>
           <p>¿Quieres volver a la página principal?<a href="index.php">Vuelve aquí</a></p>
       </div>
   </div>
</body>
</html>