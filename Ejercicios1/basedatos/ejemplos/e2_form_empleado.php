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

        <label for="fecha_nac">Fecha Nacimiento</label>    
        <input type="date" name="fecha_nac" id="fecha_nac"><br><br>

        <?php
            $servername = "localhost";
            $username = "root";
            $password = "rootroot";
            $dbname = "empleadosnn";

            $conn1 = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt1 = $conn1->prepare("SELECT cod_dpto from departamento;");
            $stmt1->execute();
            $arrayCod_pdto=$stmt1->FetchAll(PDO::FETCH_COLUMN);
            echo '<label for="cod_dpto">Elige un departamento</label>';
            echo '<select name="cod_dpto" id="cod_dpto">';
            foreach($arrayCod_pdto as $x){
                echo '<option value='.$x.'>'.$x.'</option>';
            }
            echo '</select><br><br>';
        ?>


        <label for="fecha_ini">Fecha Inicio Departamento</label>    
        <input type="date" name="fecha_ini" id="fecha_ini"><br><br>

        <input type="submit">
        <input type="reset">
    </form>
    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $servername = "localhost";
            $username = "root";
            $password = "rootroot";
            $dbname = "empleadosnn";

            $dni=test_input($_POST['dni']);
            $nombre=test_input($_POST['nombre']);
            $salario=test_input($_POST['salario']);
            $fecha_nac=date('Y-m-d', strtotime($_POST['fecha_nac']));
            $cod_dpto=test_input($_POST['cod_dpto']);
            $fecha_ini=date('Y-m-d', strtotime($_POST['fecha_ini']));
            

            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // prepare sql and bind parameters
                $stmt = $conn->prepare("INSERT INTO empleado (dni,nombre_emple,salario,fecha_nac) VALUES (:dni,:nombre_emple,:salario,:fecha_nac);
                                        INSERT INTO emple_dpto (dni,cod_dpto,fecha_ini) VALUES (:dni,:cod_dpto,:fecha_ini)");
                $stmt->bindParam(':dni', $dni);
                $stmt->bindParam(':nombre_emple', $nombre);
                $stmt->bindParam(':salario', $salario);
                $stmt->bindParam(':fecha_nac', $fecha_nac);
                $stmt->bindParam(':cod_dpto', $cod_dpto);
                $stmt->bindParam(':fecha_ini', $fecha_ini);
                
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
