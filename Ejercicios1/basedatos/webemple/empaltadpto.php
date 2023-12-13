<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta Almacen</title>
    <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
    <!--
        Alta Almacen 
    -->
    <nav>
        <ul>
            <li><a href="empaltadpto.php">Alta Departamento</a></li>
            <li><a href="empaltaemp.php">Alta Empleado</a></li>
            <li><a href="empcambiodpto.php">Cambio Departamento</a></li>
            <li><a href="emplistadpto.php">Empleados de Departamento Actual</a></li>
            <li><a href="emphistdpto.php">Empleados de Departamento Histórico</a></li>
            <li><a href="empsalarioemp.php">Actualizar Salario</a></li>
            <li><a href="empfecha.php">Relacion Fecha</a></li>
        </ul>
    </nav>
    <fieldset>
        <legend>Alta Almacen</legend>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="localidad">Localidad</label>    
        <input type="text" name="localidad" id="localidad" required><br><br> 
        <input type="submit">
        <input type="reset">
    </form>
    </fieldset>
    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){

            try {
                $servername = "localhost";
                $username = "root";
                $password = "rootroot";
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