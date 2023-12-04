<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta Almacen</title>
</head>
<body>
    <!--
        Alta Almacen 
    -->
    <h1>Alta Almacen</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="localidad">Localidad</label>    
        <input type="text" name="localidad" id="localidad"><br><br> 
        <input type="submit">
        <input type="reset">
    </form>
    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){

            try {
                $servername = "localhost";
                $username = "root";
                $password = "adm1n";
                $dbname = "comprasweb";
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // Sentencia sql para saber cuantas categorias hay, nos lo muestra en una array
                $stmt1 = $conn->prepare("SELECT MAX(NUM_ALMACEN) from almacen;");
                $stmt1->execute();
                $CodMax=$stmt1->fetchColumn();
                //Condición if la cuál nos ayudará a obtener un código que se autoincremente
                if($CodMax==null){
                    $cod="1";

                }else{
                    $cod=$CodMax+1;;
                }
                $localidad=test_input($_POST['localidad']);
                $stmt2 = $conn->prepare("INSERT INTO almacen (NUM_ALMACEN,LOCALIDAD) VALUES (:cod,:localidad);");
                $stmt2->bindParam(':cod', $cod);
                $stmt2->bindParam(':localidad', $localidad);
                $stmt2->execute();

                echo "Se han introducido los datos correctamente";
                }
            catch(PDOException $e)
                {
                echo "Error: " . $e->getMessage();
                }
            $conn = null;
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>
</body>
</body>
</html>