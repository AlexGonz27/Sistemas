<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../");
    exit;
} else {
    include './conexion.php';
    $conn = conectarDB();

    $sql = "SELECT * FROM tbl_cliente_persona WHERE ID_Cliente = '" . $_SESSION['user_id'] . "'";
    $resultado = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                cargarInfo(" . json_encode($resultado) . ");
            });
        </script>";
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conjunto Vacacional La Fuente</title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- FAVICON -->
    <link rel="icon" type="image/png" href="images/Favicon_Cabaña.png">

    <!-- Bootstrap 5 CDN Links-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <!-- Custom File's Link -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive-style.css">

    <!-- Alertas -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="100">

    <!-- navbar section -->
    <header class="header_wrapper">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <div class="logo">
                    <a class="navbar-brand" href="#">
                        <img src="images/Logo.png" class="img-fluid radius-100" alt="logo">
                        <span class="navbar-brand me-auto">Cabañas La Fuente</span>
                    </a>
                </div>


                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <!-- <span class="navbar-toggler-icon"></span> -->
                    <i class="fas fa-stream navbar-toggler "></i>
                </button>

                <div class="collapse navbar-collapse justify-content-end " id="navbarNav">
                    <ul class="navbar-nav menu-navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#Home">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#About">Conocenos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#Rooms">Habitaciones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#Gallery">Galeria</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#Price">Ubicación</a>
                        </li>
                        <li class="nav-item">
                            <?php

                            $conn = conectarDB();

                            $sql = "SELECT * FROM tbl_cliente_persona WHERE ID_Cliente = '" . $_SESSION['user_id'] . "'";
                            $resultado = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                            echo "<a id='name-user' class='nav-link mod' data-bs-toggle='modal' data-bs-target='#DatosUser' onclick='ConfgVentModifi(" . json_encode($resultado) . ")'>usuario</a>";
                            mysqli_close($conn);
                            ?>

                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!-- navbar section exit -->



    <!-- Modal datos Usuario -->
    <div class="modal fade" id="DatosUser" tabindex="-1" aria-labelledby="User" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #009970;">
                    <h5 class="modal-title" id="User" style="color: white;">Datos de Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-modificar" action="" method="post" class="forma">
                    <input type="hidden" name="modificar">
                    <input type="hidden" name="Nacionalidad">
                    <input id="ID_Clt" type="hidden" name="ID_Clt">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="text-Name_RS" class="form-label">Nombre:</label>
                            <input id="text-Name_RS" name="name_rs" type="text" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="text-CI" class="form-label">Identificación:</label>
                            <input id="text-CI" name="CI" type="text" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="text-Direc" class="form-label">Dirección:</label>
                            <input id="text-Direc" name="direc" type="text" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="text-Tlf" class="form-label">Teléfono:</label>
                            <input id="text-Tlf" name="tlf" type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="text-Fn" class="form-label">Fecha de Nacimiento:</label>
                            <input id="text-Fn" name="fn" type="date" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button class="btn btn-primary" name="modificar" type="submit" style="background-color: #009970; border-color: #009970;">Editar</button>
                        <div>
                            <a type="button" class="btn" style="background-color: #F6AD34; color: white;" data-bs-toggle="modal" data-bs-target="#Lis_res">Reservas</a>
                            <a type="button" class="btn btn-danger" href="../Inic/loggout.php">Cerrar Sesión</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Datos de Reservas -->
    <div class="modal fade" id="Lis_res" tabindex="-1" aria-labelledby="User" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #009970;">
                    <h5 class="modal-title" id="User" style="color: white;">Datos de Reservas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="Tabla_Datos" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Habitación</th>
                                <th>Fecha de Entrada</th>
                                <th>Fecha de Salida</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $conn = conectarDB();
                            $sql = "SELECT * FROM tbl_reservacion WHERE ID_Cliente = '" . $_SESSION['user_id'] . "'";
                            $resultado = mysqli_query($conn, $sql);
                            while ($fila = mysqli_fetch_assoc($resultado)) {
                                $id = $fila['ID_Habitacion'];
                                $sqlCat = "SELECT * FROM tbl_habitaciones_categoria WHERE ID_Habitaciones = '$id'";
                                $result = mysqli_fetch_assoc(mysqli_query($conn, $sqlCat));
                                echo "<tr>
                                <td>" . htmlspecialchars($fila['Codigo_Reserva']) . "</td>  
                                <td>Nº-" . htmlspecialchars($result['N_Habitación']) . "</td>
                                <td>" . htmlspecialchars($fila['Fecha_Entrada']) . "</td>
                                <td>" . htmlspecialchars($fila['Fecha_Salida']) . "</td>
                                <td>" . htmlspecialchars($fila['Estado']) . "</td>
                                <td>
                                    <span class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#ventanular' onclick='ConfgVentElim(" . $fila['ID_Reservación'] . ")'>Anular</span>
                                </td>
                            </tr>";
                            }
                            mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




    <div id="ventanular" class="modal fade" tabindex="-1" aria-labelledby="User" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #009970;">
                    <h5 class="modal-title" id="modalLabelEliminar" style="color: white;">Anular Reserva</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-eliminar" action="" method="post" class="forma">
                    <input type="hidden" name="anular">
                    <input id="ID_ResElim" type="hidden" name="ID_Res">
                    <div class="modal-body">
                        <p>¿Seguro que desea anular esta reserva?</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" name="anular " type="submit">Anular</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- seccion Conocenos -->
    <section id="Home" class="banner_wrapper p-0">
        <div class="swiper myswiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide" style="background-image: url(./images/slider/slider2.jpg);">
                    <div class="slide-caption text-center">
                        <div>
                            <h1>Bienvenido al Conjunto Vacacional La Fuente</h1>
                            <p>Nuestras cabañas son más que simples alojamientos; son portales hacia momentos inolvidables. ¿Listo para vivir la experiencia? No esperes más. Tu escapada está a un clic de distancia.</p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide" style="background-image: url(./images/slider/slider1.webp);">
                    <div class="slide-caption text-center">
                        <div>
                            <h1>Bienvenido al Conjunto Vacacional La Fuente</h1>
                            <p>Nuestras cabañas son más que simples alojamientos; son portales hacia momentos inolvidables. ¿Listo para vivir la experiencia? No esperes más. Tu escapada está a un clic de distancia. </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <div class="container booking-area shadow mb-3" id="forma-disponibilidad">
            <form class="row forma">
                <div class="col-lg mb-3 mb-lg-0">
                    <span class="input-group-text" id="adulto-input">Fecha Entrada</span>
                    <input type="date" class="form-control" placeholder="Date" name="fch_ent">
                </div>
                <div class="col-lg mb-3 mb-lg-0">
                    <span class="input-group-text" id="adulto-input">Fecha Salida</span>
                    <input type="date" class="form-control" placeholder="Date" name="fch_sal">
                </div>
                <div class="col-lg mb-3 mb-lg-0">
                    <span class="input-group-text" id="adulto-input">Adultos</span>
                    <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="adulto-input" min="1" value="1">
                </div>
                <div class="col-lg mb-3 mb-lg-0">
                    <span class="input-group-text" id="menores-input">Niños</span>
                    <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="menores-input" min="0" value="0">
                </div>
                <div class="col-lg mb-3 mb-lg-0">
                    <span class="input-group-text" id="Mascotas-input">Mascotas</span>
                    <div class="form-check-inline" style="margin-top: 10px;">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioMascotaSi" style="background-color: #009970;">
                        <label class="form-check-label" for="flexRadioMascotaSi">
                            Si.
                        </label>
                    </div>
                    <div class="form-check-inline" style="margin-top: 10px;">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioMascotaNO" checked style="background-color: #009970;">
                        <label class="form-check-label" for="flexRadioMascotaNO">
                            No.
                        </label>
                    </div>
                </div>

                <div class="col-lg mb-3 mb-lg-0">
                    <button type="submit" class="main-btn rounded-2 px-lg-3">disponible</button>
                </div>
            </form>
        </div>
    </section>
    <!-- banner section exit-->

    <!-- Sección de Disponibilidad -->
    <section id="Disponibilidad" class="about_wrapper mt-5" style="display: none;">
        <div class="container booking-area shadow p-4">
            <div class="row">
                <div class="col-sm-6">
                    <h2 class="text-start mb-4" style="color: #009970; font-size: 1.8rem;">Reservación</h2>
                    <h4 class="text-start" style="font-weight: bold;">Categoría: <span id="room-name" class="ms-2" style="font-size: 1.2rem; font-weight: normal;"></span></h4>

                    <h4 class="text-start" style="font-weight: bold;">Nº Habitación: <span id="room-numH" class="ms-2" style="font-size: 1.2rem; font-weight: normal;"></span></h4>

                    <h4 class="text-start" style="font-weight: bold;">Descripción: <span id="room-description" class="ms-2" style="font-size: 1.2rem; font-weight: normal;"></span></h4>

                    <h4 class="text-start" style="font-weight: bold;">Precio:</h4>
                    <p class="text-start" style="font-size: 1.2rem; font-weight: normal;">
                        <span id="room-price"></span> $ / Por Noche
                    </p>

                    <div class="text-end mt-4">
                        <button class="btn btn-primary" style="background-color: #F6AD34; border: none;">Reservar</button>
                    </div>

                    <div id="habitaciones-container" class="mt-4"></div>
                </div>
                <div class="col-sm-6">
                    <div id="carouselImages" class="carousel slide" data-bs-ride="false">
                        <div class="carousel-inner" id="resultadoDisponibilidad">
                            <!-- Habitaciones disponibles -->
                        </div>

                        <!-- Botones de control del carrusel -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselImages" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Siguiente</span>
                        </button>
                    </div>
                    <div id="noContentMessage" class="no-content text-center mt-3" style="display: none;">
                        <p>No hay habitaciones disponibles.</p>
                    </div>
                    <div class="text-center mt-2">
                        <button id="btn-addHabitacion" type="button" class="btn btn-success" style="background-color: #009970;">
                            <i class="bi bi-plus-circle"></i> Añadir
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Fin de Sección de Disponibilidad -->


    <!-- Seccion de Informacion -->
    <section id="About" class="about_wrapper mt-2">
        <div class="container">
            <div class="row flex-lg-row flex-column-reverse">
                <div class="col-lg-6 text-center text-lg-start">
                    <h3>Bienvenido a el <span>Conjunto Vacacional <br class="d-none d-lg-block">
                            La Fuente</span> donde la pasaras excelente.</h3>
                    <p> En Conjunto Vacacional La Fuente, te ofrecemos una variedad de cabañas para que disfrutes de una escapada inolvidable. Sumérgete en la relajación y el sol en nuestras cabañas con piscina. Disfruta de un día de poolday junto a la piscina, rodeado de naturaleza y tranquilidad. ¿Buscas un refugio romántico? Nuestras cabañas matrimoniales son perfectas para parejas. Con detalles acogedores, jacuzzi y vistas panorámicas, te brindarán momentos inolvidables.Si vienes en familia, nuestras cabañas familiares son ideales. Espacios amplios, cocina equipada y comodidades para todos. ¡Un fin de semana en familia que no olvidarás!</p>

                    <p>Así que, ya sea en pareja o con tus seres queridos, te esperamos para que vivas momentos especiales en nuestras cabañas. ¡Bienvenidos a la Fuente!</p>
                    <a href="#" class="main-btn mt-4">Explorar</a>
                </div>
                <div class="col-lg-6 mb-4 mb-lg-0 ps-lg-4 text-center">
                    <img src="./images/Bienvenido a las Cabañas de la Fuente-Photoroom.png" class="img-fluid" alt="about">
                </div>
            </div>
        </div>
    </section>
    <!-- Fin de Seccion de Informacion-->

    <!-- Sección de Habitaciones -->
    <section id="Rooms" class="room_wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 section-title text-center mb-5">
                    <h6>Ven y Disfruta de Nuestras Habitaciones</h6>
                    <h3>Nuestras Habitaciones</h3>
                </div>
            </div>
            <div id="carouselRooms" class="carousel slide" data-bs-ride="carousel">
                <!-- Indicadores del carrusel -->
                <div class="carousel-indicators">
                    <?php
                    // Conectar a la base de datos
                    $conn = conectarDB();

                    // Consulta para obtener las habitaciones
                    $sql = "SELECT * FROM tbl_habitaciones_categoria";
                    $result = mysqli_query($conn, $sql);
                    $totalRooms = mysqli_num_rows($result);
                    $roomsPerSlide = 3; // Número de habitaciones por diapositiva
                    $roomCount = 0; // Contador de habitaciones en la diapositiva actual
                    $slideCount = 0; // Contador de diapositivas

                    // Verificar si hay habitaciones disponibles
                    if ($totalRooms > 0) {
                        // Generar indicadores
                        while ($roomCount < $totalRooms) {
                            if ($roomCount % $roomsPerSlide == 0) {
                                echo "<button type='button' data-bs-target='#carouselRooms' data-bs-slide-to='$slideCount' class='" . ($slideCount === 0 ? 'active' : '') . "' aria-current='" . ($slideCount === 0 ? 'true' : 'false') . "' aria-label='Slide " . ($slideCount + 1) . "'></button>";
                                $slideCount++;
                            }
                            $roomCount++;
                        }
                    }
                    ?>
                </div>
                <div class="carousel-inner">
                    <?php
                    // Reiniciar el contador de habitaciones para mostrar el contenido
                    $roomCount = 0; // Reiniciar el contador de habitaciones

                    // Verificar si hay habitaciones disponibles
                    if ($totalRooms > 0) {
                        while ($fila = mysqli_fetch_assoc($result)) {
                            // Obtener la categoría de la habitación
                            $sql = "SELECT * FROM tbl_categorias WHERE ID_Categoria = '" . $fila['ID_Categoria'] . "'";
                            $categoria = mysqli_fetch_assoc(mysqli_query($conn, $sql));

                            // Iniciar una nueva diapositiva si el contador de habitaciones alcanza el número por diapositiva
                            if ($roomCount % $roomsPerSlide == 0) {
                                if ($roomCount > 0) {
                                    echo "</div></div>"; // Cerrar la diapositiva anterior
                                }
                                echo "<div class='carousel-item " . ($roomCount === 0 ? 'active' : '') . "'>";
                                echo "<div class='row m-0'>";
                            }

                            // Mostrar el elemento de la habitación
                            echo "
                                <div class='col-md-4 mb-4'>
                                    <div class='room-items'>
                                        <img src='.." . $fila['imagen'] . "' class='img-fluid' alt='room'>
                                        <div class='room-item-wrap'>
                                            <div class='room-content'>
                                                <h5 class='text-white mb-lg-5 text-decoration-underline'>" . $categoria['Nombre'] . "</h5>
                                                <p class='text-white'>" . $fila['Descripción'] . "</p>
                                                <p class='text-white fw-bold mt-lg-4'>" . $categoria['Precio'] . "$ / Por Noche</p>
                                                <a class='main-btn border-white text-white mt-lg-5' href='#'>Reserva Ahora</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>";

                            $roomCount++;
                        }
                        // Cerrar la última diapositiva
                        echo "</div></div>";
                    }

                    // Cerrar la conexión a la base de datos
                    mysqli_close($conn);
                    ?>
                </div>
                <!-- Botones de control del carrusel -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselRooms" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselRooms" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
        </div>
    </section>
    <!-- Fin de Sección de Habitaciones -->

    <!-- Seccion de Galeria -->
    <section id="Gallery" class="gallery_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 section-title text-center mb-5">
                    <h6>Las Mejores Fotos de Nuestro Cojunto Vacional</h6>
                    <h3>Nuestra Galeria</h3>
                </div>
            </div>
            <div class="row g-0">
                <div class="col-lg-3 col-md-6 gallery-item">
                    <img src="images/Galeria/1.webp" class="img-fluid w-100" alt="">
                    <div class="gallery-item-content"></div>
                </div>
                <div class="col-lg-3 col-md-6 gallery-item">
                    <img src="images/Galeria/2.webp" class="img-fluid w-100" alt="">
                    <div class="gallery-item-content"></div>
                </div>
                <div class="col-lg-3 col-md-6 gallery-item">
                    <img src="images/Galeria/3.jpg" class="img-fluid w-100" alt="">
                    <div class="gallery-item-content"></div>
                </div>
                <div class="col-lg-3 col-md-6 gallery-item">
                    <img src="images/Galeria/4.webp" class="img-fluid w-100" alt="">
                    <div class="gallery-item-content"></div>
                </div>
                <div class=" col-lg-3 gallery-item">
                    <img src="images/Galeria/5.webp" class="img-fluid w-100" alt="">
                    <div class="gallery-item-content"></div>
                </div>
                <div class="col-lg-3 gallery-item">
                    <img src="images/Galeria/6.webp" class="img-fluid w-100" alt="">
                    <div class="gallery-item-content"></div>
                </div>
                <div class="col-lg-3 gallery-item">
                    <img src="images/Galeria/7.webp" class="img-fluid w-100" alt="">
                    <div class="gallery-item-content"></div>
                </div>
                <div class="col-lg-3 gallery-item">
                    <img src="images/Galeria/8.webp" class="img-fluid w-100" alt="">
                    <div class="gallery-item-content"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- Fin de Seccion de Galeria-->

    <!-- Ubicacion -->
    <section id="Price" class="Price_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 section-title text-center mb-5">
                    <h6>Ven y Encuentranos</h6>
                    <h3>Nuestra Ubicacion</h3>
                </div>
            </div>
            <div class="mapa container-fluid bg-white p-0">

                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1164.0955215478027!2d-63.861293791820394!3d11.073447196436595!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c3191299b824a11%3A0xd1aae6083270ac8!2sConjunto%20Vacacional%20La%20Fuente!5e0!3m2!1ses!2sve!4v1722833472645!5m2!1ses!2sve" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

            </div>
        </div>
        </div>
    </section>
    <!-- Fin Ubciacion-->


    <!-- footer section -->
    <section id="contact" class="footer_wrapper mt=3  mt-md-0 pb-0">
        <div class="container pb-3">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <h5>Ubicación La Fuente</h5>
                    <p class="ps-0">Calle Juan Tineo, sector la Fuente, al lado del Ambulatorio, Isla de Margarita.</p>
                    <div class="contact-info">
                        <ul class="list-unstyled">
                            <li><a href="https://maps.app.goo.gl/kv9aCvvUt3coXsAdA"><i class="fa fa-home me-3"></i>La Fuente, 6317, Nueva Esparta</a></li>
                            <li><a href="#"><i class="fa fa-phone me-3"></i>0295-2425816</a></li>
                            <li><a href="#"><i class="fa fa-envelope me-3"></i>CabañaLaFuente@gmail.com</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">

                </div>
                <div class="col-lg-3 col-md-6">

                </div>
                <div class="col-lg-3 col-md-6">
                    <h5>Mantente conectado</h5>
                    <ul class="social-network d-flex align-items-center p-0">
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="https://www.instagram.com/p/Cb8ThH3J7qJ/"><i class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>

            </div>
        </div>
        </div>

        <div class="container-fluid copyright-section">
            <p>Copyright <a href="#">© CRUPO NARANJA.</a> Derechos de Autor.</p>
        </div>
    </section>
    <!-- footer section Exit-->







    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!--Bootstrap 5 JS CDN Links -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <!-- Custom Js Link -->
    <script src="./main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>

</html>