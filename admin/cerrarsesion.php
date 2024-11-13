<?php
include('../php/config.php');

session_start();
if(isset($_SESSION['session_correo'])) {
    session_destroy();
    echo "<script>window.location.href='sesion.php';</script>";
    exit;
}

?>
