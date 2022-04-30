<?php
//incluye el archivo para establecer la conexion
require '../../../conexion.php';

//inicia la sesion
session_start();

/*VALIDA LA SESION PARA QUE NO PUEDAN ENTRAR DIRECTO
y si no hay sesion lo manda al login
*/
if (!isset($_SESSION['id_usuario'])) {
	header("location: ../../loginm.php");
}

/*es para verificar que usuarios diferentes
al administrador no puedan logearse
*/
$nivel = $_SESSION['tipo_usuario'];
if ($nivel != "2") {
	header("location: ../../loginm.php");
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


//VER DATOS DE LA TABLA 
$actividades = "SELECT id,
numeroactividad,
nombreactividad,
descripciona,
enlace
FROM actividades
WHERE idsubtema ='$ID'";
$resultadosactividades = $conexion->query($actividades);



//MOSTRAR INFORMACION DEL SUBTEMA
$sqlnombresubtema = "SELECT idsubtema,
        nombresubtema,
        numerosubtema
        FROM subtemas
        WHERE idsubtema ='$ID'";
$resultadonombresubtema = $conexion->query($sqlnombresubtema);
$rownombresubtema = $resultadonombresubtema->fetch_assoc();


?>






<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Administrar Actividades</title>
	<!--CSS Boostrap-->
	<link rel="stylesheet" href="../../../../../css/bootstrap.min.css">
	<!-- CSS -->
	<link rel="stylesheet" href="../../../../../css/style.css">



</head>

<body>


	<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top rounded-bottom">
		<div class="container-fluid">
			<img src="../../../../../logo.png" class="img-thumbnail" width="50">
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
							<li><a class="dropdown-item" href="../../panel.php">Panel de Control</a></li>
							<li><a class="dropdown-item" href="../control.php">Administrar Materias</a></li>
							<li><a class="dropdown-item" href="../../administrar_usuario/control.php">Administrar Usuario</a></li>
						</ul>
					</li>
					<li class="nav-item">
						<a id="lista" class="nav-link fs-5 fw-bold text-black-50" href="../../../cerrarsesion.php">Cerrar Sesión</a>
					</li>

				</ul>
			</div>
		</div>
	</nav>





	<main class="antescontenedorcss">
		<div class="contenedorcss">



			<form method="POST" action="guardar.php" enctype="multipart/form-data" autocomplete="off">

				<div class="alert alert-success w-50 mx-auto fw-bolder" role="alert">

					<div class="mb-3 mx-auto text-truncate bg-light text-center fw-bolder text-black">
						<label class="form-label">REGISTRAR ACTIVIDAD PARA EL SUBTEMA <?php
																						echo  $rownombresubtema['nombresubtema'];
																						?></label>
					</div>
					<div class="mb-3 mx-auto text-truncate">
						<label>Numero de actividad</label>
						<input type="text" class="form-control" name="numa" placeholder="Escribe el numero" required>
					</div>
					<div class="mb-3 mx-auto text-truncate">
						<label>Nombre de actividad</label>
						<input type="text" class="form-control" name="noma" placeholder="Escribe el nombre" required>
					</div>

					<div class="mb-3 mx-auto text-truncate">
						<label>Descripción</label>
						<input type="text" class="form-control" placeholder="Escribe una descripción" name="desa" required>
					</div>
					<div class="mb-3 mx-auto text-truncate">
						<label>Enlace</label>
						<input type="text" class="form-control" placeholder="Enlace para Video de YOUTUBE" name="vida" required>
					</div>


					<div class="custom-file">
						<label for="customFile" class="form-label">Seleccionar archivo</label>
						<input type="file" class="form-control form-control-sm" id="archivo" name="archivo" required>
					</div>
					<div class="alert alert-warning" role="alert">
						Solo imágenes: .jpg   .png <br>
						Solo documentos: .pdf
					</div>

					<br />


					<div class="form-group" style="padding-top:15px">

						<input type="hidden" name="IDD" value="<?php echo $ID; ?>">
						<button type="submit" class="btn btn-success">Guardar</button>

					</div>
				</div>
			</form>


			<div class="container">


				<br>

				<div class="table-responsive rounded-3 mx-auto">
					<table class="table table-bordered">
						<thead class="table-dark table align-middle">
							<tr>
								<td class="bg-primary fs-5 fw-bold text-center" colspan="8">ACTIVIDADES DEL SUBTEMA <?php echo $rownombresubtema['numerosubtema'];
																													echo " ";
																													echo $rownombresubtema['nombresubtema'];
																													?></td>
							</tr>
							<tr>

								<th>Numero de Actividad</th>
								<th>Nombre</th>
								<th>descripcion</th>
								<th>Enlaces</th>
								<th>Editar</th>
								<th>Eliminar</th>
							</tr>
						</thead>


						<tbody>
							<!-- CODIGO PARA VER EN LA TABLA -->
							<?php
							while ($regmateria = $resultadosactividades->fetch_array(MYSQLI_BOTH)) {
								echo "
                            <tr>
                                        <td>" . $regmateria['numeroactividad'] . "</td>
                                        <td>" . $regmateria['nombreactividad'] . "</td>
                                        <td>" . $regmateria['descripciona'] . "</td> 
										<td>" . $regmateria['enlace'] . "</td> 
                                        <td><a href='modificar.php?id=" . $regmateria['id'] . "'><img src='../../../../../svg/editar.svg'></a></td>
                                        <td><a href='eliminar.php?id=" . $regmateria['id'] . "'><img src='../../../../../svg/eliminar.svg'></a></td>
                            </tr>";
							}
							?>
						</tbody>
					</table>
				</div>
			</div>

			<!-- Modal -->
			<div class="modal fade" id="confirm-delete" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="staticBackdropLabel">Eliminar Registro</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							¿Desea eliminar este registro?
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							<a class="btn btn-danger btn-ok">Eliminar</a>
						</div>
					</div>
				</div>
			</div>

			<script>
				$('#confirm-delete').on('show.bs.modal', function(e) {
					$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

					$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
				});
			</script>


		</div>
	</main>
	<!-- JS Boostrap -->
	<script src="../../../../../js/bootstrap.bundle.min.js"></script>
</body>

</html>