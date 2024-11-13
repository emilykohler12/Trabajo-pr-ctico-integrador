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
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../adminlte/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index.php" class="brand-link">
      <img src="../img/logo.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
      <span class="brand-text font-weight-light">Freddy Motos</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="" class="img" alt="usuario">
          <br>
        </div>
        <div class="info">
          <a href="" class="d-block"><?php echo isset($nombre_session) ? $nombre_session : 'Usuario no autenticado'; ?></a>
        </div>
      </div>

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
                <a href="categorias.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categorias</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="marcas.php" class="nav-link active">
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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1 class="m-0">Administrador de Freddy Motos</h1>
            <br>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Usuarios Registrados</h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                      <th style="width: 10px">Numero</th>
                      <th>Nombre</th>
                      <th>Correo electronico</th>
                      <th>Telefono</th>
                      <th>Rol</th>
                      <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
    <?php
    $contador = 0;
    foreach ($datos_usuario as $usuarios_dato) { 
        $idusuario = $usuarios_dato['idusuario']; ?>
        <tr class="align-middle">
            <td><?php echo ++$contador; ?></td>
            <td><?php echo $usuarios_dato['nombre']; ?></td>
            <td><?php echo $usuarios_dato['correo']; ?></td>
            <td><?php echo $usuarios_dato['telefono']; ?></td>
            <td><?php echo $usuarios_dato['nombre_rol']; ?></td> <!-- Nombre del rol -->
            <td>
                <center>
                    <div class="btn-group">
                        <a href="editar.php?id=<?php echo $idusuario; ?>" type="button" class="btn btn-success">Editar</a>
                        <form action="borrar.php" method="post"> 
                            <input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">
                            <button type="submit" class="btn btn-danger">Borrar</button>
                        </form>
                    </div>
                </center>
            </td>
        </tr>
    <?php 
    }
    ?>
</tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  

  <aside class="control-sidebar control-sidebar-dark">
    <div class="p-3 dropdown">
        <img src="" alt="usuario" class="img-circle" style="width: 50px; height: 50px;">
        <br>
        <span class="d-none d-md-inline ms-2"><?php echo isset($nombre_session) ? $nombre_session : 'Usuario no autenticado'; ?></span>
        <br>
        <a href="" class="btn btn-primary btn-sm me-2">Perfil</a>
        <br>
        <br>
        <a href="" class="btn btn-secondary btn-sm me-2">Configuración</a>
        <br>
        <br>
        <a href="cerrarsesion.php" class="btn btn-danger btn-sm">Cerrar sesión</a>
    </div>
  </aside>
</div>

<!-- jQuery -->
<script src="../adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../admilte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../adminlte/plugins/jszip/jszip.min.js"></script>
<script src="../adminlte/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../adminlte/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../adminlte/dist/js/adminlte.min.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "buttons": ["copy", "excel", "pdf", "print", "colvis"],
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "excel": "Exportar a Excel",
                "pdf": "Exportar a PDF",
                "print": "Imprimir",
                "colvis": "Visibilidad de columnas"
            }
        }
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});
</script>
</body>
</html>
