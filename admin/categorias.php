<?php
include ('../php/config.php');
include_once('usuarios.php');
include('categorias_funcion.php');
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
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="../adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../adminlte/plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../adminlte/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- jQuery -->
  <script src="../adminlte/plugins/jquery/jquery.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">

<?php
    // Verifica si el parámetro 'eliminado' está presente en la URL
    if (isset($_GET['eliminado']) && $_GET['eliminado'] == 1) {
        // Muestra el SweetAlert de éxito
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: 'Se eliminó la categoría de manera correcta.',
                showConfirmButton: true
            });
        </script>";
    }
?>

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
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-0">
            <div class="card card-primary card-outline">
              <div class="card-body">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info"><i class="fa fa-plus"></i>
                  Anadir Categoria
                </button>
                <br />
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modal-info">
        <div class="modal-dialog">
          <div class="modal-content bg-info">
            <div class="modal-header">
              <h4 class="modal-title">Crear una nueva categoria</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Nombre:</label>
                      <input type="text" id="nombre_categoria" class="form-control">
                      <label for="">Descripcion:</label>
                      <input type="text" id="descripcion_categoria" class="form-control">
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-outline-light" id="boton_crear">Guardar cambio</button>
              <div id="respuesta"></div>
            </div>
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
                <h3 class="card-title">Categorias Registradas</h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                      <th style="width: 10px">Numero</th>
                      <th>Nombre</th>
                      <th>Descripcion</th>
                      <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $contador = 0;
                    foreach ($datos_categorias as $datos_categoria) { 
                    $idcategoria = $datos_categoria['idcategoria']; 
                    $nombre_categoria = $datos_categoria['nombre_categoria'];
                    $descripcion_categoria = $datos_categoria['descripcion_categoria'];
                    ?>
                    <tr class="align-middle">
                      <td><?php echo $contador = $contador + 1; ?></td>
                      <td><?php echo $datos_categoria['nombre_categoria']; ?></td>
                      <td><?php echo $datos_categoria['descripcion_categoria']; ?></td>
                      <td>
                        <center>
                        <div class="btn-group">

                        <section class="content">
                          <div class="container-fluid">
                            <div class="card-body">
                              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-success-<?php echo $idcategoria; ?>">Editar</button>
                            </div>
                            <div class="modal fade" id="modal-success-<?php echo $idcategoria; ?>">
    <div class="modal-dialog">
        <div class="modal-content bg-success">
            <div class="modal-header">
                <h4 class="modal-title">Editar la categoría: <?php echo $nombre_categoria; ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nombre_categoria_<?php echo $idcategoria; ?>">Nombre:</label>
                    <input type="text" id="nombre_categoria_<?php echo $idcategoria; ?>" value="<?php echo $nombre_categoria; ?>" class="form-control">
                    <label for="descripcion_categoria_<?php echo $idcategoria; ?>">Descripción:</label>
                    <input type="text" id="descripcion_categoria_<?php echo $idcategoria; ?>" value="<?php echo $descripcion_categoria; ?>" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-outline-light" onclick="editarCategoria(<?php echo $idcategoria; ?>)">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>
                      </section>

                          <section class="content">
                            <div class="container-fluid">
        <div class="card-body">
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger-<?php echo $idcategoria; ?>">Borrar</button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modal-danger-<?php echo $idcategoria; ?>">
            <div class="modal-dialog">
                <div class="modal-content bg-danger">
                    <div class="modal-header">
                        <h4 class="modal-title">Seguro deseas borrar la categoría: <br><?php echo $datos_categoria['nombre_categoria']; ?>?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cerrar</button>
                        <!-- Formulario para borrar la categoría -->
                        <form action="borrar_categoria.php" method="POST">
                            <input type="hidden" name="idcategoria" value="<?php echo $idcategoria; ?>">
                            <button type="submit" class="btn btn-outline-light">Borrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


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

<!-- Bootstrap 4 -->
<script src="../adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="../adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../adminlte/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="../adminlte/dist/js/adminlte.min.js"></script>
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

<!-- Page specific script -->

<script>
// JavaScript para actualizar categoría usando AJAX
$(document).ready(function() {
    // Cuando se hace clic en el botón "Guardar cambios"
    $(".btn-outline-light").on('click', function() {
        // Obtener el id de la categoría que se está editando
        var modal_id = $(this).closest('.modal').attr('id');
        var category_id = modal_id.split('-')[2]; // Se asume que el id sigue el formato modal-success-ID

        // Obtener los valores de los campos
        var nombre_categoria = $("#nombre_categoria").val().trim(); // Eliminar espacios al principio y al final
        var descripcion_categoria = $("#descripcion_categoria").val().trim();

        // Agregar un console.log para ver los valores
        console.log("Nombre categoría:", nombre_categoria);
        console.log("Descripción categoría:", descripcion_categoria);

        // Crear un objeto para enviar solo los campos que no están vacíos
        var dataToSend = { idcategoria: category_id };

        // Agregar los valores solo si no están vacíos
        if (nombre_categoria !== "") {
            dataToSend.nombre_categoria = nombre_categoria;
        }

        if (descripcion_categoria !== "") {
            dataToSend.descripcion_categoria = descripcion_categoria;
        }

        // Verificar si hay algo para actualizar
        console.log("Datos a enviar:", dataToSend); // Verifica los datos que se enviarán

        if (Object.keys(dataToSend).length > 1) {
            // Hacer una llamada AJAX para enviar los datos a PHP
            $.ajax({
                url: "editar_categoria.php", // Archivo PHP que procesará la edición
                type: "POST",
                data: dataToSend, // Enviar solo los datos que han cambiado
                success: function(response) {
                    console.log("Respuesta del servidor:", response); // Ver la respuesta del servidor
                    // Mostrar el mensaje de éxito
                    Swal.fire({
                        icon: 'success',
                        title: 'Categoría actualizada',
                        text: 'La categoría se actualizó correctamente.',
                    }).then(() => {
                        location.reload(); // Recargar la página para ver los cambios
                    });
                },
                error: function(xhr, status, error) {
                    console.log("Error AJAX:", status, error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un problema al actualizar la categoría.',
                    });
                }
            });
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Sin cambios',
                text: 'No se realizaron cambios en la categoría.',
            });
        }
    });
});
</script>

<script>
  $('#boton_crear').click(function () {
    var nombre_categoria = $('#nombre_categoria').val();  // Cambiar al selector correcto
    var descripcion_categoria = $('#descripcion_categoria').val();  // Cambiar al selector correcto
    var url = "http://localhost:3000/admin/categorias_funcion.php";
    
    // Enviar datos al archivo PHP
    $.get(url, { nombre_categoria: nombre_categoria, descripcion_categoria: descripcion_categoria }, function (datos) {
        $('#respuesta').html(datos);  // Cambiar al selector correcto
    });
  });
</script>

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
<script>
  $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        icon: 'success',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultInfo').click(function() {
      Toast.fire({
        icon: 'info',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultError').click(function() {
      Toast.fire({
        icon: 'error',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultWarning').click(function() {
      Toast.fire({
        icon: 'warning',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultQuestion').click(function() {
      Toast.fire({
        icon: 'question',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });

    $('.toastrDefaultSuccess').click(function() {
      toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultInfo').click(function() {
      toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultError').click(function() {
      toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultWarning').click(function() {
      toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });

    $('.toastsDefaultDefault').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultTopLeft').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'topLeft',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultBottomRight').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'bottomRight',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultBottomLeft').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'bottomLeft',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultAutohide').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        autohide: true,
        delay: 750,
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultNotFixed').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        fixed: false,
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultFull').click(function() {
      $(document).Toasts('create', {
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        icon: 'fas fa-envelope fa-lg',
      })
    });
    $('.toastsDefaultFullImage').click(function() {
      $(document).Toasts('create', {
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        image: '../../dist/img/user3-128x128.jpg',
        imageAlt: 'User Picture',
      })
    });
    $('.toastsDefaultSuccess').click(function() {
      $(document).Toasts('create', {
        class: 'bg-success',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultInfo').click(function() {
      $(document).Toasts('create', {
        class: 'bg-info',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultWarning').click(function() {
      $(document).Toasts('create', {
        class: 'bg-warning',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultDanger').click(function() {
      $(document).Toasts('create', {
        class: 'bg-danger',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultMaroon').click(function() {
      $(document).Toasts('create', {
        class: 'bg-maroon',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
  });
</script>
</body>
</html>
