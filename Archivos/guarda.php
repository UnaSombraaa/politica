<?php
session_start();

require 'config/bd.php';

$nombre = $conn->real_escape_string($_POST['nombre']);
$apellido = $conn->real_escape_string($_POST['apellido']);
$cargo = $conn->real_escape_string($_POST['cargo']);
$partido = $conn->real_escape_string($_POST['partido'])
$nacimiento = $conn->real_escape_string($_POST['fecha_nacimiento']);

$educacion = $conn->real_escape_string($_POST['educacion']);
$biografia = $conn->real_escape_string($_POST['biografia']);
$imagen = $conn->real_escape_string($_POST['imagen']);

$sql = "INSERT INTO politicos (nombre, apellido, cargo, id_partido, fecha_nacimiento, educacion, biografia, imagen)
VALUES ('$nombre', '$apellido', $cargo, $partido, $nacimiento, $educacion, $biografia, $imagen NOW())";
if ($conn->query($sql)) {
    $id = $conn->insert_id;

    $_SESSION['color'] = "success";
    $_SESSION['msg'] = "Registro guardado";

    if ($_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
        $permitidos = array("image/jpg", "image/jpeg");
        if (in_array($_FILES['poster']['type'], $permitidos)) {

            $dir = "img";

            $info_img = pathinfo($_FILES['img']['name']);
            $info_img['extension'];

            $poster = $dir . '/' . $id . '.jpg';

            if (!file_exists($dir)) {
                mkdir($dir, 0777);
            }

            if (!move_uploaded_file($_FILES['img']['tmp_name'], $poster)) {
                $_SESSION['color'] = "danger";
                $_SESSION['msg'] .= "<br>Error al guardar imagen";
            }
        } else {
            $_SESSION['color'] = "danger";
            $_SESSION['msg'] .= "<br>Formato de imágen no permitido";
        }
    }
} else {
    $_SESSION['color'] = "danger";
    $_SESSION['msg'] = "Error al guarda imágen";
}

header('Location: index.php');
