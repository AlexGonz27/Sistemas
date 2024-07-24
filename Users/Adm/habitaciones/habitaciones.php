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
    <title>Habitaciones</title>
    <link rel="stylesheet" href="./estilos.css">
</head>

<body>
    <?php
        include '../conexion.php';
        $conn = conectarDB(); 
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if (isset($_POST['agregar'])) {
                $categoria = $_POST['Categoria'];
                $N_Habitacion = $_POST['NumHabitaciones'];
                $estado = $_POST['Estado'];

                $sql = "INSERT INTO tbl_habitaciones_categoria (ID_Categoria,N_Habitación,Estado) VALUES ('$categoria','$N_Habitacion','$estado')";
                
                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Fila insertada correctamente.');</script>";
                } else {
                    echo "Error al insertar fila: " . mysqli_error($conn);
                }
            }
            if (isset($_POST['modificar'])){
                $ID = $_POST['ID_habit_modifi'];
                $Categoria = $_POST['Categoria'];
                $N_Habit = $_POST['NumHabitaciones'];
                $Estado = $_POST['Estado'];

                $sql = "UPDATE tbl_habitaciones_categoria SET ID_Categoria='$Categoria',N_Habitación='$N_Habit',Estado='$Estado' WHERE ID_Habitaciones = '$ID'";
                
                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Fila modificada correctamente.');</script>";
                } else {
                    echo "Error al modificar fila: " . mysqli_error($conn);
                }
            }
            if (isset($_POST['eliminar'])){
                $ID = $_POST['ID_Cat'];

                $sql = "DELETE FROM tbl_categorias WHERE ID_Categoria = '$ID'";
                
                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Fila eliminada correctamente.');</script>";
                } else {
                    echo "Error al modificar fila: " . mysqli_error($conn);
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
                <li id="Huespedes">
                    <a href="./huespedes.php">
                        <span class="icon">
                            <ion-icon name="body-outline"></ion-icon>
                        </span>
                        <span class="title">Huespedes</span>
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
                    <a href="..../Inic/loggout.php">
                        <span class="icon">
                            <ion-icon name="cash-outline"></ion-icon>
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

    <!-- ////////////////// DataTable //////////////////-->
    <div class="dt-serv">
        <div class="serviciosTable">
            <div class="cartaHeader">
                <h2>Habitaciones</h2>
            </div>
            <div class="conte-btns">
                <div>
                    <div class="btn-agregar" onclick="document.getElementById('ventagregar').style.display = 'block'">Agregar</div>
                </div>
                <div>
                    <input id="buscador_tabla" type="text" placeholder="Buscar">
                </div>
            </div>

            <table id="Tabla_Datos">
                <thead>
                    <tr>
                        <td>Categoria</td>
                        <td>Estado</td>
                        <td>N Habitaciones</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $conn = conectarDB();
                    $sql = "SELECT * FROM tbl_habitaciones_categoria;";
                    $resultado = mysqli_query($conn, $sql);
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        $idCat = $fila['ID_Categoria'];
                        $sqlCat = "SELECT Nombre FROM tbl_categorias WHERE ID_Categoria = '$idCat'";
                        $result = mysqli_fetch_assoc(mysqli_query($conn, $sqlCat));
                        echo "<tr>  
                                <td>" . $result['Nombre'] . "</td>
                                <td>" . $fila['Estado'] . "</td>
                                <td>" . $fila['N_Habitación'] . "</td>
                                <td>
                                    <span class='btns btn-modificar' onclick='ConfgVentModifiHabit(".json_encode($fila).")'>Modificar</span>
                                    <span class='btns btn-eliminar' onclick='ConfgVentElim(".$fila['ID_Habitaciones'].");'>Eliminar</span>
                                </td>
                            </tr>";
                    }
                    mysqli_close($conn);
                ?>
                </tbody>
            </table>
        </div>
    </div></div>    
    
    <!-- ////////////////// Ventana MODA de Agregar ////////////////// -->
    <div id="ventagregar" class="ventana">
        <div class="conte-vent">
            <ion-icon name="close-circle-outline" class="btns btn-cerrar" onclick="document.getElementById('ventagregar').style.display = 'none';"></ion-icon>
            
            <!-- Forma para agregar  -->
            <form id="form-modificar"action="" method="post" name="agregar">
                <select class="mi-select" name="Categoria">
                    <option value="">Seleccionar una opción</option>
                    <?php
                        $conn = conectarDB();
                        $sql = "SELECT * FROM tbl_categorias;";
                        $resultado = mysqli_query($conn, $sql);
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            echo '<option value="' . $fila['ID_Categoria'] . '">' . $fila['Nombre'] . '</option>';
                        }
                        mysqli_close($conn);
                    ?>
                </select>

                <input name="NumHabitaciones" type="text" placeholder="No Habitaciones">

                <select class="mi-select" name="Estado">
                    <option value="">Seleccionar una opción</option>
                    <option value="Activo">Activo</option>
                    <option value="Mantemiento">Mantemiento</option>
                    <option value="Inactivo">Inactivo</option>
                </select>

                <button class="btns btn-agregar" type="submit" name="agregar" >Agregar</button>
            
            </form>
        </div>
    </div>

    <!-- ////////////////// Ventana MODA DE Modificar ////////////////// -->
    <div id="ventmodifi" class="ventana">
        <div class="conte-vent">
            <ion-icon name="close-circle-outline" class="btns btn-cerrar" onclick="document.getElementById('ventmodifi').style.display = 'none';"></ion-icon>
            
            <!-- Forma para modificar -->
            <form id="form-modificar"action="" method="post" name="modificar">

                <input id="ID_habit_modifi" type="hidden" name="ID_habit_modifi">

                <select id="Cat_modifi" class="mi-select" name="Categoria">
                    <option value="">Seleccionar una opción</option>
                    <?php
                        $conn = conectarDB();
                        $sql = "SELECT * FROM tbl_categorias;";
                        $resultado = mysqli_query($conn, $sql);
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            echo '<option value="' . $fila['ID_Categoria'] . '">' . $fila['Nombre'] . '</option>';
                        }
                        mysqli_close($conn);
                    ?>
                </select>

                <input id="text-cant_modifi" name="NumHabitaciones" type="text" placeholder="No Habitaciones">

                <select id="Est_modifi" class="mi-select" name="Estado">
                    <option value="">Seleccionar una opción</option>
                    <option value="Activo">Activo</option>
                    <option value="Mantemiento">Mantemiento</option>
                    <option value="Inactivo">Inactivo</option>
                </select>

                <button class="btns btn-modificar"  type="submit" name="modificar" class="forma btn-modificar">Modificar</button>
            
            </form>
        </div>
    </div>

    <!-- ////////////////// Ventana MODA DE Eliminar ////////////////// -->
    <div id="venteliminar" class="ventana">
        <div class="conte-vent">
            <ion-icon name="close-circle-outline" class="btns btn-cerrar" onclick="document.getElementById('venteliminar').style.display = 'none';"></ion-icon>
            <form id="form-agregar" action="" method="post" name="agregar">
                <input id="ID_ServElim" type="hidden" name="ID_Serv">
                <p>Seguro que desea eliminar esta fila?</p>
                <button type="submit" name="eliminar">eliminar</button>
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