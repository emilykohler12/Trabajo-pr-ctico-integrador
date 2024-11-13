<?php 
include('../php/config.php');

// Consulta para obtener todas las categorías (si es necesario)
$sql_categorias = "SELECT * FROM categoria";
$query_categorias = $pdo->prepare($sql_categorias);
$query_categorias->execute();
$datos_categorias = $query_categorias->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_categoria = isset($_POST['nombre_categoria']) ? $_POST['nombre_categoria'] : '';
    $descripcion_categoria = isset($_POST['descripcion_categoria']) ? $_POST['descripcion_categoria'] : '';

    // Insertar en la base de datos
    $sentencia = $pdo->prepare("INSERT INTO categoria (nombre_categoria, descripcion_categoria) VALUES (:nombre_categoria, :descripcion_categoria)");
    $sentencia->bindParam(':nombre_categoria', $nombre_categoria);
    $sentencia->bindParam(':descripcion_categoria', $descripcion_categoria);

    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje_categoria'] = "Se creó la nueva categoría";
        $_SESSION['icono'] = "success";

        // Redireccionar a categorias.php después de la inserción
        header('Location: categorias.php');
        exit; // Asegura que el script se detenga después de redirigir
    } else {
        session_start();
        $_SESSION['mensaje_categoria'] = "Error al crear la categoría";
        $_SESSION['icono'] = "error";

        // Redireccionar en caso de error
        header('Location: categorias.php');
        exit;
    }
}
?>
