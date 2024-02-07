<?php
// Llamada al fichero que inicia la conexión a la Base de Datos
require_once("db/db.php");
?>

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
        // Llamada al controlador
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            try{
                require_once("controllers/login_controller.php");
            }catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            $conn = null;
        }

        
    ?>
</body>
</html>