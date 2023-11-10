<?php
session_start();

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

$sqlPoliticos = "SELECT p.politico_id, p.nombre, p.apellido, p.cargo, p.fecha_nacimiento, p.educacion, p.biografia, g.nombre AS partidos
                FROM politicos AS p
                INNER JOIN partidos AS g ON p.id_partidos = g.id";

$resultPoliticos = $conn->query($sqlPoliticos);

$dir = "PoliticaArgentina/img/";
?>

<!DOCTYPE html>
<html lang="en" class="h-80">
    

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Politicos</title>
<!-- En el head de tu HTML -->


    <link href="../Politicaargentina/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../Politicaargentina/assets/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="../Politicaargentina/assets/js/bootstrap.bundle.min.js"></script>


</head>

<body class="d-flex flex-column h-80">
    <div class="container py-3">
        <h2 class="text-center">Politicos</h2>
        <hr>

        <?php if (isset($_SESSION['msg']) && isset($_SESSION['color'])) { ?>
            <div class="alert alert-<?= $_SESSION['color']; ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['msg']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        <?php
            unset($_SESSION['color']);
            unset($_SESSION['msg']);
        } ?>

        <div class="row justify-content-end">
            <div class="col-auto">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoModal"><i class="fa-solid fa-circle-plus"></i> Nuevo registro</a>
            </div>
        </div>

        <table class="table table-sm table-striped table-hover mt-4">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Cargo</th>
                    <th>Partido</th>
                    <th>Nacimiento</th>
                    <th>Educación</th>
                    <th>Biografía</th>
                    <th>Imagen</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = $resultPoliticos->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['nombre']; ?></td>
                        <td><?= $row['apellido']; ?></td>
                        <td><?= $row['cargo']; ?></td>
                        <td><?= $row['partido']; ?></td>
                        <td><?= $row['fecha_nacimiento']; ?></td>
                        <td><?= $row['educacion']; ?></td>
                        <td><?= $row['biografia']; ?></td>
                        <td><img src="<?= $dir . $row['id'] . '.jpg?n=' . time(); ?>" width="100"></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editaModal" data-bs-id="<?= $row['id']; ?>"><i class="fa-solid fa-pen-to-square"></i> Editar</a>

                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#eliminaModal" data-bs-id="<?= $row['id']; ?>"><i class="fa-solid fa-trash"></i></i> Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php include '../Politicaargentina/template/pie.php'?>

    <?php
    $sqlPartidos = "SELECT id, nombre FROM partidos";
    $partidoss = $conn->query($sqlPartidos);
    ?>

    <?php include 'nuevoModal.php'; ?>

    <?php $partidoss->data_seek(0); ?>

    <?php include 'editaModal.php'; ?>
    <?php include 'eliminaModal.php'; ?>

    <script>
        let nuevoModal = document.getElementById('nuevoModal')
        let editaModal = document.getElementById('editaModal')
        let eliminaModal = document.getElementById('eliminaModal')

        nuevoModal.addEventListener('shown.bs.modal', event => {
            nuevoModal.querySelector('.modal-body #nombre').focus()
        })

        nuevoModal.addEventListener('hide.bs.modal', event => {
            nuevoModal.querySelector('.modal-body #nombre').value = ""
            nuevoModal.querySelector('.modal-body #apellido').value = ""
            nuevoModal.querySelector('.modal-body #cargo').value = ""
            nuevoModal.querySelector('.modal-body #nacimiento').value = ""
            nuevoModal.querySelector('.modal-body #educacion').value = ""
            nuevoModal.querySelector('.modal-body #biografia').value = ""
            nuevoModal.querySelector('.modal-body #imagen').value = ""
        })

        editaModal.addEventListener('hide.bs.modal', event => {
            editaModal.querySelector('.modal-body #nombre').value = ""
            editaModal.querySelector('.modal-body #apellido').value = ""
            editaModal.querySelector('.modal-body #cargo').value = ""
            editaModal.querySelector('.modal-body #nacimiento').value = ""
            editaModal.querySelector('.modal-body #educacion').value = ""
            editaModal.querySelector('.modal-body #biografia').value = ""
            editaModal.querySelector('.modal-body #imagen').value = ""
        })

        editaModal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')

            let inputId = editaModal.querySelector('.modal-body #id')
            let inputNombre = editaModal.querySelector('.modal-body #nombre')
            let inputApellido = editaModal.querySelector('.modal-body #apellido')
            let inputCargo = editaModal.querySelector('.modal-body #cargo')
            let inputNacimiento = editaModal.querySelector('.modal-body #nacimiento')
            let inputEducacion = editaModal.querySelector('.modal-body #educacion')
            let inputBiografia = editaModal.querySelector('.modal-body #biografia')
            let inputImagen = editaModal.querySelector('.modal-body #imagen')



            let url = "getPolitico.php"
            let formData = new FormData()
            formData.append('id', id)

            fetch(url, {
                    method: "POST",
                    body: formData
                }).then(response => response.json())
                .then(data => {

                    inputId.value = data.id
                    inputNombre.value = data.nombre
                    inputApellido.value = data.apellido
                    inputCargo.value = data.cargo
                    inputNacimiento.value = data.nacimiento
                    inputEducacion.value = data.educacion
                    inputBiografia.value = data.id_biografia
                    inputImagen.value = data.id_imagen
                    imagen.src = '<?= $dir ?>' + data.id + '.jpg'

                }).catch(err => console.log(err))

        })

        eliminaModal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            eliminaModal.querySelector('.modal-footer #id').value = id
        })
    </script>

    <script src="Politicaargentina/assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>