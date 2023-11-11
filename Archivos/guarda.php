<?php
session_start();

require '../Politicaargentina/config/bd.php';

// Obtén la conexión a la base de datos
global $conn;

// Verifica que la conexión sea exitosa
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Variables del formulario
$nombre = $_POST['nombre'] ?? '';
$apellido = $_POST['apellido'] ?? '';
$cargo = $_POST['cargo'] ?? '';
$partido = $_POST['id_partidos'] ?? '';
$nacimiento = $_POST['fecha_nacimiento'] ?? '';
$educacion = $_POST['educacion'] ?? '';
$biografia = $_POST['biografia'] ?? '';
$imagen = $_FILES['imagen'] ?? null;

// Verificamos que el partido no sea nulo
if (empty($partido)) {
    $_SESSION['msg'] = "Debe seleccionar un partido";
    header("Location: index.php");
    exit;
  }

// Consulta preparada con marcadores de posición
$sql = "INSERT INTO politicos (nombre, apellido, cargo, id_partidos, fecha_nacimiento, educacion, biografia, imagen) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";

// Preparar la consulta
$stmt = $conn->prepare($sql);

// Ejecutar la consulta
if ($stmt->execute([$nombre, $apellido, $cargo, $partido, $nacimiento, $educacion, $biografia])) {
    $id = $conn->lastInsertId();

    $_SESSION['color'] = "success";
    $_SESSION['msg'] = "Registro guardado";

    // Guardar la imagen si se proporciona
    if ($imagen['error'] == UPLOAD_ERR_OK) {
        $permitidos = array("image/jpg", "image/jpeg");

        if (in_array($imagen['type'], $permitidos)) {
            $dir = "../Politicaargentina/img";
            $imagen_path = $dir . '/' . $id . '.jpg';

            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);  // Asegúrate de que se creen directorios anidados si no existen
            }

            if (!move_uploaded_file($imagen['tmp_name'], $imagen_path)) {
                $_SESSION['color'] = "danger";
                $_SESSION['msg'] .= "<br>Error al guardar la imagen";
            }

        } else {
            $_SESSION['color'] = "danger";
            $_SESSION['msg'] .= "<br>Formato de imagen no permitido";
        }
    }
} else {
    $_SESSION['color'] = "danger";
    $_SESSION['msg'] = "Error al guardar el registro";
}

header('Location: index.php');
?>
