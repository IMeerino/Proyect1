<?php
//incluye el archivo para establecer la conexion
include("../../conexion.php");

//inicia la sesion
session_start();

/*VALIDA LA SESION PARA QUE NO PUEDAN ENTRAR DIRECTO
y si no hay sesion lo manda al login
*/
if (!isset($_SESSION['id_usuario'])) {
    header("location: ../loginm.php");
}

/*es para verificar que usuarios diferentes
al administrador no puedan logearse
*/
$nivel = $_SESSION['tipo_usuario'];
if ($nivel != "2") {
    header("location: ../loginm.php");
}

$ID = $_GET['id'];

$eliminarsubtema = "DELETE FROM subtemas
                        WHERE idsubtema = '$ID'";
$resultadosubtema = $conexion->query($eliminarsubtema);

echo "<script>
        alert('Registro eliminado');
        window.location='control.php';
    </script>";
$conexion->close();

?>