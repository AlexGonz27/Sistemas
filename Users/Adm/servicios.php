<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios</title>
    <link rel="stylesheet" href="./estilos.css">
</head>

<body>
    <?php
        include 'conexion.php';
        $conn = conectarDB(); 
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if (isset($_POST['agregar'])) {
                $tipo = $_POST['tipo'];
                $descripcion = $_POST['desc'];
                $costo = $_POST['cost'];

                $sql = "INSERT INTO tbl_servicios (Tipo,Descripción,Costo) VALUES ('$tipo','$descripcion','$costo')";
                
                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Fila insertada correctamente.');</script>";
                } else {
                    echo "Error al insertar fila: " . mysqli_error($conn);
                }
            }
            if (isset($_POST['modificar'])){
                $ID = $_POST['ID_Serv'];
                $tipo = $_POST['tipo'];
                $descripcion = $_POST['desc'];
                $costo = $_POST['cost'];

                $sql = "UPDATE tbl_servicios SET Tipo='$tipo',Descripción='$descripcion',Costo='$costo' WHERE ID_Servicios = '$ID'";
                
                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Fila modificada correctamente.');</script>";
                } else {
                    echo "Error al modificar fila: " . mysqli_error($conn);
                }
            }
            if (isset($_POST['eliminar'])){
                $ID = $_POST['ID_Serv'];

                $sql = "DELETE FROM tbl_servicios WHERE ID_Servicios = '$ID'";
                
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
                    <a href="./index.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Inicio</span>
                    </a>
                </li>
                <li id="Reservas">
                    <a href="./reservas.php">
                        <span class="icon">
                            <ion-icon name="id-card-outline"></ion-icon>
                        </span>
                        <span class="title">Reservas</span>
                    </a>
                </li>
                <li id="categorias">
                    <a href="./categorias.php">
                        <span class="icon">
                            <ion-icon name="bookmarks-outline"></ion-icon>
                        </span>
                        <span class="title">Categorias</span>
                    </a>
                </li>
                <li id="Habitaciones">
                    <a href="./habitaciones.php">
                        <span class="icon">
                            <ion-icon name="bookmarks-outline"></ion-icon>
                        </span>
                        <span class="title">Habitaciones</span>
                    </a>
                </li>
                <li id="Servicios">
                    <a href="./servicios.php">
                        <span class="icon">
                            <ion-icon name="hand-right-outline"></ion-icon>
                        </span>
                        <span class="title">Servicios</span>
                    </a>
                </li>
                <li id="Usuarios">
                    <a href="./usuarios.php">
                        <span class="icon">
                            <ion-icon name="person-circle-outline"></ion-icon>
                        </span>
                        <span class="title">Usuarios</span>
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
                    <a href="./promociones.php">
                        <span class="icon">
                            <ion-icon name="cash-outline"></ion-icon>
                        </span>
                        <span class="title">Promociones</span>
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
                <h2>Servicios</h2>
                <a href="#" class="btn">Ver Todas</a>
            </div>
            <div class="conte-btns">
                <div>
                    <div class="btn-agregar" onclick="document.getElementById('ventagregar').style.display = 'block'">Agregar</div>
                </div>
                <div>
                    <input type="text">
                </div>
            </div>

            <table id="Tabla_Servicios">
                <thead>
                    <tr>
                        <td>Tipo</td>
                        <td>Descripción</td>
                        <td>Precio</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $conn = conectarDB();
                    $sql = "SELECT * FROM tbl_servicios;";
                    $resultado = mysqli_query($conn, $sql);
                    $num = 1;
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo "<tr>
                                <td>" . $fila['Tipo'] . "</td>
                                <td>" . $fila['Descripción'] . "</td>
                                <td>" . $fila['Costo'] . "$</td>
                                <td>
                                    <span class='btns btn-modificar' onclick='ConfgVentModifi(".$num.",".$fila['ID_Servicios'].")'>Modificar</span>
                                    <span class='btns btn-eliminar' onclick='ConfgVentElim(".$fila['ID_Servicios'].");'>Eliminar</span>
                                </td>
                            </tr>";
                        $num = $num + 1;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div></div>    
    
    <div id="ventagregar" class="ventana">
        <div class="conte-vent">
            <ion-icon name="close-circle-outline" class="btns btn-cerrar" onclick="document.getElementById('ventagregar').style.display = 'none';"></ion-icon>
            <form id="form-agregar" action="" method="post">
                <input id="text-tipo" name="tipo" type="text" placeholder="Tipo">
                <input id="text-desc" name="desc" type="text" placeholder="Descripcion">
                <input id="text-cost" name="cost" type="text" placeholder="Costo">
                <button type="submit" name="agregar">agregar</button>
            </form>
        </div>
    </div>

    <div id="ventmodifi" class="ventana">
        <div class="conte-vent">
            <ion-icon name="close-circle-outline" class="btns btn-cerrar" onclick="document.getElementById('ventmodifi').style.display = 'none';"></ion-icon>
            <form id="form-modificar"action="" method="post" name="modificar">
                <input id="ID_Serv" type="hidden" name="ID_Serv">
                <input id="text-tipo" name="tipo" type="text" placeholder="Tipo">
                <input id="text-desc" name="desc" type="text" placeholder="Descripcion">
                <input id="text-cost" name="cost" type="text" placeholder="Costo">
                <button class="btns btn-modificar"  type="submit" name="modificar" class="forma btn-modificar">modificar</button>
            </form>
        </div>
    </div>

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

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>