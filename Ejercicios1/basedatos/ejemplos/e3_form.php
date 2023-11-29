<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!--
        En el siguiente ejercicio, mostraremos por pantalla los datos de todos los empleados  que trabajan en un departamente seleccionado con anterioridad
    -->
    <h1>Consulta Empleados</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "rootroot";
            $dbname = "empleadosnn";
            $conn1 = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt1 = $conn1->prepare("SELECT nombre_dpto,cod_dpto from departamento;");
            $stmt1->execute();
            $arrayNomdto=$stmt1->FetchAll(PDO::FETCH_ASSOC);
            echo '<label for="nom_dto">Elige un departamento</label>';
            echo '<select name="nom_dto" id="nom_dto">';
            foreach ($arrayNomdto as $departamento) {
                $nombre = $departamento['nombre_dpto'];
                $cod = $departamento['cod_dpto'];
                echo '<option value='.$cod.'>'.$nombre.'</option>';
            }
            echo '</select><br><br>';
        ?>
        <input type="submit">
        <input type="reset">
    </form>
    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $servername = "localhost";
            $username = "root";
            $password = "rootroot";
            $dbname = "empleadosnn";

            $valueOption=test_input($_POST['nom_dto']);
            
            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // prepare sql and bind parameters
                $stmt = $conn->prepare("SELECT  empleado.dni,nombre_emple,salario,fecha_nac from empleado inner join emple_dpto on empleado.dni=emple_dpto.dni INNER JOIN departamento ON departamento.cod_dpto = emple_dpto.cod_dpto WHERE departamento.cod_dpto=:cod_dpto");
                $stmt->bindParam(':cod_dpto', $valueOption);
                $stmt->execute();
                $arrayDatosEmpleado=$stmt->FetchAll(PDO::FETCH_ASSOC);
                echo "<br><table border='1px' style='border-collapse: collapse; text-align:center;'>";
                echo "<tr><th>DNI</th><th>Nombre Empleado</th><th>Salario</th><th>Fecha Nacimiento</th></tr>";
                foreach($arrayDatosEmpleado as $empleado){
                    echo "<tr>";
                    foreach($empleado as $dato => $valor){
                        echo "<td>$valor</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";

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
