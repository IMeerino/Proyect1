<?php
//incluye el archivo para establecer la conexion
include("../conexion.php");

//inicia la sesion
session_start();

/*VALIDA LA SESION PARA QUE NO PUEDAN ENTRAR DIRECTO
y si no hay sesion lo manda al login
*/
if (!isset($_SESSION['id_usuario'])) {
    header("location: loginadmin.php");
}

/*es para verificar que usuarios diferentes
al administrador no puedan logearse
*/
$nivel = $_SESSION['tipo_usuario'];
if ($nivel != "1") {
    header("location: loginadmin.php");
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



//VER ADMINISTRADORES
$usuarios = "SELECT u.idusuario,
            u.nombrecompleto,
            u.nombreu,
            u.contrau,
            t.tipousuario
            FROM usuarios AS u
            INNER JOIN tipo_usuario AS t
            ON u.idtipousuario=t.idtipousuario
            WHERE u.idtipousuario=1
            ORDER BY u.nombrecompleto";
$resultadousuariosa = $conexion->query($usuarios);

//VER MAESTROS
$usuarios = "SELECT u.idusuario,
            u.nombrecompleto,
            u.nombreu,
            u.contrau,
            t.tipousuario
            FROM usuarios AS u
            INNER JOIN tipo_usuario AS t
            ON u.idtipousuario=t.idtipousuario
            WHERE u.idtipousuario=2
            ORDER BY u.nombrecompleto";
$resultadousuariosm = $conexion->query($usuarios);

//VER GRUPOS 
$usuarios = "SELECT u.idusuario,
            u.nombrecompleto,
            u.nombreu,
            u.contrau,
            t.tipousuario,
            g.turno,
            g.grado,
            g.grupo
            FROM usuarios AS u
            INNER JOIN tipo_usuario AS t
            ON u.idtipousuario=t.idtipousuario
            INNER JOIN grupos AS g
            ON g.idusuario=u.idusuario
            WHERE u.idtipousuario=3
            ORDER BY g.turno,g.grupo";
$resultadousuariosg = $conexion->query($usuarios);

//VER AVISOS 
$avisos = "SELECT id,
titulo,
aviso,
fecha 
FROM avisos";
$resultadoavisos = $conexion->query($avisos);

//VER BUZON
$buzon = "SELECT *
            FROM buzon 
            ORDER BY fecha";
$resultadosbuzon = $conexion->query($buzon);

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de control</title>
    <!--CSS Boostrap-->
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../../../css/style.css">
</head>

<body class=" bg-primary ">

    <nav class="navbar navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <img src="../../../logo.png" alt="" width="50">
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
                            <a class="nav-link fs-5 fw-bold" href="panel.php">Panel de Control</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fs-5 fw-bold" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Administrar Usuarios
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                                <li><a class="dropdown-item" href="administrar_usuarios/administradores/control.php">Administradores</a></li>
                                <li><a class="dropdown-item" href="administrar_usuarios/maestros/control.php">Maestros</a></li>
                                <li><a class="dropdown-item" href="administrar_usuarios/grupos/control.php">Grupos</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link fs-5 fw-bold" href="buzon_de_mensajes/buzon.php">Buzón de Mensajes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-5 fw-bold" href="publicar_avisos/index.php">Publicar Avisos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-5 fw-bold" href="../cerrarsesion.php">Cerrar Sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>


    <main class="antescontenedorcss">
        <div class="contenedorcss">








            <div class="row row-cols-1 row-cols-md-2 g-4 w-100">

                <div class="col">
                    <div class="card bg-light text-black ">

                        <div class="accordion w-100 mx-auto" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <b>USUARIOS ADMINISTRADORES</b>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class=" accordion-body bg-black text-light fw-bold mx-auto table table-responsive">


                                        <table class="table bg-light">

                                            <thead class="table-dark table align-middle">

                                                <tr>
                                                    <td>Nombre</td>
                                                    <td>Usuario</td>
                                                    <td>Contraseña</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- CODIGO PARA VER EN LA TABLA -->
                                                <?php
                                                while ($regusuario = $resultadousuariosa->fetch_array(MYSQLI_BOTH)) {
                                                    echo "
    <tr>
        <td>" . $regusuario['nombrecompleto'] . "</td>
        <td>" . $regusuario['nombreu'] . "</td>
        <td>" . $regusuario['contrau'] . "</td>
    </tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>


                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <b>USUARIOS MAESTROS</b>
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body bg-black text-light fw-bold">
                                        <table class="table bg-light">

                                            <thead class="table-dark table align-middle">

                                                <tr>
                                                    <td>Nombre</td>
                                                    <td>Usuario</td>
                                                    <td>Contraseña</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- CODIGO PARA VER EN LA TABLA -->
                                                <?php
                                                while ($regusuario = $resultadousuariosm->fetch_array(MYSQLI_BOTH)) {
                                                    echo "
<tr>
<td>" . $regusuario['nombrecompleto'] . "</td>
<td>" . $regusuario['nombreu'] . "</td>
<td>" . $regusuario['contrau'] . "</td>
</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <b>USUARIOS GRUPOS</b>
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body bg-black text-light fw-bold">
                                        <table class="table bg-light">

                                            <thead class="table-dark table align-middle">

                                                <tr>
                                                    <td>Nombre</td>
                                                    <td>Usuario</td>
                                                    <td>Contraseña</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- CODIGO PARA VER EN LA TABLA -->
                                                <?php
                                                while ($regusuario = $resultadousuariosg->fetch_array(MYSQLI_BOTH)) {
                                                    echo "
<tr>
<td>" . $regusuario['nombrecompleto'] . "</td>
<td>" . $regusuario['nombreu'] . "</td>
<td>" . $regusuario['contrau'] . "</td>
</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>








                <div class="col">
                    <div class="card text-truncate">


                    <table class="table">
						<thead class="table-dark">
							<tr>
								<td class="bg-info fs-5 fw-bold text-center" colspan="8"> AVISOS </td>
							</tr>
							<tr>
								<th>TÍTULO</th>
								
								<th>EDITAR</th>
								
							</tr>
						</thead>


						<tbody>
							<!-- CODIGO PARA VER EN LA TABLA -->
							<?php
							while ($regaviso = $resultadoavisos->fetch_array(MYSQLI_BOTH)) {
								echo "
                            <tr>
										<td>" . $regaviso['titulo'] . "</td>	
                                        
                                        <td><a href='publicar_avisos/modificar.php?id=" . $regaviso['id'] . "'><img src='../../../svg/editar.svg'></a></td>
                                        
                            </tr>";
							}
							?>
						</tbody>
					</table>



                    </div>
                </div>

            </div>






      



            <div class="table-responsive rounded-3 mx-auto mt-5 text-truncate">


                <table class="table">

                    <thead class="table-dark">
                        <tr>
                            <td class="bg-success fs-5 fw-bold text-center" colspan="6">BUZÓN DE MENSAJES</td>
                        </tr>
                        <tr>
                            <td>Nombre</td>
                            <td>Correo</td>
                            <td>Telefono</td>
                            <td>Mensaje</td>
                            <td>Fecha</td>
                            <td>Eliminar</td>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- CODIGO PARA VER EN LA TABLA -->
                        <?php
                        while ($regusuario = $resultadosbuzon->fetch_array(MYSQLI_BOTH)) {
                            echo "
                    <tr class='bg-white' >
                        <td>" . $regusuario['nombreb'] . "</td>
                        <td>" . $regusuario['correob'] . "</td>
                        <td>" . $regusuario['telefonob'] . "</td>
                        <td>" . $regusuario['mensajeb'] . "</td>
                        <td>" . $regusuario['fecha'] . "</td>
                        <td><a href='eliminar.php?id=" . $regusuario['idb'] . "'><img src='../../../svg/eliminar.svg'></a></td>
                    </tr>";
                        }
                        ?>
                    </tbody>
                </table>





            </div>




















        <br><br>


        </div>
    </main>


    <!-- JS Boostrap -->
    <script src="../../../js/bootstrap.bundle.min.js"></script>
</body>

</html>