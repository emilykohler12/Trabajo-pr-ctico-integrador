<?php
// Conexión a la base de datos
include('db.php');

// Recibir datos desde AJAX
$idcategoria = $_POST['idcategoria'];
$nombre_categoria = isset($_POST['nombre_categoria']) ? $_POST['nombre_categoria'] : null;
$descripcion_categoria = isset($_POST['descripcion_categoria']) ? $_POST['descripcion_categoria'] : null;

// Construir la consulta SQL solo con los campos que se modifican
$query = "UPDATE categorias SET ";

$updateFields = [];
if ($nombre_categoria !== null) {
    $updateFields[] = "nombre_categoria = '$nombre_categoria'";
}

if ($descripcion_categoria !== null) {
    $updateFields[] = "descripcion_categoria = '$descripcion_categoria'";
}

// Verificamos si se deben actualizar campos
if (!empty($updateFields)) {
    // Construir la consulta con los campos a actualizar
    $query .= implode(", ", $updateFields) . " WHERE idcategoria = $idcategoria";

    // Ejecutar la consulta
    if (mysqli_query($conn, $query)) {
        echo "Categoría actualizada con éxito";
    } else {
        echo "Error al actualizar categoría: " . mysqli_error($conn);
    }
} else {
    echo "No se enviaron cambios para actualizar";
}

?>
