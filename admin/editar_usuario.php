<?php
include('../php/config.php');

if (isset($_GET['idusuario']) && is_numeric($_GET['idusuario'])) {
    $id = $_GET['idusuario'];
    try {
        $sql = "SELECT * FROM usuario WHERE id = :idusuario";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idusuario', $id, PDO::PARAM_INT); // Usa `$id` aquí
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            die("Usuario no encontrado.");
        }
    } catch (PDOException $e) {
        echo "Error en la consulta: " . $e->getMessage();
    }
} else {
    die("Error: ID inválido o no definido.");
}
?>
