<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Sesion</title>
    <link rel="stylesheet" type="text/css" href="./css/index.css">
</head>
<body>
    <fieldset>
        <legend>Inicio Sesion</legend>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="nombre">Customer Number</label>
        <input type="text" name="nombre" id="nombre" required><br><br>
        <label for="pass">Contraseña</label>    
        <input name="pass" id="pass" required><br><br> 
        <input type="submit" value="Entrar">
        <input type="reset">
        
    </form>
    </fieldset>
    <?php
        include('funciones.php');
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            try{
                $conn = conection();
                $pass=test_input($_POST['pass']);
                $nombre=test_input($_POST['nombre']);
                $arrayBool = inicio_sesion($conn,$pass,$nombre);
                if(!$arrayBool){
                    echo("El nombre de usuario o la contraseña no coinciden / No se ha registrado");
                }else{
                    session_start();
                    $_SESSION['nombre']=$nombre;
                    header("Location:pe_inicio.php");
                }
                }
            catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            $conn = null;
        }

        
    ?>
</body>
</html>