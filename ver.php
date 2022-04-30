<?php
//incluye el archivo para establecer la conexion
require 'menu/usuarios/conexion.php';


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
    <title>Editar Actividad</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>



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
            <img src="logo.png" class="img-thumbnail" width="50">
            <a class="navbar-brand fs-3 fw-bold text-black" href="#">Secundaria Técnica 97</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a id="lista" class="nav-link active fs-5 fw-bold text-black" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a id="lista" class="nav-link fs-5 fw-bold text-black-50" href="menu/galeria/index.php">Galeria</a>
                    </li>
                    <li class="nav-item">
                        <a id="lista" class="nav-link fs-5 fw-bold text-black-50" href="menu/talleres/index.php">Talleres</a>
                    </li>
                    <li class="nav-item">
                        <a id="lista" class="nav-link fs-5 fw-bold text-black-50" href="menu/materias/index.php">Materias</a>
                    </li>
                    <li class="nav-item">
                        <a id="lista" class="nav-link fs-5 fw-bold text-black-50" href="menu/contacto/index.php">Contacto</a>
                    </li>
                    <a href="menu/usuarios/menulogin.php"><button class="btn btn-outline-success btn-light fs-7 fw-bold">Iniciar sesión</button></a>
                </ul>
            </div>
        </div>
    </nav>







    <div class="container">



        <div class=" modal modal-sheet position-static d-block mt-5 w-100 mx-auto  text-truncate py-5" tabindex="-1" role="dialog" id="modalSheet">
            <div class="modal-dialog" role="document">
                <input type="hidden" id="id" name="id" value="<?php echo $rowa['id']; ?>" />
                <div class="modal-content rounded-6 shadow">
                    <div class="modal-header border-bottom-0">
                        <h5 class="modal-title"><?php echo $rowa['titulo']; ?></h5>
                       <a href="index.php"> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></a>
                    </div>
                    <div class="modal-body py-0">
                        <p><?php echo $rowa['aviso']; ?></p>
                    </div>
                    <div class="modal-footer flex-column border-top-0">
                    <?php
				$path = "menu/usuarios/administrador/publicar_avisos/files/" . $id;
				if (file_exists($path)) {
					$directorio = opendir($path);
					while ($archivo = readdir($directorio)) {
						if (!is_dir($archivo)) {
							echo "<div data='" . $path . "/" . $archivo . "'>
										<a href='" . $path . "/" . $archivo . "' title='Ver Archivo Adjunto'>
											<img src='svg/imagen.svg'>
										</a>";
							echo "$archivo 
										
								 </div>";
						}
					}
				}

				?>
                    </div>
                </div>
            </div>
        </div>









   

    </div>


</body>

</html>