<?php
include('../php/config.php');
include_once('usuarios.php');
include('editar_usuario.php');
session_start();

if (isset($_SESSION['session_correo'])) {
    $correo_session = $_SESSION['session_correo'];
    $sql = "SELECT * FROM usuario WHERE correo = :correo";
    $query = $pdo->prepare($sql);
    $query->bindParam(':correo', $correo_session);
    $query->execute();
    $usuario = $query->fetch(PDO::FETCH_ASSOC);
    
    if ($usuario) {
        $nombre_session = $usuario['nombre'];
    } else {
        echo "Error: Usuario no encontrado.";
        exit;
    }
} else {
    echo '<script> window.location="sesion.php"; </script>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administrador de Freddy Motos</title>
  <link rel="icon" href="../img/logo.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="../adminlte/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../adminlte/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar and Sidebar omitted for brevity -->

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Administrador de Freddy Motos</h1>
          </div>
        </div>

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Editar usuario: <?php echo htmlspecialchars($nombre); ?> </h3>
          </div>
          <div class="card-body">
            <form action="update.php" method="POST">
              <!-- Campo oculto para enviar el ID del usuario -->
              <input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">
              
              <div class="row g-3">
                <div class="col-md-6">
                  <label for="nombre" class="form-label">Nombre y apellido</label>
                  <input type="text" class="form-control" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>
                </div>
                
                <div class="col-md-6">
                  <label for="correo" class="form-label">Correo Electrónico</label>
                  <input type="email" class="form-control" name="correo" value="<?php echo htmlspecialchars($correo); ?>" required>
                </div>
                
                <div class="col-md-6">
                  <label for="telefono" class="form-label">Teléfono</label>
                  <input type="text" class="form-control" name="telefono" value="<?php echo htmlspecialchars($telefono); ?>" required>
                </div>
                
                <div class="col-md-6">
                  <label for="contrasena" class="form-label">Contraseña</label>
                  <input type="password" class="form-control" name="contrasena" required>
                </div>
                
                <div class="col-md-6">
                  <label for="verificar_contrasena" class="form-label">Verificar Contraseña</label>
                  <input type="password" class="form-control" name="verificar_contrasena" required>
                </div>
              </div>

              <div class="card-footer">
                <button class="btn btn-info" type="submit">Editar Usuario</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Control Sidebar and Scripts omitted for brevity -->
</body>
</html>
