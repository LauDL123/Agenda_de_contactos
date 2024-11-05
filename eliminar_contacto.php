<?php
include 'conexion.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$contacto_id = $_GET['id'];

// Verificar si el contacto existe y pertenece al usuario
$stmt = $conn->prepare("DELETE FROM contactos WHERE id = ? AND usuario_id = ?");
$stmt->bind_param("ii", $contacto_id, $user_id);
$stmt->execute();
$stmt->close();

header("Location: contactos.php");
exit();
?>
