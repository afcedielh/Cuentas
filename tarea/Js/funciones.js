function NuevoCliente(datos) {
    debugger
    $.ajax({
        type: "POST",
        url: "utilities/NuevoCliente.php",
        data: datos,
        success: function (r) {
            debugger
            if (r == 1) {
                $('#tabla').load('Componentes/tabla.php');
                alert("Cliente agregado con exito.");
            } else {
                alert(r);
            }
        }
    });
}