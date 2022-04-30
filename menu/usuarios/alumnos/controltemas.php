<?php
//incluye el archivo para establecer la conexion
include("../conexion.php");

//inicia la sesion
session_start();

/*VALIDA LA SESION PARA QUE NO PUEDAN ENTRAR DIRECTO
y si no hay sesion lo manda al login
*/
if (!isset($_SESSION['id_usuario'])) {
    header("location: logina.php");
}

/*es para verificar que usuarios diferentes
al administrador no puedan logearse
*/
$nivel = $_SESSION['tipo_usuario'];
if ($nivel != "3") {
    header("location: logina.php");
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


//VER DATOS DE LA TABLA 
$materias = "SELECT idtema,
            numerotema,
            nombretema,
            descripciont
            FROM temas
            WHERE idmateria ='$ID'
            ORDER BY numerotema";
$resultadomaterias = $conexion->query($materias);



//MOSTRAR INFORMACION DE LA MATERIA
$sqlnombremateria = "SELECT idmateria,
        nombrem
        FROM materias 
        WHERE idmateria ='$ID'";
$resultadonombremateria = $conexion->query($sqlnombremateria);
$rownombremateria = $resultadonombremateria->fetch_assoc();

?>




<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temas</title>
    <!--CSS Boostrap-->
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../../../css/style.css">
</head>

<body>



<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top rounded-bottom">
        <div class="container-fluid">
            <img src="../../../logo.png" class="img-thumbnail" width="50">
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
                    <li class="nav-item">
                        <a href="panel.php" class="nav-link active fs-5  text-black"><b>Mis Materias</b></a>
                    </li>
                    <li class="nav-item">
                        <a href="horario/horario.php" class="nav-link active fs-5  text-black"><b>Horario</b></a>
                    </li>
                    <li class="nav-item">
                        <a id="lista" class="nav-link fs-5 fw-bold text-black-50" href="../cerrarsesion.php">Cerrar Sesión</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    

   

    <main class="antescontenedorcss">
        <div class="contenedorcss">




         


            <div class="table-responsive rounded-3 mx-auto mt-5">


                <table class="table">

                    <thead class="table-dark table align-middle">
                        <tr>
                            <td class="bg-primary fs-5 fw-bold text-center" colspan="8">Temario de <?php
                                                                                                    echo $rownombremateria['nombrem'];
                                                                                                    ?></td>
                        </tr>
                        <tr>
                            <th>Numero del tema</th>
                            <th>Nombre del tema</th>
                            <th>Descripcion</th>
                            <th>Subtemas</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <!-- CODIGO PARA VER EN LA TABLA -->
                        <?php
                        while ($regmateria = $resultadomaterias->fetch_array(MYSQLI_BOTH)) {
                            echo "
                            <tr>
                                        <td>" . $regmateria['numerotema'] . "</td>
                                        <td>" . $regmateria['nombretema'] . "</td>
                                        <td>" . $regmateria['descripciont'] . "</td> 
                                        <td><a href='controlsubtemas.php?id=" . $regmateria['idtema'] . "'><img src='../../../svg/subtema.svg'></a></td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>





            </div>















            <br><br>

           <!-- <nav class="navbar navbar-light bg-info fixed-bottom ">
                <span class="mb-0 text"> MATERIA:<b> <?php echo $rownombremateria['nombrem'];?> </b> </span>
            </nav>
                    -->
        </div>
    </main>
    <!-- <footer class="footer">
        
            <p> Juan Palacio 347, Colonia Maria Eugenia C.P. 68370, San Juan Bautista Tuxtepec, Oaxaca</p>
        
    </footer>
-->

    <!-- JS Boostrap -->
    <script src="../../../js/bootstrap.bundle.min.js"></script>
</body>

</html>