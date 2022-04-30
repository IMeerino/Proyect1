<?php
	
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
	
	$numeroact = $_POST['numa'];
	$nombreact = $_POST['noma']; 
	$descripact = $_POST['desa'];
	$videact = $_POST['vida'];
	$ide = $_POST["IDD"];
	
	$sql = "INSERT INTO actividades (numeroactividad, nombreactividad, descripciona, enlace, idsubtema) 
	VALUES ('$numeroact', '$nombreact', '$descripact', '$videact', '$ide')";
	$resultado = $conexion->query($sql);
	$id_insert = $conexion->insert_id;
	
	if($_FILES["archivo"]["error"]>0){
		
		} else {
		
		$permitidos = array("image/gif","image/png","image/jpg","application/pdf","image/jpeg","application/octet-stream","application/msword","application/docx","application/vnd.ms-word");
		
		
		if(in_array($_FILES["archivo"]["type"], $permitidos) && $_FILES["archivo"]["size"]){
			
			$ruta = 'files/'.$id_insert.'/';
			$archivo = $ruta.$_FILES["archivo"]["name"];
			
			if(!file_exists($ruta)){
				mkdir($ruta);
			}
			
			if(!file_exists($archivo)){
				
				$resultado = @move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo);
				
				if($resultado){
					echo
					"<script>
						alert('Archivo Guardado');
						window.location='../control.php';
					</script>";
					} else {
					echo
					"<script>
						alert('Error al guardar archivo');
						window.location='../control.php';
					</script>";
				}
				
				} else {
				echo
					"<script>
						alert('Archivo ya existe');
						window.location='../control.php';
					</script>";
			}
			
			} else {
			echo
					"<script>
						alert('Archivo no permitido o excede el tamaño');
						window.location='../control.php';
					</script>";
			
		}
		
	}
	
?>

<html lang="es">
	<head>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.css" rel="stylesheet">
		<script src="js/jquery-3.5.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>	
	</head>
	
	<body>
		<div class="container">
			
			<div class="row text-center">
				<?php if($resultado) { ?>
					<h3>REGISTRO GUARDADO</h3>
					<?php } else { ?>
					<h3>ERROR AL GUARDAR</h3>
				<?php } ?>
			</div>
			<div class="row text-center">
				<a href="index.php" class="btn btn-primary">Regresar</a>
				
			</div>
		</div>
	</div>
</body>
</html>
