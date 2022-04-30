<?php
//incluye el archivo para establecer la conexion
include("../../../conexion.php");

//inicia la sesion
session_start();

/*VALIDA LA SESION PARA QUE NO PUEDAN ENTRAR DIRECTO
y si no hay sesion lo manda al login
*/
if (!isset($_SESSION['id_usuario'])) {
    header("location: ../../loginadmin.php");
}

/*es para verificar que usuarios diferentes
al administrador no puedan logearse
*/
$nivel = $_SESSION['tipo_usuario'];
if ($nivel != "1") {
    header("location: ../../loginadmin.php");
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
$usuario = "SELECT 
            idusuario,
            nombrecompleto, 
            nombreu,
            contrau
            FROM usuarios WHERE idusuario = '$ID'";
$resultadousuario = $conexion->query($usuario);
$filas = $resultadousuario->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Grupo</title>
    <!--CSS Boostrap-->
    <link rel="stylesheet" href="../../../../../css/bootstrap.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../../../../../css/style.css">





</head>

<body>

    <nav class="navbar navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <img src="../../../../../logo.png" alt="" width="50">
            <a class="navbar-brand fs-3 fw-bold text-black" href="#">Secundaria Técnica 97</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title fs-1" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link fs-5"><b>Bienvenido:</b> <?php echo utf8_decode($row['nombrecompleto']); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-5"><b>Tipo:</b> <?php echo utf8_decode($row['tipousuario']); ?></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-5 fw-bold" href="../../panel.php">Panel de Control</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fs-5 fw-bold" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Administrar Usuarios
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                                <li><a class="dropdown-item" href="../administradores/control.php">Administradores</a></li>
                                <li><a class="dropdown-item" href="../maestros/control.php">Maestros</a></li>
                                <li><a class="dropdown-item" href="control.php">Grupos</a></li>
                            </ul>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link fs-5 fw-bold" href="../../buzon_de_mensajes/buzon.php">Buzón de Mensajes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-5 fw-bold" href="../../publicar_avisos/index.php">Publicar Avisos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-5 fw-bold" href="../../../cerrarsesion.php">Cerrar Sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>


    <main class="antescontenedorcss">
        <div class="contenedorcss">




            <form class="mt-5 mb-5" method="POST" action="<?php $_SERVER["PHP_SELF"]; ?>">

                <div class="alert alert-success w-50 mx-auto fw-bolder" role="alert">
                    <div class="alert alert-light mx-auto fw-bolder text-center text-black text-truncate" role="alert">
                        REGISTRAR NUEVO USUARIO ADMINISTRADOR
                    </div>
                    <div class="mb-3 mx-auto text-truncate">
                        <label class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control" name="nombreua" value="<?php echo $filas['nombrecompleto']; ?>">
                    </div>
                    <div class="mb-3 mx-auto text-truncate">
                        <label class="form-label">Contraseña</label>
                        <input type="text" class="form-control" name="contraua" value="<?php echo $filas['contrau']; ?>">
                    </div>
                    <div class="mb-3 text-truncate">
                        <input type="hidden" name="ID" value="<?php echo $ID; ?>">
                        <input type="submit" class="btn btn-success fw-bolder" name="editar" value="Modificar">
                    </div>
                </div>
            </form>



            <?php

            if (isset($_POST["editar"])) {
                $nombreua = $_POST["nombreua"];
                $contraua = $_POST["contraua"];
                $id = $_POST["ID"];

               
                    $sqlmodificar = "UPDATE usuarios SET nombrecompleto = '$nombreua',
                                contrau = '$contraua'  
            WHERE idusuario = '$id'";
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
    <script src="../../../../../js/bootstrap.bundle.min.js"></script>
</body>

</html>