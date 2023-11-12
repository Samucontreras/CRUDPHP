// scripts.js

function confirmarEliminar(id) {
    var confirmacion = confirm("¿Estás seguro de que quieres eliminar este registro?");

    if (confirmacion) {
        window.location.href = "/crudphp/eliminar.php?id=" + id;
    }
}
