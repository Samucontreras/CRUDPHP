<?php
if ( isset($_GET["id"]) ) {
    $id = $_GET["id"];

    $servername = "localhost:3308";
    $username = "root";
    $password = "";
    $database = "formulario";

    // Crear Conexion BBDD
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM clientes WHERE id=$id";
    $connection->query($sql);
}

header("location: /crudphp/index.php");
exit;
?>