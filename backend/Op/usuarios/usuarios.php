<?php
//LOGEADO??
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../../../");
    exit;
} else {
    if ($_SESSION['nivel'] > 2) {
        header("Location: ../../../");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="./estilos.css">
    <!-- Bootstrap 5 CDN Links-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
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
                            <ion-icon name="calendar-outline"></ion-icon>
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
                            <ion-icon name="pricetags-outline"></ion-icon>
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
                            <ion-icon name="restaurant-outline"></ion-icon>
                        </span>
                        <span class="title">Servicios</span>
                    </a>
                </li>
                <li id="Usuarios">
                    <a href="../usuarios/usuarios.php">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
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
                            <ion-icon name="briefcase-outline"></ion-icon>
                        </span>
                        <span class="title">Cargos</span>
                    </a>
                </li>
                <li id="Empleados">
                    <a href="../empleados/empleados.php">
                        <span class="icon">
                            <ion-icon name="briefcase-outline"></ion-icon>
                        </span>
                        <span class="title">Empleados</span>
                    </a>
                </li>
                <li id="Huespedes">
                    <a href="../huespedes/huespedes.php">
                        <span class="icon">
                            <ion-icon name="person-outline"></ion-icon>
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
                <li id="Menores">
                    <a href="../menores/menores.php">
                        <span class="icon">
                            <ion-icon name="accessibility-outline"></ion-icon>
                        </span>
                        <span class="title">Menores</span>
                    </a>
                </li>
                <li id="Promociones">
                    <a href="../promociones/promociones.php">
                        <span class="icon">
                            <ion-icon name="pricetag-outline"></ion-icon>
                        </span>
                        <span class="title">Promociones</span>
                    </a>
                </li>
                <li>
                    <a href="../../../Inic/loggout.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Cerrar Sesión</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- ========================= principal ==================== -->
    <div class="principal">
        <div class="barratop d-flex justify-content-between align-items-center">
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
                        <h2 style="color: #009970;">Usuarios</h2>
                        <div class="conte-btns d-flex align-items-center">
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
                                <th>Cliente</th>
                                <th>Nivel</th>
                                <th>Correo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include '../conexion.php';
                            $conn = conectarDB();
                            $sql = "SELECT * FROM tbl_usuario;";
                            $resultado = mysqli_query($conn, $sql);
                            while ($fila = mysqli_fetch_assoc($resultado)) {
                                $idClt = $fila['ID_Cliente'];
                                $sqlClt = "SELECT Nombre_Razón_Social FROM tbl_cliente_persona WHERE ID_Cliente = '$idClt'";
                                $result = mysqli_fetch_assoc(mysqli_query($conn, $sqlClt));
                                echo "<tr>
                            <td>" . htmlspecialchars($result['Nombre_Razón_Social']) . "</td>
                            <td>" . htmlspecialchars($fila['Nivel']) . "</td>
                            <td>" . htmlspecialchars($fila['Correo']) . "</td>
                            <td>
                                <span class='btns btn-modificar' data-bs-toggle='modal' data-bs-target='#ventmodifi' onclick='ConfgVentModifiCat(" . json_encode($fila) . "," . json_encode($result['Nombre_Razón_Social']) . ")'>
                                    <i class='bi bi-pencil-square'></i>
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
                        <h5 class="modal-title" id="modalLabel" style="color: white;">Agregar Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="form-agregar" action="" method="post" class="forma">
                        <input type="hidden" name="agregar">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="cliente-select" class="form-label">Cliente:</label>
                                <select id="cliente-select" class="form-select" name="Clientes" required>
                                    <option value="">Seleccionar una opción</option>
                                    <?php
                                    $conn = conectarDB();
                                    $sql = "SELECT * FROM tbl_cliente_persona;";
                                    $resultado = mysqli_query($conn, $sql);

                                    while ($fila = mysqli_fetch_assoc($resultado)) {
                                        $id = $fila['ID_Cliente'];
                                        $sqlUser = "SELECT * FROM tbl_usuario WHERE ID_Cliente = '$id';";
                                        $result = mysqli_query($conn, $sqlUser);
                                        if (mysqli_num_rows($result) < 1) {
                                            echo '<option value="' . $fila['ID_Cliente'] . '">' . htmlspecialchars($fila['Nombre_Razón_Social']) . '</option>';
                                        }
                                    }
                                    mysqli_close($conn);
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="nivel-select" class="form-label">Nivel:</label>
                                <select id="nivel-select" class="form-select" name="Nivel" required>
                                    <option value="">Seleccionar una opción</option>
                                    <option value="1">Administrador</option>
                                    <option value="2">Operador</option>
                                    <option value="3">Usuario</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo:</label>
                                <input id="correo" name="Correo" type="email" class="form-control" placeholder="Correo" required>
                            </div>

                            <div class="mb-3">
                                <label for="contraseña" class="form-label">Contraseña:</label>
                                <input id="contraseña" name="Contraseña" type="password" class="form-control" placeholder="Contraseña" required>
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
                        <h5 class="modal-title" id="modalLabel" style="color: white;">Modificar Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="forma" id="form-modificar" action="" method="post" name="modificar">
                        <input type="hidden" name="modificar">
                        <input id="ID_usuario" type="hidden" name="ID_usuario">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="text_nivel" class="form-label">Nivel:</label>
                                <select id="text_nivel" class="form-select" name="nivel" required>
                                    <option value="">Seleccionar una opción</option>
                                    <option value="1">Administrador</option>
                                    <option value="2">Operador</option>
                                    <option value="3">Usuario</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="text_correo" class="form-label">Correo:</label>
                                <input id="text_correo" name="correo" type="email" class="form-control" placeholder="Correo" required>
                            </div>

                            <input id="text_contraseña" type="hidden" name="contraseñas">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button class="btn btn-primary" name="modificar" type="submit" style="background-color: #009970; border-color: #009970;">Modificar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Fin de Ventana Modificar -->


        <!-- Ventana Eliminar -->
        <div id="venteliminar" class="modal fade" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #009970;">
                        <h5 class="modal-title" id="modalLabel" style="color: white;">Eliminar Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="forma" id="form-eliminar" action="" method="post" name="eliminar">
                        <input type="hidden" name="eliminar">
                        <input id="ID_UserElim" type="hidden" name="ID_User">
                        <div class="modal-body">
                            <p>¿Está seguro que desea eliminar este usuario?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button class="btn btn-danger" name="eliminar" type="submit" style="background-color: #dc3545; border-color: #dc3545;">Eliminar</button>
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