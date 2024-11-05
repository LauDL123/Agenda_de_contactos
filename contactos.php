<?php
include 'conexion.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Obtener el nombre del usuario
$stmt = $conn->prepare("SELECT nombre FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($nombre_usuario);
$stmt->fetch();
$stmt->close();

// Agregar un contacto
if (isset($_POST['agregar'])) {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];

    $stmt = $conn->prepare("INSERT INTO contactos (usuario_id, nombre, telefono, email, direccion) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $user_id, $nombre, $telefono, $email, $direccion);
    $stmt->execute();
    $stmt->close();
}

// Obtener contactos
$stmt = $conn->prepare("SELECT id, nombre, telefono, email, direccion FROM contactos WHERE usuario_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$contactos = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>
<!DOCTYPE html>
<html lang="es">
    <link rel="stylesheet" href="style.css">
<head>
    <title>Agenda de Contactos</title>
</head>
<body>

    <header>
        <h2>Bienvenido, <?= htmlspecialchars($nombre_usuario) ?>!</h2>
    </header>

    <h1>Mis Contactos</h1>
    <form method="post">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="telefono" placeholder="Teléfono">
        <input type="email" name="email" placeholder="Email">
        <input type="text" name="direccion" placeholder="Dirección">
        <button type="submit" name="agregar">Agregar</button>
    </form>
        
    <table>
        <tr>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Dirección</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($contactos as $contacto): ?>
            <tr>
                <td><?= htmlspecialchars($contacto['nombre']) ?></td>
                <td><?= htmlspecialchars($contacto['telefono']) ?></td>
                <td><?= htmlspecialchars($contacto['email']) ?></td>
                <td><?= htmlspecialchars($contacto['direccion']) ?></td>
                <td>
                    <a href="editar_contacto.php?id=<?= $contacto['id'] ?>">Editar</a>
                    <a href="eliminar_contacto.php?id=<?= $contacto['id'] ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este contacto?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div><a href="logout.php">Cerrar Sesión</a></div>
</body>
</html>
