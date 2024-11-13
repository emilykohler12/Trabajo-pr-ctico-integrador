<?php
include('../php/config.php');

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

$contador = 0;
$sql = "SELECT * FROM usuario WHERE correo = :correo";
$query = $pdo->prepare($sql);
$query->execute(['correo' => $correo]);
$usuario = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($usuario as $usuarios) {
    $contador++;
    $correo_tabla = $usuarios['correo'];
    $nombre = $usuarios['nombre'];
    $contrasena_tabla = $usuarios['contrasena'];
}

if (($contador > 0) && password_verify($contrasena, $contrasena_tabla)) {
    //echo "datos correctos";
    session_start();
    $_SESSION['session_correo'] = $correo;
    echo '<script> window.location="index.php"; </script>';
} else {
    echo "Datos incorrectos";
    session_start();
    $_SESSION['mensaje'] = "Datos incorrectos";
    echo '<script> window.location="sesion.php"; </script>';
}
?>
