<?php
//incluye el archivo para establecer la conexion
include("../../conexion.php");

//inicia la sesion
session_start();

/*VALIDA LA SESION PARA QUE NO PUEDAN ENTRAR DIRECTO
y si no hay sesion lo manda al login
*/
if (!isset($_SESSION['id_usuario'])) {
    header("location: ../logina.php");
}

/*es para verificar que usuarios diferentes
al grupo no puedan logearse
*/
$nivel = $_SESSION['tipo_usuario'];
if ($nivel != "3") {
    header("location: ../logina.php");
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



//VER DATOS DE LA TABLA 
$horario = "SELECT u.idusuario, g.idgrupo, m.idmateria, h.idhorario,
            h.lunes, h.martes, h.miercoles, h.jueves, h.viernes, m.nombrem
            FROM usuarios AS u, materias AS m, grupos AS g, horarios AS h
            WHERE '$iduser'= u.idusuario
            AND m.idgrupo=g.idgrupo
            AND g.idusuario='$iduser'
            AND m.idmateria=h.idmateria";
$resultadohorario = $conexion->query($horario);





?>





<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horario Escolar</title>
    <!--CSS Boostrap-->
    <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../../../../css/style.css">
</head>

<body class=" bg-primary ">
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
                    <li class="nav-item">
                        <a href="../panel.php" class="nav-link active fs-5  text-black"><b>Mis Materias</b></a>
                    </li>
                    <li class="nav-item">
                        <a href="horario.php" class="nav-link active fs-5  text-black"><b>Horario</b></a>
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





        <div class="table-responsive rounded-3 mx-auto w-75">


<table class="table table-bordered my-5 s">

    <thead class="table-dark table align-middle">
        <tr>
            <td class="bg-light fs-5 fw-bold text-center text-primary" colspan="8">HORARIO ESCOLAR</td>
        </tr>
        <tr>
            <td>Materias</td>
            <td>Lunes</td>
            <td>Martes</td>
            <td>Miercoles</td>
            <td>Jueves</td>
            <td>Viernes</td>
        </tr> 
    </thead>  
    <tbody class=" bg-light ">
        <!-- CODIGO PARA VER EN LA TABLA -->
        <?php
        while ($reghorario = $resultadohorario->fetch_array(MYSQLI_BOTH)) {
            echo "
<tr>
<td>" . $reghorario['nombrem'] . "</td>
<td>" . $reghorario['lunes'] . "</td> 
<td>" . $reghorario['martes'] . "</td> 
<td>" . $reghorario['miercoles'] . "</td> 
<td>" . $reghorario['jueves'] . "</td> 
<td>" . $reghorario['viernes'] . "</td> 

</tr>";
        }
        ?>
    </tbody>
</table>





</div>












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