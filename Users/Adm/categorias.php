<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias</title>
    <link rel="stylesheet" href="./estilos.css">
</head>

<body>
    <?php
        include 'conexion.php';
        $conn = conectarDB(); 
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if (isset($_POST['agregar'])) {
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['desc'];
                $capacidad = $_POST['cap'];
                $costo = $_POST['cost'];

                $sql = "INSERT INTO tbl_categorias (Nombre,Descripción,Capacidad,Precio) VALUES ('$nombre','$descripcion','$capacidad','$costo')";
                
                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Fila insertada correctamente.');</script>";
                } else {
                    echo "Error al insertar fila: " . mysqli_error($conn);
                }
            }
            if (isset($_POST['modificar'])){
                $ID = $_POST['ID_Cat'];
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['desc'];
                $capacidad = $_POST['cap'];
                $costo = $_POST['cost'];

                $sql = "UPDATE tbl_categorias SET Nombre='$nombre',Descripción='$descripcion',Capacidad='$capacidad',Precio='$costo' WHERE ID_Categoria = '$ID'";
                
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
                <li id="Categorias">
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
                <h2>Categorias</h2>
            </div>
            <div class="conte-btns">
                <div>
                    <div class="btn-agregar" onclick="document.getElementById('ventagregar').style.display = 'block'">Agregar</div>
                </div>
                <div>
                    <input id="buscador_tabla" type="text" placeholder="Buscar">
                </div>
            </div>

            <table id="Tabla_Servicios">
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
                                    <span class='btns btn-modificar' onclick='ConfgVentModifiCat(".json_encode($fila).")'>Modificar</span>
                                    <span class='btns btn-eliminar' onclick='ConfgVentElimCat(".$fila['ID_Categoria'].");'>Eliminar</span>
                                </td>
                            </tr>";
                        
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
                <input id="text-nombre" name="nombre" type="text" placeholder="Nombre">
                <input id="text-desc" name="desc" type="text" placeholder="Descripcion">
                <input id="text-cap" name="cap" type="int" placeholder="Capacidad">
                <input id="text-cost" name="cost" type="text" placeholder="Precio">
                <button type="submit" name="agregar">agregar</button>
            </form>
        </div>
    </div>

    <div id="ventmodifi" class="ventana">
        <div class="conte-vent">
            <ion-icon name="close-circle-outline" class="btns btn-cerrar" onclick="document.getElementById('ventmodifi').style.display = 'none';"></ion-icon>
            <form id="form-modificar"action="" method="post" name="modificar">
                <input id="ID_Cat" type="hidden" name="ID_Cat">
                <input id="text-nombreCat" name="nombre" type="text" placeholder="Nombre">
                <input id="text-descCat" name="desc" type="text" placeholder="Descripcion">
                <input id="text-capCat" name="cap" type="int" placeholder="Capacidad">
                <input id="text-costCat" name="cost" type="text" placeholder="Precio">
                <button class="btns btn-modificar"  type="submit" name="modificar" class="forma btn-modificar">modificar</button>
            </form>
        </div>
    </div>

    <div id="venteliminar" class="ventana">
        <div class="conte-vent">
            <ion-icon name="close-circle-outline" class="btns btn-cerrar" onclick="document.getElementById('venteliminar').style.display = 'none';"></ion-icon>
            <form id="form-agregar" action="" method="post" name="agregar">
                <input id="ID_CatElim" type="hidden" name="ID_Cat">
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