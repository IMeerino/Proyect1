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

//REGISTRAR
if (!empty($_POST)) {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nom']);
    $idgrupo = $_POST['idg'];
    $lunes = "8:00am - 9:00am";
    $martes = "8:00am - 9:00am";
    $miercoles = "8:00am - 9:00am";
    $jueves = "8:00am - 9:00am";
    $viernes = "8:00am - 9:00am";
    $sqlmateria = "INSERT INTO materias(nombrem,idusuario,idgrupo)
                    VALUES('$nombre','$iduser','$idgrupo')";
    $resultadomateria = $conexion->query($sqlmateria);

    $idemateria = $conexion->insert_id;

    $sqlhorario = "INSERT INTO horarios(lunes,martes,miercoles,jueves,viernes,idmateria)
                    VALUES('$lunes','$martes','$miercoles','$jueves','$viernes','$idemateria')";
    $resultadohorario = $conexion->query($sqlhorario);
    if ($resultadomateria > 0) {

        echo
        "<script>
            alert('Registro Exitoso');
            window.location='control.php';
        </script>";
    } else {
        echo
        "<script> 
            alert('Error al registrarse');
            window.location='control.php';
        </script>";
    }
}

//VER DATOS EN SELECT 
$grupo = "SELECT idgrupo, 
            nombregrupo,
            turno,
            grado,
            grupo
            FROM grupos
            ORDER BY turno, grado";
$resultadogrupo = $conexion->query($grupo);

//VER DATOS DE LA TABLA 
$materias = "SELECT m.idmateria, 
            m.nombrem,
            g.turno,
            g.grado,
            g.grupo
            FROM materias AS m
            INNER JOIN grupos AS g
            ON g.idgrupo=m.idgrupo
            WHERE m.idusuario ='$iduser'";
$resultadomaterias = $conexion->query($materias);


?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Materias</title>
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
                    <div class="mb-3 mx-auto text-truncate bg-light text-center fw-bolder text-black">
                        <label class="form-label">REGISTRAR MATERIA</label>
                    </div>
                    <div class="mb-3 mx-auto text-truncate">
                        <label class="form-label">Materia</label>
                        <input type="text" class="form-control" placeholder="Nombre Completo del Usuario" required name="nom">
                    </div>
                    <div class="mb-3 mx-auto text-truncate">
                        <select class="form-select" aria-label="Default select example" required name="idg">
                            <option>Selecciona un grupo</option>
                            <?php
                            while ($regrupo = $resultadogrupo->fetch_array(MYSQLI_BOTH)) {
                                echo '<option value="' . $regrupo['idgrupo'] . '"> ● (' . $regrupo['nombregrupo'] . ') | ' . $regrupo['grado'] . ' | ' . $regrupo['grupo'] . ' | ' . $regrupo['turno'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3 text-truncate">
                        <button type="submit" class="btn btn-success fw-bolder">REGISTRAR</button>
                    </div>
                </div>
            </form>


            <div class="table-responsive rounded-3 mx-auto">


                <table class="table table-bordered">

                    <thead class="table-dark table align-middle">
                        <tr>
                            <td class="bg-primary fs-5 fw-bold text-center text-light" colspan="8">LISTA DE MATERIAS</td>
                        </tr>
                        <tr>
                            <td>Materia</td>
                            <td>Grado</td>
                            <td>Grupo</td>
                            <td>Turno</td>
                            <td>Horario</td>
                            <td>Temas</td>
                            <td>Editar</td>
                            <td>Eliminar</td>
                        </tr> 
                    </thead>  
                    <tbody class=" bg-light ">
                        <!-- CODIGO PARA VER EN LA TABLA -->
                        <?php
                        while ($regmateria = $resultadomaterias->fetch_array(MYSQLI_BOTH)) {
                            echo "
    <tr>
        <td>" . $regmateria['nombrem'] . "</td> 
        <td>" . $regmateria['grado'] . "</td>
        <td>" . $regmateria['grupo'] . "</td>
        <td>" . $regmateria['turno'] . "</td>
        <td><a href='editarhorario.php?id=" . $regmateria['idmateria'] . "'><img src='../../../../svg/horario.svg'></a></td>
        <td><a href='controltemas.php?id=" . $regmateria['idmateria'] . "'><img src='../../../../svg/tema.svg'></a></td>
        <td><a href='editar.php?id=" . $regmateria['idmateria'] . "'><img src='../../../../svg/editar.svg'></a></td>
        <td><a href='eliminar.php?id=" . $regmateria['idmateria'] . "'> <img src='../../../../svg/eliminar.svg'></a></td>
    </tr>";
                        }
                        ?>
                    </tbody>
                </table>





            </div>















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