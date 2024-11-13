<?php

include('../php/config.php');

$idusuario = $_POST['idusuario'];
$sentencia = $pdo -> prepare ("DELETE FROM usuario WHERE idusuario = :idusuario");
$sentencia->bindParam('idusuario', $idusuario);
$sentencia->execute();
session_start();
$_SESSION['mensaje'] = "Se elimino el usuario de manera correcta";
header('Location: usuarios_pagina.php');

?>