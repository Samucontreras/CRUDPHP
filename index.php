<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="/crudphp/eliminarregistro.js"></script>
</head>

<body>
    <!-- NavBar -->
    <nav class="navbar navbar-custom">
        <a class="navbar-brand" href="#">
            <img src="/crudphp/img/logo.png" width="160" height="50" class="d-inline-block align-top" alt=""></a>
        <h1 class="h">Service Luxury</h1>
        <ul class="navbar-nav d-flex flex-row">
            <!-- Icons -->
            <li class="nav-item me-2 me-lg-3">
                <a class="nav-link" href="#">
                    <i class="fab fa-facebook-f text-black"></i>
                </a>
            </li>
            <li class="nav-item me-2 me-lg-3">
                <a class="nav-link" href="#">
                    <i class="fab fa-instagram text-black"></i>
                </a>
            </li>
            <li class="nav-item me-2 me-lg-3">
                <a class="nav-link" href="#">
                    <i class="fab fa-linkedin text-black"></i>
                </a>
            </li>
            <li class="nav-item me-2 me-lg-3">
                <a class="nav-link" href="#">
                    <i class="fab fa-github text-black"></i>
                </a>
            </li>
            <li class="nav-item me-2 me-lg-3">
                <a class="nav-link" href="#">
                    <i class="fab fa-twitter text-black"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- Fin NavBar -->

    <div class="container my-5">
        <h1 class="text-center">Lista de Clientes</h1>
        <a class="btn btn-custom" href="/CRUDPHP/crear.php" role="button">Nuevo Cliente</a>
        <br>
        <br>

        <?php
        $servername = "localhost:3308";
        $username = "root";
        $password = "";
        $database = "formulario";

        // Crear Conexion BBDD
        $connection = new mysqli($servername, $username, $password, $database);

        // Establecer Conexion BBDD
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
    } else {
        echo "<p class='text-center text-success'>Conexión exitosa a la base de datos.</p>";
    }
    

        // Leer todas las filas de la tabla de la base de datos
        $sql = "SELECT * FROM clientes";
        $result = $connection->query($sql);

        if (!$result){
            die("Invalid query: " . $connection->error);
        }

        // Verificar si hay filas en el resultado
        if ($result->num_rows > 0) {
            // Si hay filas, imprimir la tabla
            echo "
            <table class='table table-custom text-center'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Telefono</th>
                        <th>Direccion</th>
                        <th>Creado el</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>";

            // Leer datos de cada fila
            while($row = $result->fetch_assoc()){
                echo "
                <tr>
                    <td>$row[id]</td>
                    <td>$row[name]</td>
                    <td>$row[email]</td>
                    <td>$row[phone]</td>
                    <td>$row[address]</td>
                    <td>$row[created_at]</td>
                    <td>
                        <a class='btn editar' href='/crudphp/editar.php?id=$row[id]'>Editar</a>
                        <a class='btn eliminar' href='javascript:confirmarEliminar($row[id])'>Eliminar</a>
                    </td>
                </tr>
                ";
            }

            echo "</tbody></table>";
        } else {
            // Si no hay filas, mostrar un mensaje
            echo "<p class='text-center'>No hay datos disponibles.</p>";
        }

        ?>
    </div>
    <footer>
    <p>&copy; <?php echo date("Y"); ?> Service Luxury. Todos los derechos reservados.</p>
    </footer>

    <!-- Scripts de Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>