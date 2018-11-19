<?php
    function Conexion(){
        return new mysqli("localhost", "root", "", "cuentas");
    }
?>