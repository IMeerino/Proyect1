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
if ($nivel != "3" ) {
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
	<title>Actividades</title>
	<!--CSS Boostrap-->
	<link rel="stylesheet" href="../../../../css/bootstrap.min.css">
	<!-- CSS -->
	<link rel="stylesheet" href="../../../../css/style.css">



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




	<main class="antescontenedorcss">
		<div class="contenedorcss">



		

		


				<br>

				<div class="table-responsive rounded-3 mx-auto mt-4">
					<table class="table ">
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
								<th>Material Didactico</th>
							
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
                                        <td><a href='modificar.php?id=" . $regmateria['id'] . "'><img src='../../../../svg/archivos.svg'></a></td>
                                       
                            </tr>";
							}
							?>
						</tbody>
					</table>
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
	<script src="../../../../js/bootstrap.bundle.min.js"></script>
</body>

</html>