<?php
//LOGEADO??
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../../../");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias</title>
    <link rel="stylesheet" href="./estilos.css">
    <!-- Bootstrap 5 CDN Links-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Alertas -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- =============== navegacion ================ -->
    <div class="contenedor-nav">
        <div class="navegacion">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="desktop-outline"></ion-icon>
                        </span>
                        <span class="title" id="Titulo">Sitema de reservas</span>
                    </a>
                </li>
                <li id="Inicio">
                    <a href="../index.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Inicio</span>
                    </a>
                </li>
                <li id="Reservas">
                    <a href="../reservas/reservas.php">
                        <span class="icon">
                            <ion-icon name="id-card-outline"></ion-icon>
                        </span>
                        <span class="title">Reservas</span>
                    </a>
                </li>
                <li id="Pagos">
                    <a href="../pagos/pagos.php">
                        <span class="icon">
                            <ion-icon name="id-card-outline"></ion-icon>
                        </span>
                        <span class="title">Pagos</span>
                    </a>
                </li>
                <li id="Categorias">
                    <a href="../categorias/categorias.php">
                        <span class="icon">
                            <ion-icon name="bookmarks-outline"></ion-icon>
                        </span>
                        <span class="title">Categorias</span>
                    </a>
                </li>
                <li id="Habitaciones">
                    <a href="../habitaciones/habitaciones.php">
                        <span class="icon">
                            <ion-icon name="bookmarks-outline"></ion-icon>
                        </span>
                        <span class="title">Habitaciones</span>
                    </a>
                </li>
                <li id="Servicios">
                    <a href="../servicios/servicios.php">
                        <span class="icon">
                            <ion-icon name="hand-right-outline"></ion-icon>
                        </span>
                        <span class="title">Servicios</span>
                    </a>
                </li>
                <li id="Usuarios">
                    <a href="../usuarios/usuarios.php">
                        <span class="icon">
                            <ion-icon name="person-circle-outline"></ion-icon>
                        </span>
                        <span class="title">Usuarios</span>
                    </a>
                </li>
                <li id="Clientes">
                    <a href="../clientes/clientes.php">
                        <span class="icon">
                            <ion-icon name="person-circle-outline"></ion-icon>
                        </span>
                        <span class="title">Clientes</span>
                    </a>
                </li>
                <li id="Cargos">
                    <a href="../cargos/cargos.php">
                        <span class="icon">
                            <ion-icon name="person-circle-outline"></ion-icon>
                        </span>
                        <span class="title">Cargos</span>
                    </a>
                </li>
                <li id="Huespedes">
                    <a href="./huespedes.php">
                        <span class="icon">
                            <ion-icon name="body-outline"></ion-icon>
                        </span>
                        <span class="title">Huespedes</span>
                    </a>
                </li>
                <li id="Mascotas">
                    <a href="../mascotas/mascotas.php">
                        <span class="icon">
                            <ion-icon name="body-outline"></ion-icon>
                        </span>
                        <span class="title">Mascotas</span>
                    </a>
                </li>
                <li id="Promociones">
                    <a href="../promociones/promociones.php">
                        <span class="icon">
                            <ion-icon name="cash-outline"></ion-icon>
                        </span>
                        <span class="title">Promociones</span>
                    </a>
                </li>
                <li>
                    <a href="../../../Inic/loggout.php">
                        <span class="icon">
                            <ion-icon name="enter-outline"></ion-icon>
                        </span>
                        <span class="title">Cerrar Sesion</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- ========================= principal ==================== -->
        <div class="principal">
            <div class="barratop">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="buscar">
                    <label>
                        <input type="text" placeholder="Buscar">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <img src="assets/imgs/customer01.jpg" alt="">
                </div>
            </div>
            <div>
            </div>
            <div class="dt-serv">
                <div class="serviciosTable">
                    <div class="cartaHeader">
                        <h2>Categorias</h2>
                    </div>
                    <div class="conte-btns">
                        <div>
                            <div class="btn-agregar" data-bs-toggle="modal" data-bs-target="#ventagregar">
                                Agregar
                            </div>
                        </div>
                        <div>
                            <button id="consulta-btn" onclick="tareaCompletada()" style="display: none;">Hacer Consulta</button>
                            <input id="buscador_tabla" type="text" placeholder="Buscar">
                        </div>
                    </div>

                    <table id="Tabla_Datos">
                        <thead>
                            <tr>
                                <td>Nombre</td>
                                <td>Descripción</td>
                                <td>Capacidad</td>
                                <td>Precio</td>
                                <td>Acciones</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include '../conexion.php';
                            $conn = conectarDB();
                            $sql = "SELECT * FROM tbl_categorias;";
                            $resultado = mysqli_query($conn, $sql);
                            while ($fila = mysqli_fetch_assoc($resultado)) {
                                echo "<tr>
                                <td>" . $fila['Nombre'] . "</td>
                                <td>" . $fila['Descripción'] . "</td>
                                <td>" . $fila['Capacidad'] . "</td>
                                <td>" . $fila['Precio'] . "$</td>
                                <td>
                                    <span class='btns btn-modificar' data-bs-toggle='modal' data-bs-target='#ventmodifi' onclick='ConfgVentModifiCat(" . json_encode($fila) . ")'>Modificar</span>
                                    <span class='btns btn-eliminar' onclick='ConfgVentElimCat(" . $fila['ID_Categoria'] . ");'>Eliminar</span>
                                </td>
                            </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="ventagregar" class="modal fade" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Agregar Categoría</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="form-agregar" action="" method="post" class = "forma">
                        <input type="hidden" name="agregar">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="text-nombre" class="form-label">Nombre:</label>
                                <input id="text-nombre" name="nombre" type="text" class="form-control" placeholder="Nombre" required>
                            </div>

                            <div class="mb-3">
                                <label for="text-desc" class="form-label">Descripción:</label>
                                <input id="text-desc" name="desc" type="text" class="form-control" placeholder="Descripción" required>
                            </div>

                            <div class="mb-3">
                                <label for="text-cap" class="form-label">Capacidad:</label>
                                <input id="text-cap" name="cap" type="number" class="form-control" min="1" max="10" placeholder="Capacidad" required>
                            </div>

                            <div class="mb-3">
                                <label for="text-cost" class="form-label">Precio:</label>
                                <input id="text-cost" name="cost" type="number" class="form-control" placeholder="Precio" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button class="btn btn-primary" name ="agregar" type="submit">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div id="ventmodifi" class="modal fade" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">modificar Categoría</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="form-modificar" action="" method="post" class = "forma">
                        <input type="hidden" name="modificar">
                        <input id="ID_Cat" type="hidden" name="ID_Cat">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="text-nombreCat" class="form-label">Nombre:</label>
                                <input id="text-nombreCat" name="nombre" type="text" class="form-control" placeholder="Nombre" required>
                            </div>

                            <div class="mb-3">
                                <label for="text-descCat" class="form-label">Descripción:</label>
                                <input id="text-descCat" name="desc" type="text" class="form-control" placeholder="Descripción" required>
                            </div>

                            <div class="mb-3">
                                <label for="text-capCat" class="form-label">Capacidad:</label>
                                <input id="text-capCat" name="cap" type="number" class="form-control" min="1" max="10" placeholder="Capacidad" required>
                            </div>

                            <div class="mb-3">
                                <label for="text-costCat" class="form-label">Precio:</label>
                                <input id="text-costCat" name="cost" type="text" class="form-control" placeholder="Precio" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button class="btn btn-primary" name ="modificar" type="submit">Modificar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        
        <div id="venteliminar" class="ventana">
            <div class="conte-vent">
                <ion-icon name="close-circle-outline" class="btns btn-cerrar" onclick="document.getElementById('venteliminar').style.display = 'none';"></ion-icon>
                <form class="forma" id="form-agregar" action="" method="post" name="agregar">
                    <input type="hidden" name="eliminar">
                    <input id="ID_CatElim" type="hidden" name="ID_Cat">
                    <p>Seguro que desea eliminar esta fila?</p>
                    <button type="submit">eliminar</button>
                </form>
            </div>
        </div>
        <!--Bootstrap 5 JS CDN Links -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

        <!-- =========== Scripts =========  -->
        <script src="main.js"></script>
        <script src="/Sistemas/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.js"></script>

        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>