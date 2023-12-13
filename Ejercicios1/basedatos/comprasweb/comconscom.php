<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Compra</title>
    <link rel="stylesheet" type="text/css" href="index.css">
    <script>
        function onBlurFunction() {
            // Your JavaScript code here
            console.log('Element lost focus');
        }
    </script>
</head>
<body>
    <!--
        Consulta de Compra
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
        <legend>Consulta de Compra</legend>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <?php
        include('funciones.php');
            $servername = "localhost";
            $username = "root";
            $password = "rootroot";
            $dbname = "comprasweb";
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt1 = $conn->prepare("SELECT NIF,NOMBRE from cliente;");
            $stmt1->execute();
            $arrayCliente=$stmt1->FetchAll(PDO::FETCH_ASSOC);
            
            echo '<label for="client">Elige un cliente </label>';
            echo '<select name="client" id="client">';
            foreach ($arrayCliente as $cliente) {
                $nif = $cliente['NIF'];
                $nombre = $cliente['NOMBRE'];
                echo '<option value='.$nif.'>'.$nombre.'</option>';
            }
            echo '</select><br><br>';     
        ?>
        <label for="fecha_1">Fecha Inicio</label>    
        <input type="date" name="fecha_1" id="fecha_1"><br><br>
        <label for="fecha_2">Fecha Fin</label>    
        <input type="date" name="fecha_2" id="fecha_2"><br><br>
        <input type="submit">
        <input type="reset">
    </form>
    </fieldset>
    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){

            try {
                $id_cliente=test_input($_POST['client']);
                $fecha_1=date('Y-m-d', strtotime($_POST['fecha_1']));
                $fecha_2=date('Y-m-d', strtotime($_POST['fecha_2']));
                if($fecha_1>$fecha_2){
                    throw new Exception ('Las fechas introducidas no son válidas');
                }else{
                    $stmt2 = $conn->prepare("SELECT compra.FECHA_COMPRA,producto.NOMBRE,producto.PRECIO,compra.UNIDADES,producto.PRECIO * compra.UNIDADES AS Total
                    FROM compra INNER JOIN producto ON producto.ID_PRODUCTO = compra.ID_PRODUCTO
                    INNER JOIN cliente ON compra.NIF = cliente.NIF WHERE cliente.NIF = :nif
                    AND compra.FECHA_COMPRA BETWEEN :fecha_1 AND :fecha_2;");
                    $stmt2->bindParam(':fecha_1', $fecha_1);
                    $stmt2->bindParam(':fecha_2', $fecha_2);
                    $stmt2->bindParam(':nif', $id_cliente);
                    $stmt2->execute();
                    $ArrayCompra=$stmt2->FetchAll(PDO::FETCH_ASSOC);

                    echo "<br><table>";
                    echo "<tr><th>Fecha Compra</th><th>Nombre Producto</th><th>Precio Unitario</th><th>Unidades</th><th>Precio Total</th></tr>";
                    foreach($ArrayCompra as $compra){
                        $fechacompra = $compra['FECHA_COMPRA'];
                        $nombrecompra = $compra['NOMBRE'];
                        $preciocompra = $compra['PRECIO'];
                        $unidadescompra = $compra['UNIDADES'];
                        $totalcompra = $compra['Total'];
                        echo "<tr>";
                        echo "<td>$fechacompra</td>";
                        echo "<td>$nombrecompra</td>";
                        echo "<td>$preciocompra</td>";
                        echo "<td>$unidadescompra</td>";
                        echo "<td>$totalcompra</td>";
                        echo "</tr>"; 
                    }
                    echo "</table>";

                    
                }
                }
                catch(PDOException $e)
                {
                echo "Error: " . $e->getMessage();
                }catch(Exception $e){
                    echo "Error: " . $e->getMessage();
                }
            $conn = null;
        }
    ?>
</body>
</body>
</html>