<?php


require("../usuarios/conexion.php");
//REGISTRAR
if (!empty($_POST)) {
  $nombreb = mysqli_real_escape_string($conexion, $_POST['nombreb']);
  $correob = mysqli_real_escape_string($conexion, $_POST['correob']);
  $telefonob = mysqli_real_escape_string($conexion, $_POST['telefonob']);
  $mensajeb = mysqli_real_escape_string($conexion, $_POST['mensajeb']);
  $sqlmensaje = "INSERT INTO buzon(nombreb,correob,telefonob, mensajeb)
                  VALUES('$nombreb','$correob','$telefonob','$mensajeb')";
  $resultadomensaje = $conexion->query($sqlmensaje);

  if ($resultadomensaje > 0) {

    echo
    "<script>
          alert('Mensaje Enviado Correctamente');
          window.location='index.php';
      </script>";
  } else {
    echo
    "<script> 
          alert('Error al enviar el Mensaje Intente Nuevamente');
          window.location='index.php';
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
  <title>Contacto</title>
  <!--CSS Boostrap-->
  <link rel="stylesheet" href="../../css/bootstrap.min.css">
  <!-- CSS -->
  <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top rounded-bottom">
    <div class="container-fluid">
      <img src="../../logo.png" class="img-thumbnail" width="50">
      <a class="navbar-brand fs-3 fw-bold text-black" href="#">Secundaria Técnica 97</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a id="lista" class="nav-link active fs-5 fw-bold text-black" href="../../index.php">Inicio</a>
          </li>
          <li class="nav-item">
            <a id="lista" class="nav-link fs-5 fw-bold text-black-50" href="../galeria/index.php">Galeria</a>
          </li>
          <li class="nav-item">
            <a id="lista" class="nav-link fs-5 fw-bold text-black-50" href="../talleres/index.php">Talleres</a>
          </li>
          <li class="nav-item">
            <a id="lista" class="nav-link fs-5 fw-bold text-black-50" href="../materias/index.php">Materias</a>
          </li>
          <li class="nav-item">
            <a id="lista" class="nav-link fs-5 fw-bold text-black-50" href="index.php">Contacto</a>
          </li>
          <a href="../usuarios/menulogin.php"><button class="btn btn-outline-success btn-light fs-7 fw-bold">Iniciar sesión</button></a>
        </ul>
      </div>
    </div>
  </nav>



  <main class="antescontenedorcss">
    <div class="contenedorcss mb-5">

      <div class="table-responsive rounded-3 mx-auto w-100 mt-5 ">



        <div class="row row-cols-1 row-cols-md-2 g-4 w-100 ">

          <div class="col ">
            <div class="card bg-primary text-light ">

              <div class="card-body">
                <div class=" text-center">
                  <h3>Contacto</h3>
                </div>
                <p>¿Tienes dudas? envianos un mensaje directamente</p>
                <form method="POST" action="<?php $_SERVER["PHP_SELF"]; ?>">

                  <div class="input-group mb-3">
                    <span class="input-group-text text-truncate" id="basic-addon1">Nombre Completo</span>
                    <input type="text" class="form-control" placeholder="Escribe tu Nombre" aria-label="Username" aria-describedby="basic-addon1" required name="nombreb">
                  </div>

                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Correo" aria-label="Username" name="correob">
                    <span class="input-group-text"></span>
                    <input type="text" class="form-control" placeholder="Numero telefono" aria-label="Server" required name="telefonob">
                  </div>

                  <div class="input-group">
                    <span class="input-group-text">Mensaje</span>
                    <textarea class="form-control" aria-label="With textarea" required name="mensajeb"></textarea>
                  </div>

                  <div class=" text-truncate mt-2">
                    <button type="submit" class="btn btn-success fw-bolder bg-danger">Enviar</button>
                  </div>
                </form>
              </div>
            </div>



          </div>

          <div class="col">
            <div class="card">

              <div class="card-body">
                <h3 class=" mb-4 text-center">Nuestras Redes Sociales</h3>
                <div class="input-group mb-3">
                  <a href="https://www.facebook.com/Secundaria-T%C3%A9cnica-97-Los-Pitufos-Oficial-179228275510837/" class=" text-decoration-none text-black fw-bold"><img src="../../svg/f.svg" width="30"> Secundaria Técnica 97 "Los Pitufos" (Oficial)</a>
                </div>
                <div class="input-group mb-3">
                  <a href="https://api.whatsapp.com/send?phone=2878816761" class=" text-decoration-none text-black fw-bold"><img src="../../svg/w.svg" width="30"> 287 881 6761</a>
                </div>
                <div class="input-group mb-3">
                  <a href="tel:2878816761" class=" text-decoration-none text-black fw-bold"><img src="../../svg/t.svg" width="30"> 287 881 6761</a>
                </div>
                <div class="input-group">
                  <a href="mailto:secundariatecnica_97@hotmail.com" class=" text-decoration-none text-black fw-bold"><img src="../../svg/correo.svg" width="30"> secundariatecnica_97@hotmail.com</a>
                </div>
                




              </div>
            </div>
          
          </div>






        </div>



      </div>
  </main>



  <!-- JS Boostrap -->
  <script src="../../js/bootstrap.bundle.min.js"></script>
</body>

</html>