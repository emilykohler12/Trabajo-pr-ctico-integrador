<?php
include('../php/config.php');

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$contrasena = $_POST['contrasena'];
$verificar_contrasena = $_POST['verificar_contrasena'];

session_start();

$sentencia = $pdo->prepare("SELECT * FROM usuario WHERE correo = :correo");
$sentencia->bindParam(':correo', $correo);
$sentencia->execute();
$usuarioExistente = $sentencia->fetch(PDO::FETCH_ASSOC);

if ($usuarioExistente) {
    $_SESSION['mensaje'] = "El correo ya está registrado. Intente con otro.";
    header('Location: registro.php');
    exit();
}

if ($contrasena == $verificar_contrasena) {
    $contrasena = password_hash($contrasena, PASSWORD_DEFAULT);

    $sentencia = $pdo->prepare("INSERT INTO usuario (nombre, correo, telefono, contrasena) VALUES (:nombre, :correo, :telefono, :contrasena)");
    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':correo', $correo);
    $sentencia->bindParam(':telefono', $telefono);
    $sentencia->bindParam(':contrasena', $contrasena);

    // Redirige al index.php si el registro es exitoso
    if ($sentencia->execute()) {
        header('Location: index.php');
        exit();
    }
} else {
    $_SESSION['mensaje'] = "Las contraseñas no coinciden";
    header('Location: registro.php');
    exit();
}
?>
