<?php
	
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
	
	$id = $_POST['id'];
	$titulo = $_POST['tituloa'];
	$aviso = $_POST['avisoa'];
	
	$sql = "UPDATE avisos 
	SET titulo='$titulo', aviso='$aviso' 
	WHERE id = '$id'";
	$resultado = $conexion->query($sql);
	$id_insert = $id;
	
	if($_FILES["archivo"]["error"]>0){

		echo
						"<script>
							alert('Modificado');
							window.location='index.php';
						</script>";
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
						window.location='index.php';
					</script>";
					} else {
						echo
						"<script>
							alert('Error al Guardar el Archivo');
							window.location='index.php';
						</script>";
				}
				
				} else {
					echo
					"<script>
						alert('Archivo ya existe');
						window.location='index.php';
					</script>";
			}
			
			} else {
			echo
					"<script>
						alert('Archivo no permitido o excede el tamaño');
						window.location='index.php';
					</script>";
		}
		
	}
	
	
?>

