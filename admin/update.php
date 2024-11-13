<?php
include('../php/config.php');
session_start();

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$contrasena = $_POST['contrasena'];
$verificar_contrasena = $_POST['verificar_contrasena'];
$idusuario = $_POST['idusuario'];

// Verifica que la variable $idusuario esté correctamente establecida
if (empty($idusuario)) {
    $_SESSION['mensaje'] = "Error: ID de usuario inválido o no especificado.";
    echo "ID de usuario recibido: " . htmlspecialchars($idusuario);
    header('Location: usuarios_pagina.php');
    exit();
}

try {
    if (!empty($contrasena)) {
        if ($contrasena == $verificar_contrasena) {
            $hashedPassword = password_hash($contrasena, PASSWORD_DEFAULT);
            $sentencia = $pdo->prepare(
                "UPDATE usuario SET nombre = :nombre, correo = :correo, telefono = :telefono, contrasena = :contrasena WHERE idusuario = :idusuario"
            );
            $sentencia->bindParam(':contrasena', $hashedPassword);
        } else {
            $_SESSION['mensaje'] = "Las contraseñas no coinciden.";
            header('Location: editar.php?id=' . $idusuario);
            exit();
        }
    } else {
        $sentencia = $pdo->prepare(
            "UPDATE usuario SET nombre = :nombre, correo = :correo, telefono = :telefono WHERE idusuario = :idusuario"
        );
    }

    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':correo', $correo);
    $sentencia->bindParam(':telefono', $telefono);
    $sentencia->bindParam(':idusuario', $idusuario);

    if ($sentencia->execute()) {
        $_SESSION['mensaje'] = "Se actualizó el usuario correctamente.";
        header('Location: usuarios_pagina.php');
    } else {
        $_SESSION['mensaje'] = "Error al actualizar el usuario.";
        header('Location: editar.php?id=' . $idusuario);
    }
} catch (PDOException $e) {
    $_SESSION['mensaje'] = "Error: " . $e->getMessage();
    header('Location: editar.php?id=' . $idusuario);
    exit();
}
?>
