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
$temas = "SELECT 
            idtema,
            numerotema,
            nombretema, 
            descripciont
            FROM temas WHERE idtema = '$ID'";
$resultadotemas =$conexion->query($temas);
$filastema = $resultadotemas->fetch_assoc();



?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tema</title>
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
                        Editar Tema
                    </div>

                    <div class="mb-3 mx-auto text-truncate">
                        <label class="form-label">Numero del Tema</label>
                        <input type="text" class="form-control" required name="numtema" value="<?php echo $filastema['numerotema']; ?>">
                    </div>
                    <div class="mb-3 mx-auto text-truncate">
                        <label class="form-label">Nombre del Tema</label>
                        <input type="text" class="form-control" required name="nomtema" value="<?php echo $filastema['nombretema']; ?>">
                    </div>
                    <div class="mb-3 mx-auto text-truncate">
                        <label class="form-label">Descripcion del Tema</label>
                        <input type="text" class="form-control" required name="desctema" value="<?php echo $filastema['descripciont']; ?>">
                    </div>


                    <div class="mb-3 text-truncate">
                        <input type="hidden" name="ID" value="<?php echo $ID; ?>">
                        <input type="submit" class="btn btn-success fw-bolder" name="editar" value="Modificar">
                    </div>
                </div>
            </form>


<?php 

    if(isset($_POST["editar"])){
        $numtema = $_POST["numtema"];
        $nomtema = $_POST["nomtema"];
        $desctema = $_POST["desctema"];
        $id = $_POST["ID"];    
        $sqlmodificar = "UPDATE temas SET numerotema = '$numtema',
                                            nombretema = '$nomtema',
                                            descripciont = '$desctema'  
                        WHERE idtema = '$id'";    
        $modificado = $conexion->query($sqlmodificar);    
        if($modificado>0){
            echo "<script>
                alert('Registro modificado exitosamente');
                window.location='control.php';
            </script>";
        } else{
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