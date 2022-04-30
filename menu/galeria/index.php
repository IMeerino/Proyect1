<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Galeria</title>
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
            <a id="lista" class="nav-link fs-5 fw-bold text-black-50" href="index.php">Galeria</a>
          </li>
          <li class="nav-item">
            <a id="lista" class="nav-link fs-5 fw-bold text-black-50" href="../talleres/index.php">Talleres</a>
          </li>
          <li class="nav-item">
            <a id="lista" class="nav-link fs-5 fw-bold text-black-50" href="../materias/index.php">Materias</a>
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




      <h1>Galeria</h1>

      <div class="album py-5 bg-light">
        <div class="container">

          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <div class="col">
              <div class="card shadow-sm">
                <img src="img/1.jpg" width="100%" height="225">
              </div>
            </div>

            <div class="col">
              <div class="card shadow-sm">
              <img src="img/2.jpg" width="100%" height="225">
              </div>
            </div>

            <div class="col">
              <div class="card shadow-sm">
              <img src="img/3.jpg" width="100%" height="225">
              </div>
            </div>

            <div class="col">
              <div class="card shadow-sm">
              <img src="img/4.jpg" width="100%" height="225">
              </div>
            </div>
            <div class="col">
              <div class="card shadow-sm">
              <img src="img/5.jpg" width="100%" height="225">
              </div>
            </div>
            <div class="col">
              <div class="card shadow-sm">
              <img src="img/6.jpg" width="100%" height="225">
              </div>
            </div>

            <div class="col">
              <div class="card shadow-sm">
              <img src="img/7.jpg" width="100%" height="225">
              </div>
            </div>
            <div class="col">
              <div class="card shadow-sm">
              <img src="img/8.jpg" width="100%" height="225">
              </div>
            </div>
            <div class="col">
              <div class="card shadow-sm">
              <img src="img/9.jpg" width="100%" height="225">
              </div>
            </div>
            <div class="col">
              <div class="card shadow-sm">
              <img src="img/10.jpg" width="100%" height="225">
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