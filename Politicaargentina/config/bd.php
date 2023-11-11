<?php
$host = "localhost";
$bd = "politicaargentina";
$usuario = "root";
$contrasenia = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$bd", $usuario, $contrasenia);
    
    if ($conn) {
        echo "Conectado a la base de datos... ";
    }
} catch (Exception $ex) {
    echo "Error de conexión: " . $ex->getMessage();
}
?>
