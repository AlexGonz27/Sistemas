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
    <title>Pagos</title>
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
                    <a href="../huespedes/huespedes.php">
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

        <div class="dt-serv">
            <div class="serviciosTable">
                <div class="cartaHeader">
                    <h2>Pagos</h2>
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
                            <td>Reserva</td>
                            <td>Cliente</td>
                            <td>Monto</td>
                            <td>Acciones</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../conexion.php';
                        $conn = conectarDB();
                        $sql = "SELECT * FROM tbl_pagos;";
                        $resultado = mysqli_query($conn, $sql);
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            $idClt = $fila['ID_Cliente'];
                            $sqlClt = "SELECT Nombre_Razón_Social FROM tbl_cliente_persona WHERE ID_Cliente = '$idClt'";
                            $result = mysqli_fetch_assoc(mysqli_query($conn, $sqlClt));
                            $idres = $fila['ID_Reserva'];
                            $sqlRes = "SELECT Codigo_Reserva FROM tbl_reservacion WHERE ID_Reservación = '$idres'";
                            $result2 = mysqli_fetch_assoc(mysqli_query($conn, $sqlRes));
                            echo "<tr> 
                                <td>" . $result2['Codigo_Reserva'] . "</td>
                                <td>" . $result['Nombre_Razón_Social'] . "</td>  
                                <td>" . $fila['Monto'] . "</td>
                                <td>
                                    <span class='btns btn-modificar' onclick='ConfgVentModifiCat(" . json_encode($fila) . "," . json_encode($result['Nombre_Razón_Social']) . "," . json_encode($result2['Codigo_Reserva']) . ")'>Modificar</span>
                                    
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
                <select class="mi-select" name="Clientes">
                    <option value="">Seleccionar una opción</option>
                    <?php
                    $conn = conectarDB();
                    $sql = "SELECT * FROM tbl_cliente_persona;";
                    $resultado = mysqli_query($conn, $sql);

                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo '<option value="' . $fila['ID_Cliente'] . '">' . $fila['Nombre_Razón_Social'] . '</option>';
                    }
                    mysqli_close($conn);
                    ?>
                </select>
                <select class="mi-select" name="Reservas">
                    <option value="">Seleccionar una opción</option>
                    <?php
                    $conn = conectarDB();
                    $sql = "SELECT * FROM tbl_reservacion;";
                    $resultado = mysqli_query($conn, $sql);
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo '<option value="' . $fila['ID_Reservación'] . '">' . $fila['Codigo_Reserva'] . '</option>';
                    }

                    mysqli_close($conn);
                    ?>
                </select>


                <input id="text-monto" name="Monto" type="text" placeholder="Monto">

                <button class="btns btn-agregar" type="submit">Agregar</button>
            </form>
        </div>
    </div>

    <div id="ventmodifi" class="ventana">
        <div class="conte-vent">
            <ion-icon name="close-circle-outline" class="btns btn-cerrar" onclick="document.getElementById('ventmodifi').style.display = 'none';"></ion-icon>
            <form class="forma" id="form-modificar" action="" method="post" name="modificar">
                <input type="hidden" name="modificar">
                <input id="ID_Pago" type="hidden" name="ID_Pago">

                <h2 id="Cliente"></h2>
                <h2 id="Reserva"></h2>

                <input id="text-monto" name="Monto" type="text" placeholder="Monto">
                <button class="btns btn-modificar" type="submit" class="forma btn-modificar">modificar</button>
            </form>
        </div>
    </div>

    <div id="venteliminar" class="ventana">
        <div class="conte-vent">
            <ion-icon name="close-circle-outline" class="btns btn-cerrar" onclick="document.getElementById('venteliminar').style.display = 'none';"></ion-icon>
            <form class="forma" id="form-agregar" action="" method="post" name="agregar">
                <input type="hidden" name="eliminar">
                <input id="ID_PagoElim" type="hidden" name="ID_Pago">
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