

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="cod_dpto"> Codigo Departamento</label>    
        <input type="text" name="cod_dpto" id="cod_dpto"><br><br>

        <label for="nombre_dpto"> Nombre Departamento</label>    
        <input type="text" name="nombre_dpto" id="nombre_dpto"><br><br>

        <input type="submit">
        <input type="reset">
    </form>
    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $cod_dpto=test_input($_POST['cod_dpto']);
            $nombre_dpto=test_input($_POST['nombre_dpto']);
        

        

        $servername = "localhost";
        $username = "root";
        $password = "rootroot";
        $dbname = "empleados1n";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // prepare sql and bind parameters
            $stmt = $conn->prepare("INSERT INTO departamento (cod_dpto,nombre_dpto) VALUES (:cod_dpto,:nombre_dpto)");
            $stmt->bindParam(':cod_dpto', $cod_dpto);
            $stmt->bindParam(':nombre_dpto', $nombre_dpto);

            
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
