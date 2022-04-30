<?php
//incluye el archivo para establecer la conexion
include ("../conexion.php");
//inicia la sesion
session_start();

//si se inicia sesion lo manda al PANEL
if (isset($_SESSION['id_usuario'])){
    header("location: panel.php");
}

//VALIDACION DE USUARIO DEL FORMULARIO CON LA BD
if (!empty($_POST)){
    $usuario = mysqli_real_escape_string($conexion,$_POST['user']);
    $contrasena = mysqli_real_escape_string($conexion,$_POST['pass']);
    $sql= "SELECT idusuario, idtipousuario FROM usuarios WHERE nombreu='$usuario' AND contrau = '$contrasena' AND idtipousuario='2'";
    $resultado = $conexion->query($sql);
    $filas = $resultado->num_rows;
    if ($filas>0){
        $fila=$resultado->fetch_assoc();
        $_SESSION['id_usuario']=$fila['idusuario'];
        $_SESSION['tipo_usuario']=$fila['idtipousuario'];
        header("Location: panel.php");
    }else{
        echo "<script>alert ('El usuario o contraseña son incorrecto');
                window.location='loginm.php';
                </script>";
    }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login Maestro</title>
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
                        <a id="lista" class="nav-link active fs-5 fw-bold text-black" href="../../../index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a id="lista" class="nav-link fs-5 fw-bold text-black-50" href="../../galeria/index.php">Galeria</a>
                    </li>
                    <li class="nav-item">
                        <a id="lista" class="nav-link fs-5 fw-bold text-black-50" href="../../talleres/index.php">Talleres</a>
                    </li>
                    <li class="nav-item">
                        <a id="lista" class="nav-link fs-5 fw-bold text-black-50" href="../../materias/index.php">Materias</a>
                    </li>
                    <li class="nav-item">
                        <a id="lista" class="nav-link fs-5 fw-bold text-black-50" href="../../contacto/index.php">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <main class="antescontenedorcss">
        <div class="contenedorcss">


            <div class="alert alert-primary w-50 mx-auto mt-5 fw-bold" role="alert">
                LOGIN MAESTRO
            </div>

            <form class="mt-5" method="POST" action="<?php $_SERVER["PHP_SELF"];?>">
                <div class="mb-3 w-50 mx-auto fw-bolder">
                    <label class="form-label">Usuario</label>
                    <input type="text" class="form-control"  placeholder="Escribe tu usuario" required name="user">
                </div>
                <div class="mb-3 w-50 mx-auto fw-bolder">
                    <label class="form-label">Contraseña</label>
                    <input type="password" class="form-control" placeholder="Escribe tu contraseña" required name="pass">
                </div>
                <div class="mb-3 w-50 mx-auto">
                    <button type="submit" class="btn btn-primary mx-auto fw-bolder">INGRESAR</button>
                </div>
            </form>



            <br><br>


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