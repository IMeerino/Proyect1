
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


$id = $_GET['id'];

$sql = "SELECT * FROM avisos WHERE id = '$id'";
$resultado = $conexion->query($sql);
$rowa = $resultado->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Editar Aviso</title>
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







	<div class="container">
		<div class="row">
			<h3 style="text-align:center">MODIFICAR ACTIVIDAD</h3>
		</div>

		<form class="mt-5 mb-5"  method="POST" action="update.php" enctype="multipart/form-data" autocomplete="off">
		<div class="alert alert-success w-100 mx-auto fw-bolder" role="alert">
				<input type="hidden" id="id" name="id" value="<?php echo $rowa['id']; ?>" />
				<div class="form-row">
					
					<div class="mb-3 mx-auto text-truncate">
						<label>Título</label>
						<input type="text" class="form-control" name="tituloa" value="<?php echo $rowa['titulo']; ?>" required>
					</div>
					<div class="mb-3 mx-auto text-truncate">
						<label>Aviso</label>
						<input type="text" class="form-control" name="avisoa" value="<?php echo $rowa['aviso']; ?>" required>
					</div>
				</div>




				<div class="form-group text-truncate">
					<div class="custom-file text-truncate">
						<input type="file" class="custom-file-input" id="archivo" name="archivo">
						<label class="custom-file-label" for="customFile">Seleccionar archivo</label>
					</div>

					<?php
				$path = "files/" . $id;
				if (file_exists($path)) {
					$directorio = opendir($path);
					while ($archivo = readdir($directorio)) {
						if (!is_dir($archivo)) {
							echo "<div data='" . $path . "/" . $archivo . "'>
										<a href='" . $path . "/" . $archivo . "' title='Ver Archivo Adjunto'>
											<img src='../../../../svg/imagen.svg'>
										</a>";
							echo "$archivo 
										<a href='#' class='delete' title='Ver Archivo Adjunto' >
											<img src='../../../../svg/eliminar.svg'>
										</a>
								 </div>";
						}
					}
				}

				?>


				</div>
<br><br>
				<div class="form-group">
					<div class="mb-3 text-truncate">
						<button type="submit" class="btn btn-success fw-bolder">Modificar</button>
					</div>
				</div>
				
		</div>
		</form>
		
	</div>

	
</body>

</html>