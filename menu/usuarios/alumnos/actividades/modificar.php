<?php
//incluye el archivo para establecer la conexion
require '../../conexion.php';

//inicia la sesion
session_start();

/*VALIDA LA SESION PARA QUE NO PUEDAN ENTRAR DIRECTO
y si no hay sesion lo manda al login
*/
if (!isset($_SESSION['id_usuario'])) {
	header("location: ../logina.php");
}

/*es para verificar que usuarios diferentes
al administrador no puedan logearse
*/
$nivel = $_SESSION['tipo_usuario'];
if ($nivel != "3") {
	header("location: ../logina.php");
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


$id = $_GET['id'];

$sql = "SELECT * FROM actividades WHERE id = '$id'";
$resultado = $conexion->query($sql);
$rowa = $resultado->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Material Didáctico</title>
	<link href="../../../../css/bootstrap.min.css" rel="stylesheet">

	<script src="../../../../js/jquery-3.5.1.min.js"></script>
	<script src="../../../../js/bootstrap.bundle.min.js"></script>



	<script type="text/javascript">
		$(document).ready(function() {
			$('.delete').click(function() {
				var parent = $(this).parent().attr('id');
				var service = $(this).parent().attr('data');
				var dataString = 'id=' + service;

				$.ajax({
					type: "POST",
					url: "del_file.php",
					data: dataString,
					success: function() {
						location.reload();
					}
				});
			});
		});
	</script>

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
                    <li class="nav-item">
                        <a href="../panel.php" class="nav-link active fs-5  text-black"><b>Mis Materias</b></a>
                    </li>
                    <li class="nav-item">
                        <a href="../horario/horario.php" class="nav-link active fs-5  text-black"><b>Horario</b></a>
                    </li>
                    <li class="nav-item">
                        <a id="lista" class="nav-link fs-5 fw-bold text-black-50" href="../../cerrarsesion.php">Cerrar Sesión</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>








	<div class="container">




		<br><br><br><br>



		<div class="row row-cols-1 row-cols-md-2 g-4 w-100 ">

			<div class="col ">
				<div class="card text-light ">

					<div class="card-body shadow">



						<div class="alert text-black w-100 mx-auto fw-bolder" role="alert">

							<div class="form-row">

								<div class="mb-3 mx-auto text-truncate">
									<h4 class="text-primary"> Numero de la actividad</h4>
									<?php echo $rowa['numeroactividad']; ?>
									<hr>
								</div>
								<div class="mb-3 mx-auto text-truncate">
									<h4 class="text-primary"> Nombre de la actividad </h4>
									<?php echo $rowa['nombreactividad']; ?>
									<hr>
								</div>
								<div class="mb-3 mx-auto text-truncate">
								<h4 class="text-primary">Descripción</h4>
									<?php echo $rowa['descripciona']; ?>
									<hr>
								</div>
								<div class="mb-3 mx-auto text-truncate">
								<h4 class="text-primary">Enlaces</h4>
									<?php echo $rowa['enlace']; ?>
								</div>
							</div>



						</div>







					</div>
				</div>



			</div>

			<div class="col">
				<div class="card shadow">

					<div class="card-body">
						<h3 class=" mb-4 text-center text-primary">Archivos</h3>
						<div class="form-group text-truncate">


							<?php
							$path = "../../maestros/administrar_materias/actividades/files/" . $id;
							if (file_exists($path)) {
								$directorio = opendir($path);
								while ($archivo = readdir($directorio)) {
									if (!is_dir($archivo)) {
										echo "<div data='" . $path . "/" . $archivo . "'><a href='" . $path . "/" . $archivo . "' title='Ver Archivo Adjunto'><img src='../../../../svg/imagen.svg'></a>";
										echo "$archivo <a href='#' class='delete' title='Ver Archivo Adjunto' ></a></div>";
									}
								}
							}

							?>


						</div>






					</div>
				</div>





			</div>






		</div>







	</div>


</body>

</html>