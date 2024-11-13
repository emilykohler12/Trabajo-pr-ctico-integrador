<?php

include('../php/config.php');

if (isset($_POST['idcategoria'])) {
    $idcategoria = $_POST['idcategoria'];

    // Prepara y ejecuta la eliminación
    $sentencia = $pdo->prepare("DELETE FROM categoria WHERE idcategoria = :idcategoria");
    $sentencia->bindParam('idcategoria', $idcategoria);
    $sentencia->execute();

    // Inicia sesión y configura el mensaje de éxito
    session_start();
    $_SESSION['mensaje'] = "Se eliminó la categoría de manera correcta";

    // Usar JavaScript para redirigir y mostrar SweetAlert
    echo "<script>
        window.location.href = 'categorias.php?eliminado=1';
    </script>";
    exit();
} else {
    // Si no hay ID de categoría
    session_start();
    $_SESSION['mensaje'] = "No se encontró la categoría.";
    header('Location: categorias.php');
    exit();
}
?>
