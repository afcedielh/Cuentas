<?php
     if(isset($_GET['editar'])){
         $editar_id = $_GET['editar'];
         $consulta = "SELECT * FROM usuario WHERE UserName = '$editar_id'";
         $ejecutar = mysqli_query($enlace,$consulta);
         $fila = mysqli_fetch_array($ejecutar);
         $UserNameedit = $fila['UserName'];
         $Emailedit = $fila['Email'];
         $Nombreedit = $fila['Nombre'];
         $Edadedit = $fila['Edad'];
     }
?>

<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="form_main">
                    <h4 class="heading"><strong>Nuevo </strong> usuario <span></span></h4>
                    <div class="form">
                        <form action="" method="post">
                            <input type="text" required="true" placeholder="UserName" value="<?php echo $UserNameedit ?>" name="UserName" class="txt">
                            <input type="text" required="true" placeholder="Correo" value="<?php echo $Emailedit ?>" name="Email" class="txt">
                            <input type="text" required="true" placeholder="Nombre" value="<?php echo $Nombreedit ?>" name="Nombre" class="txt">
                            <input type="text" required="true" placeholder="Edad" value="<?php echo $Edadedit ?>" name="Edad" class="txt">
                            <input type="text" required="true" placeholder="Contraseña" value="" name="pass" class="txt">
                            <input type="submit" value="Guardar" name="Actualizar" id="Actualizar" class="txt2">
                        </form>
                        <?php
                            if(isset($_POST['Actualizar'])){
                                $UserName1 = $_POST['UserName'];
                                $Email1 = $_POST['Email'];
                                $pass1 = $_POST['pass'];
                                $Nombre1 = $_POST['Nombre'];
                                $Edad1 = $_POST['Edad'];
                                $actualizar = "UPDATE usuario SET Email='$Email1',Pass='$pass1',Nombre='$Nombre1',Edad=$Edad1 WHERE UserName = '$UserName1';";
                                if ($enlace->query($actualizar) === TRUE) {
                                    echo "<script>alert('Datos modificados')</script>";
                                    echo "<script>windows.open('formulario.php')</script>";
                                }else{                                    
                                    echo "no".$insertar;
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>