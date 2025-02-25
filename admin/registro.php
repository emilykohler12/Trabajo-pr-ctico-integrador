<?php

session_start();
if(isset($_SESSION['mensaje'])){
    $respuesta = $_SESSION['mensaje'];?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            icon: "error",
            title: "<?php echo $respuesta;?>"
        });
    });
    </script>
<?php
unset($_SESSION['mensaje']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="icon" href="../img/logo.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="title" content="AdminLTE 4 | General Form Elements">
    <meta name="author" content="ColorlibHQ">
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS.">
    <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"><!--end::Primary Meta Tags--><!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous"><!--end::Fonts--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous"><!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous"><!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="../adminlte/dist/css/adminlte.css">
</head>

<body>
    <br>
<h1 class="m-2">Registrarse</h1>
<br>
    <div class="card card-info card-outline mb-4"> 
    <h4 class="m-3">Rellene los datos</h4>
        <form class="needs-validation" novalidate action="crear.php" method="post">
            <div class="card-body"> 
                <div class="row g-3">
                    <div class="col-md-6"> <label for="validationCustom01" class="form-label">Nombre y apellido</label> <input type="text" class="form-control" name="nombre" id="validationCustom01" placeholder="Escriba aquí su nombre" required></div>
                    <div class="w-100"></div>
                    <br>
                    <div class="col-md-6"> <label for="validationCustom01" class="form-label">Correo Electrónico</label> <input type="email" class="form-control" name="correo" id="validationCustom01" placeholder="Escriba aquí su correo electrónico" required></div>
                    <div class="w-100"></div>
                    <br>
                    <div class="col-md-6"> <label for="validationCustom01" class="form-label">Teléfono</label> <input type="text" class="form-control" id="validationCustom01" name="telefono" placeholder="Escriba aquí su número de teléfono" required></div>
                    <div class="w-100"></div>
                    <br>
                    <div class="col-md-6">
    <label for="rol" class="form-label">Rol</label>
    <select name="idrol" id="rol" class="form-control">
        <?php 
        foreach($datos_rol as $rol_dato) { ?>
            <option value="<?php echo $rol_dato['idrol']; ?>"><?php echo $rol_dato['rol']; ?></option>
        <?php
        }
        ?>
    </select>
</div>

                    <div class="w-100"></div>
                    <div class="col-md-6"> <label for="validationCustom01" class="form-label">Contraseña</label> <input type="password" class="form-control" name="contrasena" id="validationCustom01" required></div>
                    <div class="col-md-6"> <label for="validationCustom01" class="form-label">Verificar Contraseña</label> <input type="password" class="form-control" name="verificar_contrasena" id="validationCustom01" required></div>
                </div>
            </div>
            <div class="card-footer"> <button class="btn btn-info" type="submit">Guardar</button></div>
            <br>
            <div class="card card-info card-outline mb-4"> 
        </form>
    </div>
</body>
</html>