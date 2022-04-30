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
al grupo no puedan logearse
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



//VER DATOS DE LA TABLA 
$materias = "SELECT u.idusuario, g.idgrupo, m.idmateria, 
            m.nombrem
            FROM usuarios AS u, materias AS m, grupos AS g 
            WHERE '$iduser'= u.idusuario
            AND m.idgrupo=g.idgrupo
            AND g.idusuario='$iduser'";
$resultadomaterias = $conexion->query($materias);





?>





<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis materias</title>
    <!--CSS Boostrap-->
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../../../css/style.css">
</head>

<body class=" bg-primary ">
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





        

        <div class='row  row-cols-md-3 g-4 mb-5 mt-5'>

        <!-- CODIGO PARA VER EN LA TABLA -->
        <?php
        while ($regmateria = $resultadomaterias->fetch_array(MYSQLI_BOTH)) {
            echo "



            
  <div class='col'>
    <div class='card h-100'>
      <div class='card-body' >
        <h5 class='card-title'>" . $regmateria['nombrem'] . "</h5>
        <a  class='btn btn-primary' href='controltemas.php?id=" . $regmateria['idmateria'] . "'><img src='../../../svg/tema.svg'> Temas</a>
      </div>
    </div>
  </div>
  
         
<tr>
<td></td> 
<td></td>
</tr>";
        }
        ?>

</div>

    



















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