<?php
$servername = "localhost:3308";
$username = "root";
$password = "";
$database = "formulario";

// Crear Conexion BBDD
$connection = new mysqli($servername, $username, $password, $database);

$name = "";
$email = "";
$phone = "";
$address = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    // Validar campos
    if (empty($name) || empty($email) || empty($phone) || empty($address)) {
        $errorMessage = "Todos los campos son requeridos";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "El formato del correo electrónico no es válido";
    } elseif (!preg_match("/^\d{9}$/", $phone)) {
        $errorMessage = "El formato del número de teléfono no es válido";
    } else {
        // Verificar si el correo electrónico ya está en uso
        $checkDuplicateEmail = "SELECT * FROM clientes WHERE email=?";
        $stmt = $connection->prepare($checkDuplicateEmail);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $duplicateResult = $stmt->get_result();

        if ($duplicateResult->num_rows > 0) {
            $errorMessage = "El correo electrónico ya está en uso. Por favor, utiliza otro.";
        } else {
            // Agregar cliente a la base de datos
            $sql = "INSERT INTO clientes (name, email, phone, address) VALUES (?, ?, ?, ?)";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("ssss", $name, $email, $phone, $address);
            $result = $stmt->execute();

            if ($result) {
                $successMessage = "Cliente agregado correctamente";
                // Limpiar los valores después de una inserción exitosa
                $name = $email = $phone = $address = "";
            } else {
                $errorMessage = "Error al agregar el cliente: " . $stmt->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="estilo.css">
</head>

<body>
    <!-- NavBar -->
    <nav class="navbar navbar-custom">
        <a class="navbar-brand" href="/crudphp/index.php">
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
        <h2 class="text-center">Nuevo Cliente</h2><br>

        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='row mb-3'>
                <div class='offset-sm-3 col-sm-6'>
                    <div class='alert alert1 alert-dismissible fade show' role='alert'>
                        <strong>$errorMessage</strong>
                         <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                </div>
            </div>        
            ";
        }

        if (!empty($successMessage)) {
            echo "
            <div class='row mb-3'>
                <div class='offset-sm-3 col-sm-6'>
                    <div class='alert alert2 alert-dismissible fade show' role='alert'>
                        <strong>$successMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                </div>
            </div>
            ";
        }
        ?>

        <form method="post" class="text-center">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nombre</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Teléfono</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Dirección</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
                </div>
            </div>

            <div class="row mb-1">
                <div class="offset-sm-3 col-sm-6">
                    <button type="submit" class="btn btn-custom btn-block">Agregar</button>
                </div>
            </div>
        </form>
    </div>
    <footer>
    <p>&copy; <?php echo date("Y"); ?> Service Luxury. Todos los derechos reservados.</p>
    </footer>
</body>

</html>