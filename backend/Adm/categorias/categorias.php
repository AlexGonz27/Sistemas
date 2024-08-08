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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Alertas -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- =============== Navegación ================ -->
    <div class="contenedor-nav">
        <div class="navegacion">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="desktop-outline"></ion-icon>
                        </span>
                        <span class="title" id="Titulo">Sistema de Reservas</span>
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
                            <ion-icon name="cash-outline"></ion-icon>
                        </span>
                        <span class="title">Pagos</span>
                    </a>
                </li>
                <li id="Categorias">
                    <a href="../categorias/categorias.php">
                        <span class="icon">
                            <ion-icon name="bookmarks-outline"></ion-icon>
                        </span>
                        <span class="title">Categorías</span>
                    </a>
                </li>
                <li id="Habitaciones">
                    <a href="../habitaciones/habitaciones.php">
                        <span class="icon">
                            <ion-icon name="bed-outline"></ion-icon>
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
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Clientes</span>
                    </a>
                </li>
                <li id="Cargos">
                    <a href="../cargos/cargos.php">
                        <span class="icon">
                            <ion-icon name="briefcase-outline"></ion-icon>
                        </span>
                        <span class="title">Cargos</span>
                    </a>
                </li>
                <li id="Huespedes">
                    <a href="./huespedes.php">
                        <span class="icon">
                            <ion-icon name="body-outline"></ion-icon>
                        </span>
                        <span class="title">Huéspedes</span>
                    </a>
                </li>
                <li id="Mascotas">
                    <a href="../mascotas/mascotas.php">
                        <span class="icon">
                            <ion-icon name="paw-outline"></ion-icon>
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
                        <span class="title">Cerrar Sesión</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- ========================= principal ==================== -->
    <div class="principal">
        <div class="barratop">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>

            <div class="buscar">
                <div class="input-group">
                    <input id="buscador_tabla" type="text" class="form-control ps-4 rounded-pill" placeholder="  Buscar" aria-label="Buscar">
                    <span class="input-group-text bg-transparent border-0">
                        <i class="bi bi-search"></i>
                    </span>
                </div>
            </div>


            <div class="user">
                <i class="bi bi-person-circle" style="font-size: 30px; color: #009970;"></i>
            </div>
        </div>
        <div class="container mt-5">
            <div class="dt-serv">
                <div class="serviciosTable">
                    <div class="cartaHeader d-flex justify-content-between align-items-center">
                        <h2 style="color: #009970;">Categorías</h2>
                        <div class="conte-btns">
                            <div>
                                <div class="btn-agregar" data-bs-toggle="modal" data-bs-target="#ventagregar" style="background-color: #009970; color: white; padding: 10px 20px; border-radius: 5px; text-align: center;">
                                    Agregar
                                </div>
                            </div>
                        </div>
                    </div>

                    <table id="Tabla_Datos" class="table mt-3">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Capacidad</th>
                                <th>Precio</th>
                                <th>Acciones</th>
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
                                <td>" . htmlspecialchars($fila['Nombre']) . "</td>
                                <td>" . htmlspecialchars($fila['Descripción']) . "</td>
                                <td>" . htmlspecialchars($fila['Capacidad']) . "</td>
                                <td>" . htmlspecialchars($fila['Precio']) . "$</td>
                                <td>
                                    <span class='btns btn-modificar' data-bs-toggle='modal' data-bs-target='#ventmodifi' onclick='ConfgVentModifiCat(" . json_encode($fila) . ")'>
                                        <i class='bi bi-pencil-square'></i>
                                    </span>
                                    <span class='btns btn-eliminar' data-bs-toggle='modal' data-bs-target='#venteliminar' onclick='ConfgVentElimCat(" . $fila['ID_Categoria'] . ");'>
                                        <i class='bi bi-trash'></i>
                                    </span>
                                </td>
                            </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- Ventana Agregar -->
        <div id="ventagregar" class="modal fade" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #009970;">
                        <h5 class="modal-title" id="modalLabel" style="color: white;">Agregar Categoría</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>
                    <form id="form-agregar" action="" method="post" class="forma">
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
                            <button class="btn btn-primary" name="agregar" type="submit" style="background-color: #009970; border-color: #009970;">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Fin de Ventana Agregar -->

        <!-- Ventana Modificar -->
        <div id="ventmodifi" class="modal fade" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #009970;">
                        <h5 class="modal-title" id="modalLabel" style="color: white;">modificar Categoría</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="form-modificar" action="" method="post" class="forma">
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
                            <button class="btn btn-primary" name="agregar" type="submit" style="background-color: #009970; border-color: #009970;">Modificar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Fin de Ventana Modificar -->

        <!-- Ventana Eliminar -->
        <div id="venteliminar" class="modal fade" tabindex="-1" aria-labelledby="modalLabelEliminar" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #009970;">
                        <h5 class="modal-title" id="modalLabelEliminar" style="color: white;">Eliminar Categoría</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="form-eliminar" action="" method="post" class="forma">
                        <input type="hidden" name="eliminar">
                        <input id="ID_CatElim" type="hidden" name="ID_Cat">
                        <div class="modal-body">
                            <p>¿Seguro que desea eliminar esta fila?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button class="btn btn-danger" type="submit">Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Fin de Ventana Eliminar -->

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