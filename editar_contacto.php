<?php
include 'conexion.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$contacto_id = $_GET['id'];

// Obtener datos del contacto actual
$stmt = $conn->prepare("SELECT nombre, telefono, email, direccion FROM contactos WHERE id = ? AND usuario_id = ?");
$stmt->bind_param("ii", $contacto_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$contacto = $result->fetch_assoc();
$stmt->close();

if (!$contacto) {
    echo "Contacto no encontrado.";
    exit();
}

// Procesar el formulario al enviar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];

    $stmt = $conn->prepare("UPDATE contactos SET nombre = ?, telefono = ?, email = ?, direccion = ? WHERE id = ? AND usuario_id = ?");
    $stmt->bind_param("ssssii", $nombre, $telefono, $email, $direccion, $contacto_id, $user_id);
    $stmt->execute();
    $stmt->close();

    header("Location: contactos.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Editar Contacto</title>
</head>
<body>
    <h1>Editar Contacto</h1>
    <link rel="stylesheet" href="style.css">
    <form method="post">
        <input type="text" name="nombre" value="<?= htmlspecialchars($contacto['nombre']) ?>" required>
        <input type="text" name="telefono" value="<?= htmlspecialchars($contacto['telefono']) ?>">
        <input type="email" name="email" value="<?= htmlspecialchars($contacto['email']) ?>">
        <input type="text" name="direccion" value="<?= htmlspecialchars($contacto['direccion']) ?>">
        <button type="submit">Guardar Cambios</button>
    </form>
    <a href="contactos.php">Cancelar</a>
</body>
</html>
