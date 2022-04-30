<?php
//incluye el archivo para establecer la conexion
require '../../conexion.php';

//inicia la sesion
session_start();

/*VALIDA LA SESION PARA QUE NO PUEDAN ENTRAR DIRECTO
y si no hay sesion lo manda al login
*/
if (!isset($_SESSION['id_usuario'])) {
	header("location: ../loginadmin.php");
}

/*es para verificar que usuarios diferentes
al administrador no puedan logearse
*/
$nivel = $_SESSION['tipo_usuario'];
if ($nivel != "1") {
	header("location: ../loginadmin.php");
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





//VER DATOS DE LA TABLA 
$avisos = "SELECT id,
titulo,
aviso,
fecha 
FROM avisos";
$resultadoavisos = $conexion->query($avisos);






?>






<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Publicar Avisos</title>
	<!--CSS Boostrap-->
	<link rel="stylesheet" href="../../../../css/bootstrap.min.css">
	<!-- CSS -->
	<link rel="stylesheet" href="../../../../css/style.css">



</head>

<body>


<nav class="navbar navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <img src="../../../../logo.png" alt="" width="50">
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
                            <a class="nav-link fs-5 fw-bold" href="../panel.php">Panel de Control</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fs-5 fw-bold" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Administrar Usuarios
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                                <li><a class="dropdown-item" href="../administrar_usuarios/administradores/control.php">Administradores</a></li>
                                <li><a class="dropdown-item" href="../administrar_usuarios/maestros/control.php">Maestros</a></li>
                                <li><a class="dropdown-item" href="../administrar_usuarios/grupos/control.php">Grupos</a></li>
                            </ul>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link fs-5 fw-bold" href="../buzon_de_mensajes/buzon.php">Buzón de Mensajes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-5 fw-bold" href="../publicar_avisos/index.php">Publicar Avisos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-5 fw-bold" href="../../cerrarsesion.php">Cerrar Sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>





	<main class="antescontenedorcss">
		<div class="contenedorcss">



			<form method="POST" action="guardar.php" enctype="multipart/form-data" autocomplete="off">

				<div class="alert alert-success w-50 mx-auto fw-bolder" role="alert">

					<div class="mb-3 mx-auto text-truncate bg-light text-center fw-bolder text-black">
						<label class="form-label">PUBLICAR NUEVO AVISO</label>
					</div>

					<div class="mb-3 mx-auto text-truncate">
						<label>TÍTULO</label>
						<input type="text" class="form-control" placeholder="Escribe un título" name="titulo" required>
					</div>

					<div class="mb-3 mx-auto text-truncate">
						<label>AVISO</label>
						<input type="text" class="form-control" placeholder="Escribe un mensaje" name="aviso" required>
					</div>
					<div class="custom-file">
						<label for="customFile" class="form-label">Seleccionar archivo</label>
						<input type="file" class="form-control form-control-sm" id="archivo" name="archivo" required>
					</div>
					<div class="alert alert-warning" role="alert">
						Solo imágenes: .jpg .png <br>
						Solo documentos: .pdf
					</div>

					<br />


					<div class="form-group" style="padding-top:15px">


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
								<td class="bg-info fs-5 fw-bold text-center" colspan="8"> AVISOS </td>
							</tr>
							<tr>
								<th>TÍTULO</th>
								<th>AVISO</th>
								<th>FECHA</th>
								<th>EDITAR</th>
								<th>ELIMINAR</th>
							</tr>
						</thead>


						<tbody>
							<!-- CODIGO PARA VER EN LA TABLA -->
							<?php
							while ($regaviso = $resultadoavisos->fetch_array(MYSQLI_BOTH)) {
								echo "
                            <tr>
										<td>" . $regaviso['titulo'] . "</td>	
                                        <td>" . $regaviso['aviso'] . "</td>
                                        <td>" . $regaviso['fecha'] . "</td>
                                        <td><a href='modificar.php?id=" . $regaviso['id'] . "'><img src='../../../../svg/editar.svg'></a></td>
                                        <td><a href='eliminar.php?id=" . $regaviso['id'] . "'><img src='../../../../svg/eliminar.svg'></a></td>
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
	<script src="../../../../js/bootstrap.bundle.min.js"></script>
</body>

</html>