<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="/crudphp/eliminarregistro.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/crudphp/index.php">Tu Aplicación</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/CRUDPHP/crear.php">Nuevo Cliente</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h2>Lista de Clientes</h2>
        <a class="btn btn-primary" href="/CRUDPHP/crear.php" role="button">Nuevo Cliente</a>
        <br>
        <table class="table">
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
            <tbody>
                <?php
                $servername = "localhost:3308";
                $username = "root";
                $password = "";
                $database = "formulario";

                // Crear Conexion BBDD
                $connection = new mysqli($servername, $username, $password, $database);

                // Establecer Conexion BBDD
                if ($connection->connect_error){
                    die("Connection failed: " . $connection->connect_error);
                }

                // Leer todas las filas de la tabla de la base de datos
                $sql = "SELECT * FROM clientes";
                $result = $connection->query($sql);

                if (!$result){
                    die("Invalid query: " . $connection->error);
                }

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
                            <a class='btn btn-primary btn-sm' href='/crudphp/editar.php?id=$row[id]'>Editar</a>
                            <a class='btn btn-danger btn-sm' href='javascript:confirmarEliminar($row[id])'>Eliminar</a>
                        </td>
                    </tr>
                    ";
                }

                ?>
            </tbody>
        </table>
    </div>

    <!-- Scripts de Bootstrap y otros scripts que puedas necesitar -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
