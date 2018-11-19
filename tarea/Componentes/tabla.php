<?php
    require_once "../utilities/Conexion.php";
    $conexion = Conexion();
?>
<div class="row">
    <div class="col-sm-12">
        <h2>Clientes</h2>
        <caption>
            <button class="btn btn-primary" data-toggle="modal" data-target="#CrearModal">Nuevo</button>
        </caption>
        <br>
        <table class="table table-hover table-condensed table-bordered">
            <tr>
                <td>Nombre</td>
                <td>Documento</td>
                <td>Telefono</td>
                <td>Facturas</td>
                <td>Editar</td>
                <td>Eliminar</td>
            </tr>
            <?php
               $consulta = "CALL `ObtenerClientes`();";
               $ejecutar = mysqli_query($conexion,$consulta);
               $bandera = 0;
               while($fila = mysqli_fetch_array($ejecutar)){
                   $IdCon = $fila['Id'];
                   $NombreCon = $fila['Nombre'];
                   $CedulaCon = $fila['Cedula'];
                   $TelefonoCon = $fila['Telefono'];
                   $FacturasCon = $fila['Facturas'];
                   $bandera++;
            ?>
            <tr>
                <td><?php echo $NombreCon ?></td>
                <td><?php echo $CedulaCon ?></td>
                <td><?php echo $TelefonoCon ?></td>
                <td><?php echo $FacturasCon ?></td>
                <td>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#EditarModal">Editar</button>
                </td>
                <td>
                    <button class="btn btn-danger glyphicon glyphicon-trash">Eliminar</button>
                </td>
            </tr>
            <?php
               }
            ?>
        </table>
    </div>
</div>