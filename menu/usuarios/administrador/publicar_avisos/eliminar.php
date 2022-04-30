<?php
	
//incluye el archivo para establecer la conexion
include("../../conexion.php");

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

	$id = $_GET['id'];
	
	$sql = "DELETE FROM avisos WHERE id = '$id'";
	$resultado = $conexion->query($sql);
	
	eliminarDir('files/'.$id);
	
	function eliminarDir($carpeta)
	{
		foreach(glob($carpeta . "/*") as $archivos_carpeta)
		{
			if (is_dir($archivos_carpeta))
			{
				eliminarDir($archivos_carpeta);
			}
			else
			{
				unlink($archivos_carpeta);
			}
		}
		rmdir($carpeta);
	}
	echo "<script>
        alert('Registro eliminado');
        window.location='index.php';
    </script>";
$conexion->close();
?>
