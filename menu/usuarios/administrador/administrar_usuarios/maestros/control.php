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

//REGISTRAR
if (!empty($_POST)) {
    $nombrec = mysqli_real_escape_string($conexion, $_POST['nom']);
    $usuario = mysqli_real_escape_string($conexion, $_POST['user']);
    $contra = mysqli_real_escape_string($conexion, $_POST['pass']);
    $tipou = 2;

    $sqluseradmin = "SELECT idusuario FROM usuarios WHERE nombreu = '$usuario'";
    $resultadouseradmin = $conexion->query($sqluseradmin);
    $filasuseradmin = $resultadouseradmin->num_rows;

    if ($filasuseradmin > 0) {
        echo "<script>
            alert('El usuario ya existe');
            window.location='control.php';
        </script>";
    } else {
        $sqladmin = "INSERT INTO usuarios(nombrecompleto,nombreu,contrau,idtipousuario)
                    VALUES('$nombrec','$usuario','$contra','$tipou')";
        $resultadoadmin = $conexion->query($sqladmin);
        if ($resultadoadmin > 0) {
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
}


//VER DATOS DE LA TABLA 
$usuarios = "SELECT u.idusuario,
            u.nombrecompleto,
            u.nombreu,
            u.contrau,
            t.tipousuario
            FROM usuarios AS u
            INNER JOIN tipo_usuario AS t
            ON u.idtipousuario=t.idtipousuario
            WHERE u.idtipousuario=2
            ORDER BY u.nombrecompleto";
$resultadousuarios = $conexion->query($usuarios);




?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maestros</title>
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
                                <li><a class="dropdown-item" href="control.php">Maestros</a></li>
                                <li><a class="dropdown-item" href="../grupos/control.php">Grupos</a></li>
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
                        REGISTRAR NUEVO USUARIO MAESTRO
                    </div>
                    <div class="mb-3 mx-auto text-truncate">
                        <label class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control" placeholder="Nombre Completo del Usuario" required name="nom">
                    </div>
                    <div class="mb-3 mx-auto text-truncate">
                        <label class="form-label">Usuario</label>
                        <input type="text" class="form-control" placeholder="Escribe el nuevo usuario" required name="user">
                    </div>
                    <div class="mb-3 mx-auto text-truncate">
                        <label class="form-label">Contraseña</label>
                        <input type="text" class="form-control" placeholder="Escribe la contraseña" required name="pass">
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
                            <td class="bg-primary fs-5 fw-bold text-center" colspan="5">LISTA DE USUARIOS MAESTRO</td>
                        </tr>
                        <tr>
                            <td>Nombre del Usuario</td>
                            <td>Usuario</td>
                            <td>Contraseña</td>
                            <td>Modificar</td>
                            <td>Eliminar</td>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- CODIGO PARA VER EN LA TABLA -->
                        <?php
                        while ($regusuario = $resultadousuarios->fetch_array(MYSQLI_BOTH)) {
                            echo "
                    <tr>
                        <td>" . $regusuario['nombrecompleto'] . "</td>
                        <td>" . $regusuario['nombreu'] . "</td>
                        <td>" . $regusuario['contrau'] . "</td>
                        <td><a href='editar.php?id=" . $regusuario['idusuario'] . "'><img src='../../../../../svg/editar.svg'></a></td>
                        <td><a href='eliminar.php?id=" . $regusuario['idusuario'] . "'><img src='../../../../../svg/eliminar.svg'></a></td>
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
    <script src="../../../../../js/bootstrap.bundle.min.js"></script>
</body>

</html>