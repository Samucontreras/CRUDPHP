// scripts.js
        setTimeout(function () {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.style.display = 'none';
            }
        }, 3000); // 3000 milisegundos = 3 segundos
    



function confirmarEliminar(id) {
    var confirmacion = confirm("¿Estás seguro de que quieres eliminar este registro?");

    if (confirmacion) {
        window.location.href = "/crudphp/eliminar.php?id=" + id;
    }
}
