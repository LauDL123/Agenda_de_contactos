<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de contactos</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style_switch.css">
</head>
<body>
   
<div class="theme-switcher">
    <label for="theme-toggle">Modo oscuro:</label>
    <input type="checkbox" id="theme-toggle">
</div>

<div class="container">
    <form action="Formulario_agregar.php" method="post">
        <h1>Agenda de Contactos</h1>
        <div>
            <h2>Añada un nuevo contacto</h2>
            <div>
                <p>Nombre</p>
                <label for="contact_nombre"></label>
                <input type="text" id="contact_nombre" name="nombre" required>
            </div>
            <div>
                <p>Apellido</p>
                <label for="contact_apellido"></label>
                <input type="text" id="contact_apellido" name="apellido" required>
            </div>
            <div>
                <p>Cédula</p>
                <label for="contact_cedula"></label>
                <input type="text" id="contact_cedula" name="cedula" required>
            </div>
            <div>
                <p>Número</p>
                <label for="contact_numero"></label>
                <input type="text" id="contact_numero" name="numero" required>
            </div>
            <div>
                <p>Correo Electrónico</p>
                <label for="contact_correo"></label>
                <input type="email" id="contact_correo" name="correo_electronico" required>
            </div>

            <!-- Campo oculto para el ID del usuario -->
            <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['user_id']; ?>">

            <button id="enviar" type="submit">Guardar</button>
        </div>
    </form>
</div>

<script src="script.js"></script>
</body>
</html>