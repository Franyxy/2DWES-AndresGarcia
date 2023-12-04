<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Stock</title>
</head>
<body>
    <!--
        Consulta de Stock
    -->
    <h1>Consulta de Stock</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "adm1n";
            $dbname = "comprasweb";
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt1 = $conn->prepare("SELECT ID_PRODUCTO,NOMBRE from producto;");
            $stmt1->execute();
            $arrayProd=$stmt1->FetchAll(PDO::FETCH_ASSOC);
            
            echo '<label for="prod">Elige un producto </label>';
            echo '<select name="prod" id="prod">';
            foreach ($arrayProd as $producto) {
                $nombre = $producto['NOMBRE'];
                $cod = $producto['ID_PRODUCTO'];
                echo '<option value='.$cod.'>'.$nombre.'</option>';
            }
            echo '</select><br><br>';

        ?>
        <input type="submit">
        <input type="reset">
    </form>
    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){

            try {
                $id_prod=test_input($_POST['prod']);

                $stmt2 = $conn->prepare("SELECT almacena.CANTIDAD,almacen.LOCALIDAD
                FROM almacen INNER JOIN  almacena on 
                    almacen.NUM_ALMACEN=almacena.NUM_ALMACEN
                INNER JOIN producto on 
                    almacena.ID_PRODUCTO=producto.ID_PRODUCTO and
                    producto.ID_PRODUCTO=:id_prod;");

                $stmt2->bindParam(':id_prod', $id_prod);
                $stmt2->execute();
                $arrayStockProd=$stmt2->FetchAll(PDO::FETCH_ASSOC);

                echo "<br><table border='1px' style='border-collapse: collapse; text-align:center;'>";
                echo "<tr><th>Cantidad</th><th>Localidad</th></tr>";

                foreach ($arrayStockProd as $producto) {
                    $cantidad = $producto['CANTIDAD'];
                    $localidad = $producto['LOCALIDAD'];

                    echo "<tr>";
                    echo "<td>$cantidad</td>";
                    echo "<td>$localidad</td>";
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