<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
    </head>
    <body>
        <?php
            if(!$arrayBool){
                echo("El nombre de usuario o la contraseña no coinciden / No se ha registrado");
            }else{
                session_start();
                $_SESSION['nombre']=$nombre;
                header("Location:pe_inicio.php");
            }
        ?>
    </body>
</html>