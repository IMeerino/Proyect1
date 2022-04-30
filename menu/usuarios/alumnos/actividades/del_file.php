<?php
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
if ($nivel != "3") {
	header("location: ../../loginm.php");
}
	
	$file = $_POST['id'];
	
	if(is_file($file)){
		chmod($file,0777);
		if(!unlink($file)){
		echo false;
		}
	}
	
?>