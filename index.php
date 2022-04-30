<?php
//incluye el archivo para establecer la conexion
//require 'menu/usuarios/conexion.php';


//VER DATOS DE LA TABLA 
/*$avisos = "SELECT id,
titulo,
aviso,
fecha 
FROM avisos";
$resultadoavisos = $conexion->query($avisos);
*/

?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio</title>
  <!--CSS Boostrap-->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- CSS -->
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top rounded-bottom">
    <div class="container-fluid">
      <img src="logo.png" class="img-thumbnail" width="50">
      <a class="navbar-brand fs-3 fw-bold text-black" href="#">Secundaria Técnica 97</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a id="lista" class="nav-link active fs-5 fw-bold text-black" href="index.php">Inicio</a>
          </li>
          <li class="nav-item">
            <a id="lista" class="nav-link fs-5 fw-bold text-black-50" href="menu/galeria/index.php">Galeria</a>
          </li>
          <li class="nav-item">
            <a id="lista" class="nav-link fs-5 fw-bold text-black-50" href="menu/talleres/index.php">Talleres</a>
          </li>
          <li class="nav-item">
            <a id="lista" class="nav-link fs-5 fw-bold text-black-50" href="menu/materias/index.php">Materias</a>
          </li>
          <li class="nav-item">
            <a id="lista" class="nav-link fs-5 fw-bold text-black-50" href="menu/contacto/index.php">Contacto</a>
          </li>
          <a href="menu/usuarios/menulogin.php"><button class="btn btn-outline-success btn-light fs-7 fw-bold">Iniciar sesión</button></a>
        </ul>
      </div>
    </div>
  </nav>



  <main class="antescontenedorcss">
    <div class="contenedorcss">








      <div id="carouselExampleDark" class="carousel carousel-light slide w-100 mx-auto fw-bold mt-3" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active " data-bs-interval="10000">
            <img src="imagen1.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block text-light">
              <h5>Secundaria Técnica 97</h5>
              <p>San Juan Bautista Tuxtepec Oaxaca México</p>
            </div>
          </div>
          <div class="carousel-item" data-bs-interval="2000">
            <img src="imagen2.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block text-light">
              <h5>Secundaria Técnica 97</h5>
              <p>San Juan Bautista Tuxtepec Oaxaca México</p>
            </div>
          </div>

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">ANTERIOR</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">SIGUIENTE</span>
        </button>
      </div>













      <div class="w-75 mx-auto mt-4 mb-5 text-center">




        


       
       

      <div class='row row-cols-1 row-cols-md-3 mb-3 text-center'>
         <?php
            while ($regaviso = $resultadoavisos->fetch_array(MYSQLI_BOTH)) {
              echo "
        <main>
         
            <div class='col'>
              <div class='card mb-4 rounded-3 shadow-sm border-primary'>
                <div class='card-header py-3 text-white bg-primary border-primary'>
                  <h4 class='my-0 fw-normal'>" . $regaviso['titulo'] . "</h4>
                </div>
                <div class='card-body'>
                  <h4 class='card-title pricing-card-title'>" . $regaviso['aviso'] . "</h4>
                  <ul class='list-unstyled mt-3 mb-4'>
                    <li>" . $regaviso['fecha'] . "</li>
                  </ul>
                  <a href='ver.php?id=" . $regaviso['id'] . "'><button type='button' class='w-100 btn btn-lg btn-primary'>Ver Archivos</button></a>
                </div>
              </div>
            </div>
         
        </main>


        ";
      }
      ?>


</div>






















      </div>



      <div class=" text-center mt-2 bg-primary">
        <p class=" fw-bold text-white">Dirección: Juan Palacio 347, Colonia Maria Eugenia C.P. 68370, San Juan Bautista Tuxtepec, Oaxaca </p>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3792.569592054557!2d-96.14050248531844!3d18.09146928766023!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85c3e689b89c1507%3A0x9aed49c4654b8aee!2sEscuela%20Secundaria%20T%C3%A9cnica%20No.%2097!5e0!3m2!1ses-419!2smx!4v1641506173738!5m2!1ses-419!2smx" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
      </div>



    </div>
  </main>



  <!-- JS Boostrap -->
  <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>