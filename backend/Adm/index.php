<?php
include 'conexion.php';
//LOGEADO??
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../../../");
    exit;
} else {
    if ($_SESSION['nivel'] > 1) {
        header("Location: ../../");
        exit;
    }
}
$conn = conectarDB();
$sql = "SHOW TABLES";
$resultado = mysqli_query($conn, $sql);
$tabla_conts = array();

if ($resultado->num_rows > 0) {
    while ($fila = mysqli_fetch_array($resultado)) {
        $tabla = $fila[0];
        $cont_sql = "SELECT COUNT(*) AS total FROM $tabla";
        $cont_result = mysqli_query($conn, $cont_sql);
        $cont = mysqli_fetch_array($cont_result);
        $tabla_conts[$tabla] = $cont['total'];
    }
}
mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="./estilos.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src='https://fullcalendar.io/releases/fullcalendar/3.10.2/locale/es.js'></script>
    <!-- Bootstrap 5 CDN Links-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src='../dist/index.global.js'></script>
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
                    <a href="/index.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Inicio</span>
                    </a>
                </li>
                <li id="Reservas">
                    <a href="./reservas/reservas.php">
                        <span class="icon">
                            <ion-icon name="calendar-outline"></ion-icon>
                        </span>
                        <span class="title">Reservas</span>
                    </a>
                </li>
                <li id="Pagos">
                    <a href="./pagos/pagos.php">
                        <span class="icon">
                            <ion-icon name="cash-outline"></ion-icon>
                        </span>
                        <span class="title">Pagos</span>
                    </a>
                </li>
                <li id="Categorias">
                    <a href="./categorias/categorias.php">
                        <span class="icon">
                            <ion-icon name="pricetags-outline"></ion-icon>
                        </span>
                        <span class="title">Categorías</span>
                    </a>
                </li>
                <li id="Habitaciones">
                    <a href="./habitaciones/habitaciones.php">
                        <span class="icon">
                            <ion-icon name="bed-outline"></ion-icon>
                        </span>
                        <span class="title">Habitaciones</span>
                    </a>
                </li>
                <li id="Servicios">
                    <a href="./servicios/servicios.php">
                        <span class="icon">
                            <ion-icon name="restaurant-outline"></ion-icon>
                        </span>
                        <span class="title">Servicios</span>
                    </a>
                </li>
                <li id="Usuarios">
                    <a href="./usuarios/usuarios.php">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Usuarios</span>
                    </a>
                </li>
                <li id="Clientes">
                    <a href="./clientes/clientes.php">
                        <span class="icon">
                            <ion-icon name="person-circle-outline"></ion-icon>
                        </span>
                        <span class="title">Clientes</span>
                    </a>
                </li>
                <li id="Cargos">
                    <a href="./cargos/cargos.php">
                        <span class="icon">
                            <ion-icon name="briefcase-outline"></ion-icon>
                        </span>
                        <span class="title">Cargos</span>
                    </a>
                </li>
                <li id="Empleados">
                    <a href="./empleados/empleados.php">
                        <span class="icon">
                            <ion-icon name="briefcase-outline"></ion-icon>
                        </span>
                        <span class="title">Empleados</span>
                    </a>
                </li>
                <li id="Huespedes">
                    <a href="./huespedes/huespedes.php">
                        <span class="icon">
                            <ion-icon name="person-outline"></ion-icon>
                        </span>
                        <span class="title">Huéspedes</span>
                    </a>
                </li>
                <li id="Mascotas">
                    <a href="./mascotas/mascotas.php">
                        <span class="icon">
                            <ion-icon name="paw-outline"></ion-icon>
                        </span>
                        <span class="title">Mascotas</span>
                    </a>
                </li>
                <li id="Menores">
                    <a href="./menores/menores.php">
                        <span class="icon">
                            <ion-icon name="accessibility-outline"></ion-icon>
                        </span>
                        <span class="title">Menores</span>
                    </a>
                </li>
                <li id="Promociones">
                    <a href="./promociones/promociones.php">
                        <span class="icon">
                            <ion-icon name="pricetag-outline"></ion-icon>
                        </span>
                        <span class="title">Promociones</span>
                    </a>
                </li>
                <li>
                    <a href="./../../Inic/loggout.php">
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

            <div class="user">
                <img src="assets/imgs/customer01.jpg" alt="">
            </div>
        </div>

        <!-- ======================= cartas ================== -->
        <div class="cartaCaja">
            <div class="carta">
                <div>
                    <div class="numeros">
                        <?php
                        echo $tabla_conts['tbl_reservacion'];
                        ?>
                    </div>
                    <div class="cartaNombre">Reservas</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="calendar-outline"></ion-icon>
                </div>
            </div>

            <div class="carta">
                <div>
                    <div class="numeros">
                        <?php
                        echo $tabla_conts['tbl_categorias'];
                        ?>
                    </div>
                    <div class="cartaNombre">Categorías</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="pricetags-outline"></ion-icon>
                </div>
            </div>

            <div class="carta">
                <div>
                    <div class="numeros">
                        <?php
                        echo $tabla_conts['tbl_habitaciones_categoria'];
                        ?>
                    </div>
                    <div class="cartaNombre">Habitaciones</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="bed-outline"></ion-icon>
                </div>
            </div>

            <div class="carta">
                <div>
                    <div class="numeros">
                        <?php
                        echo $tabla_conts['tbl_servicios'];
                        ?>
                    </div>
                    <div class="cartaNombre">Servicios</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="restaurant-outline"></ion-icon>
                </div>
            </div>

            <div class="carta">
                <div>
                    <div class="numeros">
                        <?php
                        echo $tabla_conts['tbl_usuario'];
                        ?>
                    </div>
                    <div class="cartaNombre">Usuarios</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="people-outline"></ion-icon>
                </div>
            </div>

            <div class="carta">
                <div>
                    <div class="numeros">
                        <?php
                        echo $tabla_conts['tbl_mascotas'];
                        ?>
                    </div>
                    <div class="cartaNombre">Mascotas</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="paw-outline"></ion-icon>
                </div>
            </div>

            <div class="carta">
                <div>
                    <div class="numeros">
                        <?php
                        echo $tabla_conts['tbl_menores'];
                        ?>
                    </div>
                    <div class="cartaNombre">Menores</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="accessibility-outline"></ion-icon>
                </div>
            </div>

            <div class="carta">
                <div>
                    <div class="numeros">
                        <?php
                        echo $tabla_conts['tbl_cliente_persona'];
                        ?>
                    </div>
                    <div class="cartaNombre">Clientes</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="person-outline"></ion-icon>
                </div>
            </div>

            <div class="carta">
                <div>
                    <div class="numeros">0</div>
                    <div class="cartaNombre">Huéspedes</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="people-circle-outline"></ion-icon>
                </div>
            </div>

            <div class="carta">
                <div>
                    <div class="numeros">
                        <?php
                        echo $tabla_conts['tbl_promociones'];
                        ?>
                    </div>
                    <div class="cartaNombre">Promociones</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="pricetag-outline"></ion-icon>
                </div>
            </div>
        </div>




        <!-- ================ Busqueda Cliente ================= -->

        <!-- ////////////////// Busqueda Cliente //////////////////-->

        <div class="cont_cliente">
            <div class="cont_clt">
                <div class="recentOrders">
                    <div id='calendar'>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Bootstrap 5 JS CDN Links -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <!-- =========== Scripts =========  -->
    <script src="main.js"></script>

    <!-- =========== Scripts =========  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>