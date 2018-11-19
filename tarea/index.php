<!DOCTYPE <!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="vendor/alertifyjs/css/alertify.css">
    <link rel="stylesheet" href="vendor/alertifyjs/css/themes/default.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="Js/funciones.js"></script>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
        <div class="container">
            <a class="navbar-brand" href="#">Facturación</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Inicio
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Facturas.php">Facturas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Clientes.php">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Productos.php">Productos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div id="tabla">
        </div>
    </div>

    <!-- Modal para creación -->
    <div class="modal fade" id="CrearModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="FrmCreacion">
                        <label>Nombre</label>
                        <input type="text" name="txtNombre" id="txtNombre" class="form-control input-sm">
                        <label>Documento</label>
                        <input type="text" name="txtDocumento" id="txtDocumento" class="form-control input-sm">
                        <label>Teléfono</label>
                        <input type="text" name="txtTelefono" id="txtTelefono" class="form-control input-sm">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="GuardarNuevo">Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para Edición -->
    <div class="modal fade" id="EditarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>Nombre</label>
                    <input type="text" name="txtEditarNombre" id="txtEditarNombre" class="form-control input-sm">
                    <label>Documento</label>
                    <input type="text" name="txtEditarDocumento" id="txtEditarDocumento" class="form-control input-sm">
                    <label>Teléfono</label>
                    <input type="text" name="txtEditarTelefono" id="txtEditarTelefono" class="form-control input-sm">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="EditarRegistro">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>

<script type="text/javascript">
    $(document).ready(function () {
        $('#tabla').load('Componentes/tabla.php');
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#GuardarNuevo').click(function () {
            NuevoCliente($('#FrmCreacion').serialize());
            $('#txtNombre').val("");
            $('#txtDocumento').val("");
            $('#txtTelefono').val("");
        });
    });
</script>