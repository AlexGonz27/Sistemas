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
    <title>Reservas</title>
    <link rel="stylesheet" href="./estilos.css">

</head>

<body>
    <?php
    include '../conexion.php';
    $conn = conectarDB();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['agregar'])) {
            $ID = $_POST['Cliente'];
            $Fch_reserva = $_POST['Fch_Reserva'];
            $Fch_entrada = $_POST['Fch_Entrada'];
            $Fch_salida = $_POST['Fch_Salida'];
            $Estado = $_POST['Estado'];

            $sql = "INSERT INTO tbl_reservacion (ID_Cliente,Fecha_Reservación,Fecha_Entrada,Fecha_Salida,Estado) VALUES ('$ID','$Fch_reserva','$Fch_entrada','$Fch_salida','$Estado')";

            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Fila insertada correctamente.');</script>";
            } else {
                echo "Error al insertar fila: " . mysqli_error($conn);
            }
        }
        if (isset($_POST['modificar'])) {
            $ID = $_POST['ID_Reserva'];
            $ID_Clt = $_POST['Cliente'];
            $Fch_reserva = $_POST['Fch_Reserva'];
            $Fch_entrada = $_POST['Fch_Entrada'];
            $Fch_salida = $_POST['Fch_Salida'];
            $Estado = $_POST['Estado'];

            $sql = "UPDATE tbl_reservacion SET ID_Cliente='$ID_Clt',Fecha_Reservación='$Fch_reserva',Fecha_Entrada='$Fch_entrada',Fecha_Salida='$Fch_salida',Estado='$Estado' WHERE ID_Reservación = '$ID'";

            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Fila modificada correctamente.');</script>";
            } else {
                echo "Error al modificar fila: " . mysqli_error($conn);
            }
        }
        if (isset($_POST['eliminar'])) {
            $ID = $_POST['ID_Reserva'];

            $sql = "DELETE FROM tbl_reservacion WHERE ID_Reservación = '$ID'";

            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Fila eliminada correctamente.');</script>";
            } else {
                echo "Error al modificar fila: " . mysqli_error($conn);
            }
        }
        if (isset($_POST['buscar'])) {
            $ID = mysqli_real_escape_string($conn, $_POST['id_cliente']);
            $NA = mysqli_real_escape_string($conn, $_POST['Nacionalidad']);

            $sql = "SELECT * FROM tbl_cliente_persona WHERE Nacionalidad = '$NA' AND Identificación = '$ID'";

            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $fila = mysqli_fetch_assoc($result);
                echo    "<script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    mostrarinfo(" . json_encode($fila) . ");
                                });
                            </script>";
            } else {
                echo    "<script>
                                var resultado = confirm('¿Deseas agregar el cliente?');
                                if (resultado) {
                                    window.location.href = '../clientes/clientes.php';
                                }
                            </script>";
            }
        }
    }
    mysqli_close($conn);
    ?>
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
        <!-- ////////////////// Busqueda Cliente //////////////////-->

        <div class="cont_cliente">
            <div class="cont_clt">
                <div>
                    <h2>Cliente</h2>
                </div>
                <form action="" class="data_clientes" method="post" id="forma" name="buscar" class="forma">
                    <div id="clientes">
                        <div class="case">
                            <div>
                                <select name="Nacionalidad" id="Nacionalidad">
                                    <option value="V">V</option>
                                    <option value="E">E</option>
                                    <option value="G">G</option>
                                </select>
                                <input type="text" placeholder="Identificación" name="id_cliente" id="ID_clt">
                            </div>
                        </div>
                    </div>
                    <div id="btns-buscar">
                        <button id="buscar-btn" class="btn-buscar" type="submit" name="buscar">Buscar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- ////////////////// DataTable //////////////////-->
        <div class="dt-serv">
            <div class="serviciosTable">
                <div class="cartaHeader">
                    <h2>Reservas</h2>
                    <div>
                        <input id="buscador_tabla" type="text" placeholder="Buscar">
                    </div>
                </div>
                <div class="conte-btns">

                    <div>
                        <div class="btn-agregar" onclick="document.getElementById('ventagregar').style.display = 'block'">Agregar</div>
                    </div>

                </div>

                <table id="Tabla_Datos">
                    <thead>
                        <tr>
                            <td>Cliente</td>
                            <td>Identificación</td>
                            <td>Habitacion</td>
                            <td>Fecha de Reserva</td>
                            <td>Codigo</td>
                            <td>Estado</td>
                            <td>Acciones</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $conn = conectarDB();
                        $sql = "SELECT r.*, h.N_Habitación 
                            FROM tbl_reservacion r
                            JOIN tbl_habitaciones_categoria h ON r.ID_Habitacion = h.ID_Habitaciones";
                        $resultado = mysqli_query($conn, $sql);
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            $id = $fila['ID_Cliente'];
                            $sqlCat = "SELECT * FROM tbl_cliente_persona WHERE ID_Cliente = '$id'";
                            $result = mysqli_fetch_assoc(mysqli_query($conn, $sqlCat));
                            echo "<tr>  
                                <td>" . $result['Nombre_Razón_Social'] . "</td>
                                <td>" . $result['Nacionalidad'] . "-" . $result['Identificación'] . "</td>
                                <td>Nº-" . $fila['N_Habitación'] . "</td>
                                <td>" . $fila['Fecha_Reservación'] . "</td>
                                <td>" . $fila['Codigo_Reserva'] . "</td>
                                <td>" . $fila['Estado'] . "</td>
                                <td>
                                    <span class='btns btn-modificar' onclick='ConfgVentModifi(" . json_encode($fila) . ")' >Modificar</span>
                                    <span class='btns btn-eliminar' onclick='ConfgVentElim(" . $fila['ID_Reservación'] . ");'>Eliminar</span>
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

    <!-- ////////////////// Ventana MODA de Agregar ////////////////// -->
    <div id="ventagregar" class="ventana">
        <div class="conte-vent">
            <ion-icon name="close-circle-outline" class="btns btn-cerrar" onclick="document.getElementById('ventagregar').style.display = 'none';"></ion-icon>

            <!-- Forma para agregar  -->
            <form id="form-agregar" name="agregar">

                <input type="hidden" name="agregar">
                <input type="hidden" name="Codigo" id="Codigo_add">

                <h2 id="Nombre" name="Nombre_Razon"></h2>
                <h2 id="Nacionalidad" name="Nacionalidad"></h2>
                <h2 id="Identidad" name="Identidad"></h2>

                <select class="mi-select" id="Hab" name="Habitacion">
                    <option value="">Seleccionar una habitación</option>

                </select>

                <input id="Fch_Reserva" name="Fch_Reserva" type="date" placeholder="Fecha de Reservación">

                <input id="F_E" name="Fch_Entrada" type="date" placeholder="Fecha de Entrada">

                <input id="F_S" name="Fch_Salida" type="date" placeholder="Fecha de Salida">

                <input name="N_Adultos" type="number" placeholder="Número de Adultos">

                <input name="N_Niños" type="number" placeholder="Número de Niños">

                <input name="N_Mascotas" type="number" placeholder="Número de Mascotas">

                <button class="btns btn-agregar" name="agregar">Agregar</button>

            </form>
        </div>
    </div>

    <!-- ////////////////// Ventana MODA DE Modificar ////////////////// -->
    <div id="ventmodifi" class="ventana">
        <div class="conte-vent">
            <ion-icon name="close-circle-outline" class="btns btn-cerrar" onclick="document.getElementById('ventmodifi').style.display = 'none';"></ion-icon>

            <!-- Forma para modificar -->
            <form id="form-modificar" action="" method="post" name="modificar">

                <input id="ID_Reserva" type="hidden" name="ID_Reserva">
                <select id="ID_Cliente" class="mi-select" name="Cliente">
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

                <input id="Fch_Reserva" name="Fch_Reserva" type="date" placeholder="Fecha de Reservación">

                <input id="Fch_Entrada" name="Fch_Entrada" type="date" placeholder="Fecha de Entrada">

                <input id="Fch_Salida" name="Fch_Salida" type="date" placeholder="Fecha de Salida">

                <select class="mi-select" name="Estado">
                    <option value="">Seleccionar una opción</option>
                    <option value="Activo">Finalizada</option>
                    <option value="Mantemiento">Pendiente</option>
                    <option value="Inactivo">Anulada</option>
                </select>

                <button class="btns btn-modificar" type="submit" name="modificar" class="forma btn-modificar">Modificar</button>

            </form>
        </div>
    </div>

    <!-- ////////////////// Ventana MODA DE Eliminar ////////////////// -->
    <div id="venteliminar" class="ventana">
        <div class="conte-vent">
            <ion-icon name="close-circle-outline" class="btns btn-cerrar" onclick="document.getElementById('venteliminar').style.display = 'none';"></ion-icon>
            <form id="form-agregar" action="" method="post" name="agregar">
                <input id="ID_ResElim" type="hidden" name="ID_Reserva">
                <p>Seguro que desea eliminar esta fila?</p>
                <button type="submit" name="eliminar">eliminar</button>
            </form>
        </div>
    </div>
    <!-- =========== Scripts =========  -->
    <script src="./main.js"></script>
    <script src="/Sistemas/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>