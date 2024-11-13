<?php
$sql_usuarios = "
    SELECT usuario.*, rol.rol AS nombre_rol
    FROM usuario
    JOIN rol ON usuario.idrol = rol.idrol
";
$query_usuarios = $pdo->prepare($sql_usuarios);
$query_usuarios->execute();
$datos_usuario = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);
?>
