<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="./estilos.css">
</head>

<body>
    <?php
        include '../conexion.php';
        $conn = conectarDB(); 
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if (isset($_POST['agregar'])) {
                $ID_Cliente = $_POST['Clientes'];
                $Nivel = $_POST['Nivel'];
                $Correo = $_POST['Correo'];
                $Contreseña = $_POST['Contraseña'];

                $sql = "INSERT INTO tbl_usuario (ID_Cliente,Nivel,Correo,Contraseña) VALUES ('$ID_Cliente','$Nivel','$Correo','$Contreseña')";
                
                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Fila insertada correctamente.');</script>";
                } else {
                    echo "Error al insertar fila: " . mysqli_error($conn);
                }
            }
            if (isset($_POST['modificar'])){
                $ID_usuario = $_POST['ID_usuario'];
                $Nivel = $_POST['text-nivel'];
                $Correo = $_POST['text-correo'];
                $Contreseña = $_POST['text-contraseña'];

                $sql = "UPDATE tbl_usuario SET Nivel='$Nivel', Correo='$Correo', Contraseña='$Contraseña' WHERE ID_Usuario = '$ID'";
                
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
                    <a href="./reservas.php">
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
                <h2>Usuarios</h2>
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
                        <td>Cliente</td>
                        <td>Nivel</td>
                        <td>Correo</td>
                        <td>Contraseña</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $conn = conectarDB();
                    $sql = "SELECT * FROM tbl_usuario;";
                    $resultado = mysqli_query($conn, $sql);
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        $idClt = $fila['ID_Cliente'];
                        $sqlClt = "SELECT Nombre_Razón_Social FROM tbl_cliente_persona WHERE ID_Cliente = '$idClt'";
                        $result = mysqli_fetch_assoc(mysqli_query($conn, $sqlClt));
                        echo "<tr>  
                                <td>" . $result['Nombre_Razón_Social'] . "</td>
                                <td>" . $fila['Nivel'] . "</td>
                                <td>" . $fila['Correo'] . "</td>
                                <td>" . $fila['Contraseña'] . "</td>
                                <td>
                                    <span class='btns btn-modificar' onclick='ConfgVentModifi(".json_encode($fila).",". json_encode($result['Nombre_Razón_Social']) .")'>Modificar</span>
                                    <span class='btns btn-eliminar' onclick='ConfgVentElim(".$fila['ID_Usuario'].");'>Eliminar</span>
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

                <select class="mi-select" name="Clientes">
                    <option value="">Seleccionar una opción</option>
                    <?php
                        $conn = conectarDB();
                        $sql = "SELECT * FROM tbl_cliente_persona;";
                        $resultado = mysqli_query($conn, $sql); 

                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            $id = $fila['ID_Cliente'];
                            $sqlUser = "SELECT * FROM tbl_usuario WHERE ID_Cliente = '$id';";
                            $result = mysqli_query($conn, $sqlUser); 
                            if (mysqli_num_rows($result) < 1) echo '<option value="' . $fila['ID_Cliente'] . '">' . $fila['Nombre_Razón_Social'] . '</option>';
                        }
                        mysqli_close($conn);
                    ?>
                </select>
                
                <select class="mi-select" name="Nivel">
                    <option value="">Seleccionar una opción</option>
                    <option value="1">Administrador</option>
                    <option value="2">Operador</option>
                    <option value="3">Usuario</option>
                </select>

                <input name="Correo" type="text" placeholder="Correo">

                <input name="Contraseña" type="text" placeholder="Contraseña">

                <button class="btns btn-modificar"  type="submit" name="agregar" class="forma btn-modificar">Agregar</button>
            
            </form>
        </div>
    </div>

    <!-- ////////////////// Ventana MODA DE Modificar ////////////////// -->

    <div id="ventmodifi" class="ventana">
        <div class="conte-vent">
            <ion-icon name="close-circle-outline" class="btns btn-cerrar" onclick="document.getElementById('ventmodifi').style.display = 'none';"></ion-icon>
            
            <!-- Forma para modificar -->
            <form id="form-modificar"action="" method="post" name="modificar">

                <input id="ID_usuario" type="hidden" name="ID_usuario">
                
                <h2></h2>
                
                <select id="text_nivel" class="mi-select" name="text_nivel">
                    <option value="">Seleccionar una opción</option>
                    <option value="1">Administrador</option>
                    <option value="2">Operador</option>
                    <option value="3">Usuario</option>
                </select>

                <input id="text_correo" name="text_correo" type="text" placeholder="Correo">

                <input id="text_contraseña" name="text_contraseña" type="text" placeholder="Contraseña">

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