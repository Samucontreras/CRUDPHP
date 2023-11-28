function confirmarEliminar(id) {
    var confirmacion = confirm("¿Estás seguro de que quieres eliminar este registro?");

    if (confirmacion) {
        window.location.href = "./eliminar.php?id=" + id;
    }
}

// Esperar a que la página se cargue completamente
document.addEventListener("DOMContentLoaded", function () {
    // Seleccionar el elemento del mensaje de conexión exitosa
    var mensajeConexionExitosa = document.querySelector('.text-success');

    // Ocultar el mensaje después de 2 segundos (2000 milisegundos)
    setTimeout(function () {
        mensajeConexionExitosa.style.display = 'none';
    }, 2000);
});
