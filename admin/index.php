<?php
include ('../php/config.php');
include_once('usuarios.php');
session_start();
if (isset($_SESSION['session_correo'])) {
    //echo "Si existe sesion de ".$_SESSION['sesion_email'];
    $correo_session = $_SESSION['session_correo'];
    $sql = "SELECT * FROM usuario WHERE correo = '$correo_session' ";
    $query = $pdo -> prepare ($sql);
    $query -> execute();
    $usuario = $query -> fetchAll (PDO::FETCH_ASSOC);
    foreach ($usuario as $usuarios) {
        $nombre_session = $usuarios['nombre'];
    }
} else {
    echo '<script> window.location="sesion.php"; </script>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administrador de Freddy Motos</title>
  <link rel="icon" href="../img/logo.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../adminlte/dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="hold-transition sidebar-mini">

<script>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Bienvenido/a! <?php echo $nombre_session; ?>",
        showConfirmButton: false,
        timer: 1500
    });
</script>

<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="../img/logo.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
      <span class="brand-text font-weight-light">Freddy Motos</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="" class="img" alt="usuario">
        </div>
        <div class="info">
          <a href="" class="d-block"><?php echo $nombre_session; ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Buscar" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-archive"></i>
              <p>
                Productos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categorias</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Marcas</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="usuarios_pagina.php" class="nav-link"><i class="nav-icon fas fa-users"></i>
              <p>Usuarios</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="registro.php" class="nav-link"><i class="nav-icon fas fa-edit"></i>
              <p>Crear Usuario</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Administrador de Freddy Motos</h1>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Categorias</h3>
                <p>Categorias Registradas</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="categorias.php" class="small-box-footer">  Ir  <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Marcas<sup style="font-size: 20px"></sup></h3>
                <p>Marcas Registradas</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="marcas.php" class="small-box-footer">  Ir  <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Usuarios<sup style="font-size: 20px"></sup></h3>
                <p>Usuarios Registrados</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="usuarios_pagina.php" class="small-box-footer">  Ir  <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
          </div>
        </div>
      </div>
    </div>

  <aside class="control-sidebar control-sidebar-dark">
    <div class="p-3 dropdown">
    <img src="" alt="Imagen del Usuario" class="img-circle" style="width: 50px; height: 50px;">
    <br>
    <span class="d-none d-md-inline ms-2"><?php echo $nombre_session; ?></span>
    <br>
    <a href="perfil.php" class="btn btn-primary btn-sm me-2">Perfil</a>
    <br>
    <br>
    <a href="configuracion.php" class="btn btn-secondary btn-sm me-2">Configuración</a>
    <br>
    <br>
    <a href="cerrarsesion.php" class="btn btn-danger btn-sm">Cerrar sesión</a>
</div>

  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../adminlte/dist/js/adminlte.min.js"></script>

</body>
</html>
