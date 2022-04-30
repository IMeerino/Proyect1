<?php
//incluye el archivo para establecer la conexion
include("../../conexion.php");

//inicia la sesion
session_start();

/*VALIDA LA SESION PARA QUE NO PUEDAN ENTRAR DIRECTO
y si no hay sesion lo manda al login
*/
if (!isset($_SESSION['id_usuario'])) {
    header("location: ../loginm.php");
}

/*es para verificar que usuarios diferentes
al administrador no puedan logearse
*/
$nivel = $_SESSION['tipo_usuario'];
if ($nivel != "2") {
    header("location: ../loginm.php");
}

//MOSTRAR INFORMACION DE USUARIO LOGUEADO (nombrecompleto)
$iduser = $_SESSION['id_usuario'];
$sql = "SELECT u.idusuario, u.nombrecompleto, t.tipousuario
        FROM usuarios AS u
        INNER JOIN tipo_usuario AS t
        ON u.idtipousuario=t.idtipousuario
        WHERE u.idusuario ='$iduser'";
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();

$ID = $_GET['id'];


//VER DATOS
$verhorario = "SELECT idhorario, 
lunes,
martes,
miercoles,
jueves,
viernes
FROM horarios
WHERE idmateria='$ID'";
$resultadoverhorario = $conexion->query($verhorario);
$filashorario = $resultadoverhorario->fetch_assoc();




?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Horario</title>
    <!--CSS Boostrap-->
    <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../../../../css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top rounded-bottom">
        <div class="container-fluid">
            <img src="../../../../logo.png" class="img-thumbnail" width="50">
            <a class="navbar-brand fs-3 fw-bold text-black" href="#">Secundaria Técnica 97</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active fs-5 text-black"><b>Bienvenido:</b> <?php echo utf8_decode($row['nombrecompleto']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fs-5  text-black"><b>Tipo:</b> <?php echo utf8_decode($row['tipousuario']); ?></a>
                    </li>
                    <li id="lista" class="nav-item dropdown fs-5 text-black">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <b>Privilegios</b>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../panel.php">Panel de Control</a></li>
                            <li><a class="dropdown-item" href="control.php">Administrar Materias</a></li>
                            <li><a class="dropdown-item" href="../administrar_usuario/control.php">Administrar Usuario</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a id="lista" class="nav-link fs-5 fw-bold text-black-50" href="../../cerrarsesion.php">Cerrar Sesión</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>


    <main class="antescontenedorcss">
        <div class="contenedorcss">








            <form class="mt-5 mb-5" method="POST" action="<?php $_SERVER["PHP_SELF"]; ?>">

                <div class="alert alert-success w-50 mx-auto fw-bolder" role="alert">
                    <div class="alert alert-light mx-auto fw-bolder text-center text-black text-truncate" role="alert">
                        REGISTRAR HORARIO
                    </div>

                    <div class="mb-3 mx-auto text-truncate">
                        <label class="form-label">Lunes</label>
                        <input type="text" class="form-control" required name="lun" value="<?php echo $filashorario['lunes']; ?>">
                    </div>

                    <div class="mb-3 mx-auto text-truncate">
                        <label class="form-label">Martes</label>
                        <input type="text" class="form-control" required name="mar" value="<?php echo $filashorario['martes']; ?>">
                    </div>
                    <div class="mb-3 mx-auto text-truncate">
                        <label class="form-label">Miercoles</label>
                        <input type="text" class="form-control" required name="mie" value="<?php echo $filashorario['miercoles']; ?>">
                    </div>
                    <div class="mb-3 mx-auto text-truncate">
                        <label class="form-label">Jueves</label>
                        <input type="text" class="form-control" required name="jue" value="<?php echo $filashorario['jueves']; ?>">
                    </div>
                    <div class="mb-3 mx-auto text-truncate">
                        <label class="form-label">Viernes</label>
                        <input type="text" class="form-control" required name="vie" value="<?php echo $filashorario['viernes']; ?>">
                    </div>


                    <div class="mb-3 text-truncate">
                        <input type="hidden" name="ID" value="<?php echo $ID; ?>">
                        <input type="submit" class="btn btn-success fw-bolder" name="editar" value="Modificar">
                    </div>
                </div>
            </form>


            <?php

            if (isset($_POST["editar"])) {                
                $lunes = $_POST['lun'];
                $martes = $_POST['mar'];
                $miercoles = $_POST['mie'];
                $jueves = $_POST['jue'];
                $viernes = $_POST['vie'];
                $id = $_POST["ID"];
                $sqlmodificar = "UPDATE horarios SET lunes = '$lunes',
                                         martes = '$martes',
                                         miercoles = '$miercoles',
                                         jueves = '$jueves',
                                         viernes = '$viernes'
                    WHERE idmateria = '$id'";
                $modificado = $conexion->query($sqlmodificar);
                if ($modificado > 0) {
                    echo "<script>
            alert('Registro modificado exitosamente');
            window.location='control.php';
        </script>";
                } else {
                    echo "<script>
            alert('error al modificar');
            window.location='control.php';
        </script>";
                }
            }
            $conexion->close();
            ?>


















            <br><br>


        </div>
    </main>
    <!-- <footer class="footer">
        
            <p> Juan Palacio 347, Colonia Maria Eugenia C.P. 68370, San Juan Bautista Tuxtepec, Oaxaca</p>
        
    </footer>
-->

    <!-- JS Boostrap -->
    <script src="../../../../js/bootstrap.bundle.min.js"></script>
</body>

</html>