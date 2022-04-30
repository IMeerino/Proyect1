<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Materias</title>
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
            <a id="lista" class="nav-link fs-5 fw-bold text-black-50" href="index.php">Materias</a>
          </li>
          <li class="nav-item">
            <a id="lista" class="nav-link fs-5 fw-bold text-black-50" href="../contacto/index.php">Contacto</a>
          </li>
          <a href="../usuarios/menulogin.php"><button class="btn btn-outline-success btn-light fs-7 fw-bold">Iniciar sesión</button></a>
        </ul>
      </div>
    </div>
  </nav>



  <main class="antescontenedorcss">
    <div class="contenedorcss">






      <div class="accordion w-75 mx-auto mt-5" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              <b>PRIMER GRADO</b>
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body bg-primary text-light fw-bold">

              <p>Español</p>
              <p>Ingles</p>
              <p>Matemáticas</p>
              <p>Biología</p>
              <p>Geografía</p>
              <p>F.C. Y E.</p>
              <p>Historia</p>
              <p>Educ.Fis.</p>
              <p>Artes</p>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              <b>SEGUNDO GRADO</b>
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <div class="accordion-body bg-primary text-light fw-bold">

              <p>Español</p>
              <p>Ingles</p>
              <p>Matemáticas</p>
              <p>Física</p>
              <p>F.C. Y E.</p>
              <p>Historia</p>
              <p>Educ.Fis.</p>
              <p>Artes</p>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              <b>TERCER GRADO</b>
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
            <div class="accordion-body bg-primary text-light fw-bold ">
              <p>Español</p>
              <p>Ingles</p>
              <p>Matemáticas</p>
              <p>Química</p>
              <p>F.C. Y E.</p>
              <p>Historia</p>
              <p>Educ.Fis.</p>
              <p>Artes</p>
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