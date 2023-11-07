
<html lang="es">

<head>

<link rel="stylesheet" href="../css/menu.css">

</head>

</html>


<?php 

include "menu.php";
$usu = $_POST['usuario'];
$ape = $_POST['apellido'];
$nom = $_POST['nombre'];
$ed = $_POST['edad'];
$foto = $_FILES["foto"]["tmp_name"];
$fotoTamanio = $_FILES["foto"]["size"];

// salida de informacion

echo "<h3>".$usu."<h3>".$ape."<h3>". "<h3>".$nom."</h3>". "<h3>".$ed."</h3>";

if($foto != "none")
{
	$fp = fopen($foto,"rb");
	$contenido = fread($fp,$fotoTamanio);
	$contenido = addslashes($contenido);
	fclose($fp);

$base = "gestion";
$Conexion =  mysqli_connect("localhost","root","",$base);
var_dump($usu);

$cadena= "INSERT INTO persona(usuario, apellido, nombre, edad, foto) VALUES ('$usu','$ape','$nom','$ed','$contenido')";

$resultado = mysqli_query($Conexion,$cadena);

if($resultado){
	print "se ha insertado un registro"."<br>";
	header('Location:../index.php');

}
else{
	print "NO se ha generado un registro"."<br>";
}

}
else{
print "No se puede subir el archivo";
}
 ?>