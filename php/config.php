<?php

$servername = "localhost";
$username = "root";
$password = "2602";
$dbname = "freddymotos";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Conexión exitosa"; 
}
catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

$URL = "http://localhost/www.freddymotos.com.ar/";

?>
