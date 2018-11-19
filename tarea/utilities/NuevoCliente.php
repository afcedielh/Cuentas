<?php
    require_once "../utilities/Conexion.php";
    ini_set('display_errors',1); 
    error_reporting(E_ALL);
    $conexion = Conexion();
     $Nombre1 = $_POST['txtNombre'];
     $Cedula1 = $_POST['txtDocumento'];
     $Telefono1 = $_POST['txtTelefono'];
     $insertar = "CALL `CrearCliente`('$Nombre1', '$Cedula1', '$Telefono1');"; 
    // echo $conexion->query($insertar);
    echo $result = mysqli_query($conexion,$insertar);
?>