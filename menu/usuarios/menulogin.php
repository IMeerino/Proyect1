<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu Login</title>
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
            <a id="lista" class="nav-link fs-5 fw-bold text-black-50" href="../contacto/index.php">Contacto</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>



  <main class="antescontenedorcss">
    <div class="contenedorcss">



      <div class="card mx-auto text-center mt-5" style="width: 14rem;">
        <div class="card-body mt-5">
        <img src="user.png" class="card-img-top">
          <h5 class="card-title mt-5">Menu de Usuarios</h5>
          <p class="card-text">Para iniciar sesión elige el tipo de usuario preciona el boton de abajo y se desplejaran los tipos de usuarios</p>

          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
              Elige el tipo de Usuario
            </button>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
              <li><a class="dropdown-item" href="alumnos/logina.php">Alumno</a></li>
              <li><a class="dropdown-item" href="maestros/loginm.php">Maestro</a></li>
              <li><a class="dropdown-item" href="administrador/loginadmin.php">Administrador</a></li>
            </ul>
          </div>
        </div>
      </div>
<br> <br>

      <br><br>


    </div>
  </main>
  <!-- <footer class="footer">
        
            <p> Juan Palacio 347, Colonia Maria Eugenia C.P. 68370, San Juan Bautista Tuxtepec, Oaxaca</p>
        
    </footer>
-->

  <!-- JS Boostrap -->
  <script src="../../js/bootstrap.bundle.min.js"></script>
</body>

</html>