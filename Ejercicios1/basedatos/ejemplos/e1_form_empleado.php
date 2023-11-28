

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="dni">DNI</label>    
        <input type="text" name="dni" id="dni"><br><br>

        <label for="nombre">Nombre</label>    
        <input type="text" name="nombre" id="nombre"><br><br>

        <label for="salario">Salario</label>    
        <input type="text" name="salario" id="salario"><br><br>

        <label for="cod_dpto">Departamento</label>    
        <input type="text" name="cod_dpto" id="cod_dpto"><br><br>

        <input type="submit">
        <input type="reset">
    </form>
    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $dni=test_input($_POST['dni']);
            $nombre=test_input($_POST['nombre']);
            $salario=test_input($_POST['salario']);
            $cod_dpto=test_input($_POST['cod_dpto']);
            $servername = "localhost";
            $username = "root";
            $password = "rootroot";
            $dbname = "empleados1n";

            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // prepare sql and bind parameters
                $stmt = $conn->prepare("INSERT INTO empleado (dni,nombre_emple,salario,cod_dpto) VALUES (:dni,:nombre_emple,:salario,:cod_dpto)");
                $stmt->bindParam(':dni', $dni);
                $stmt->bindParam(':nombre_emple', $nombre);
                $stmt->bindParam(':salario', $salario);
                $stmt->bindParam(':cod_dpto', $cod_dpto);
                
                $stmt->execute();


                echo "New records created successfully";
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
</html>
