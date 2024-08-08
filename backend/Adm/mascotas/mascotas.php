<?php
//LOGEADO??
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../../../");
    exit;
} else {
    if ($_SESSION['nivel'] > 1) {
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
    <title>Mascotas</title>
    <link rel="stylesheet" href="./estilos.css">
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
                <li id="Huespedes">
                    <a href="./huespedes.php">
                        <span class="icon">
                            <ion-icon name="people-circle-outline"></ion-icon>
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
                    <h2>Mascotas</h2>
                </div>
                <div class="conte-btns">
                    <div>
                        <div class="btn-agregar" onclick="document.getElementById('ventagregar').style.display = 'block'">Agregar</div>
                    </div>
                    <div>
                        <button id="consulta-btn" onclick="tareaCompletada()" style="display: none;">Hacer Consulta</button>
                        <input id="buscador_tabla" type="text" placeholder="Buscar">
                    </div>
                </div>

                <table id="Tabla_Datos">
                    <thead>
                        <tr>
                            <td>Tipo</td>
                            <td>Nombre</td>
                            <td>Detalles</td>
                            <td>Acciones</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../conexion.php';
                        $conn = conectarDB();
                        $sql = "SELECT * FROM tbl_mascotas;";
                        $resultado = mysqli_query($conn, $sql);
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            echo "<tr>
                                <td>" . $fila['Tipo'] . "</td>
                                <td>" . $fila['Nombre'] . "</td>
                                <td>" . $fila['Detalles'] . "</td>
                                <td>
                                    <span class='btns btn-modificar' onclick='ConfgVentModifiCat(" . json_encode($fila) . ")'>Modificar</span>
                                    <span class='btns btn-eliminar' onclick='ConfgVentElimCat(" . $fila['ID_Mascotas'] . ");'>Eliminar</span>
                                </td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="ventagregar" class="ventana">
        <div class="conte-vent">
            <ion-icon name="close-circle-outline" class="btns btn-cerrar" onclick="document.getElementById('ventagregar').style.display = 'none';"></ion-icon>
            <form class="forma" id="form-agregar" action="" method="post">
                <input type="hidden" name="agregar">
                <input id="text-tipo" name="tipo" type="text" placeholder="Tipo">
                <input id="text-nombre" name="nombre" type="text" placeholder="Nombre">
                <input id="text-det" name="det" type="text" placeholder="Detalles">
                <button class="btns btn-agregar" type="submit">Agregar</button>
            </form>
        </div>
    </div>

    <div id="ventmodifi" class="ventana">
        <div class="conte-vent">
            <ion-icon name="close-circle-outline" class="btns btn-cerrar" onclick="document.getElementById('ventmodifi').style.display = 'none';"></ion-icon>
            <form class="forma" id="form-modificar" action="" method="post" name="modificar">
                <input type="hidden" name="modificar">
                <input id="ID_Mas" type="hidden" name="ID_Mas">
                <input id="text-tipo" name="tipo" type="text" placeholder="Tipo">
                <input id="text-nombre" name="nombre" type="text" placeholder="Nombre">
                <input id="text-det" name="det" type="text" placeholder="Detalles">
                <button class="btns btn-modificar" type="submit" class="forma btn-modificar">modificar</button>
            </form>
        </div>
    </div>

    <div id="venteliminar" class="ventana">
        <div class="conte-vent">
            <ion-icon name="close-circle-outline" class="btns btn-cerrar" onclick="document.getElementById('venteliminar').style.display = 'none';"></ion-icon>
            <form class="forma" id="form-agregar" action="" method="post" name="agregar">
                <input type="hidden" name="eliminar">
                <input id="ID_MasElim" type="hidden" name="ID_Mas">
                <p>Seguro que desea eliminar esta fila?</p>
                <button type="submit">eliminar</button>
            </form>
        </div>
    </div>
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