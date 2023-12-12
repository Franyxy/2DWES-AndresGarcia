<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Almacenes</title>
    <link rel="stylesheet" type="text/css" href="index.css">

</head>
<body>
    <!--
        Consulta de Almacenes
    -->
    <nav>
        <ul>
            <li><a href="comaltacat.php">Alta Categoría</a></li>
            <li><a href="comaltapro.php">Alta de Productos</a></li>
            <li><a href="comaltaalm.php">Alta de Almacenes</a></li>
            <li><a href="comaprpro.php">Aprovisionar Productos</a></li>
            <li><a href="comconstock.php">Consulta de Stock</a></li>
            <li><a href="comconsalm.php">Consulta de Almacenes</a></li>
            <li><a href="comconscom.php">Consulta de Compras</a></li>
            <li><a href="comaltacli.php">Alta de Clientes</a></li>
            <li><a href="compro.php">Compra de Productos</a></li>
        </ul>
    </nav>
    <fieldset>
    <legend>Consulta de Almacenes</legend>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "adm1n";
            $dbname = "comprasweb";
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $stmt1 = $conn->prepare("SELECT NUM_ALMACEN,LOCALIDAD from almacen;");
            $stmt1->execute();
            $arrayAlm=$stmt1->FetchAll(PDO::FETCH_ASSOC);
            
            echo '<label for="alm">Elige un almacén </label>';
            echo '<select name="alm" id="alm">';
            foreach ($arrayAlm as $almacen) {
                $nombre = $almacen['LOCALIDAD'];
                $cod = $almacen['NUM_ALMACEN'];
                echo '<option value='.$cod.'>'.$nombre.'</option>';
            }
            echo '</select><br><br>';

        ?>
        <input type="submit">
        <input type="reset">
    </form>
    </fieldset>
    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){

            try {
                $id_alm=test_input($_POST['alm']);
                $stmt2 = $conn->prepare("SELECT almacena.CANTIDAD,producto.NOMBRE
                FROM producto INNER JOIN  almacena on 
                    producto.ID_PRODUCTO=almacena.ID_PRODUCTO
                INNER JOIN almacen on 
                    almacena.NUM_ALMACEN=almacen.NUM_ALMACEN and
                    almacen.NUM_ALMACEN=:id_alm;");

                $stmt2->bindParam(':id_alm', $id_alm);
                $stmt2->execute();
                $arrayProdAlm=$stmt2->FetchAll(PDO::FETCH_ASSOC);

                echo "<br><table>";
                echo "<tr><th>Nombre</th><th>Cantidad</th></tr>";

                foreach ($arrayProdAlm as $producto) {
                    $cantidad = $producto['CANTIDAD'];
                    $nombre = $producto['NOMBRE'];

                    echo "<tr>";
                    echo "<td>$nombre</td>";
                    echo "<td>$cantidad</td>";
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