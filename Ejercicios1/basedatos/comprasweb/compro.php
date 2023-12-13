<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra Producto </title>
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
        Compra Producto 
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
        <legend>Compra Producto</legend>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <?php
        include('funciones.php');
            $servername = "localhost";
            $username = "root";
            $password = "rootroot";
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
        <label for="unidades">Unidades a comprar</label>    
        <input type="text" name="unidades" id="unidades" required><br><br> 
        <label for="nif">NIF</label>    
        <input type="text" name="nif" id="nif" required><br><br> 

        <input type="submit">
        <input type="reset">
    </form>
    </fieldset>
    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){

            try {
                $unidades=test_input($_POST['unidades']);
                if(!ctype_digit($unidades)){
                    throw new Exception ('Número de unidades introducido NO válido.');
                }
                $VintTotalProd=0;
                $id_prod=test_input($_POST['prod']);
                $nif=test_input($_POST['nif']);
                $stmtnif = $conn->prepare("SELECT NOMBRE from cliente where NIF=:nif;");
                $stmtnif->bindParam(':nif', $nif);
                $stmtnif->execute();
                $NIFCheck=$stmtnif->fetchColumn();

                if(empty($NIFCheck)){
                    throw new Exception ('El NIF introducido no figura como cliente');
                }else{
                    $stmtCantidadProd = $conn->prepare("SELECT almacena.CANTIDAD as total,almacena.NUM_ALMACEN from almacena Where almacena.ID_PRODUCTO=:id_prod;");
                    $stmtCantidadProd->bindParam(':id_prod', $id_prod);
                    $stmtCantidadProd->execute();
                    $ArrCantProd=$stmtCantidadProd->FetchAll(PDO::FETCH_ASSOC);
                    foreach($ArrCantProd as $x){
                        $VintTotalProd=$VintTotalProd+$x['total'];
                    }
                    if($VintTotalProd<$unidades){
                        throw new Exception ('No hay unidades suficientes');
                    }else{
                        $stmt4 = $conn->prepare("INSERT INTO compra(FECHA_COMPRA, ID_PRODUCTO, NIF, UNIDADES) VALUES (:fecha, :id_prod, :nif,:unidades);");
                        $stmt4->bindParam(':id_prod', $id_prod);
                        $stmt4->bindParam(':nif', $nif);
                        $stmt4->bindParam(':unidades', $unidades);
                        $fecha=NEW DateTime();
                        $fecha_formateada = $fecha->format('Y-m-d H:i:s');
                        $stmt4->bindParam(':fecha', $fecha_formateada);
                        $stmt4->execute();

                        while($unidades!=0){
                            $stmtMax = $conn->prepare("SELECT CANTIDAD as MAXIMO, NUM_ALMACEN FROM almacena WHERE ID_PRODUCTO = :id_prod ORDER BY CANTIDAD DESC LIMIT 1;");
                            $stmtMax->bindParam(':id_prod', $id_prod);
                            $stmtMax->execute();
                            $ArrMax=$stmtMax->FetchAll(PDO::FETCH_ASSOC);
                            $maxVALOR=$ArrMax[0]['MAXIMO'];

                            if($maxVALOR>$unidades){
                                $aux=$maxVALOR-$unidades;
                                $stmt6 = $conn->prepare("UPDATE almacena SET CANTIDAD = :aux  WHERE ID_PRODUCTO = :id_prod AND NUM_ALMACEN = :id_alm;");
                                $stmt6->bindParam(':id_prod', $id_prod);
                                $stmt6->bindParam(':id_alm', $ArrMax[0]['NUM_ALMACEN']);
                                $stmt6->bindParam(':aux', $aux);
                                $stmt6->execute();
                                $unidades=0;
                            }else if($maxVALOR==$unidades){
                                $stmt5 = $conn->prepare("UPDATE almacena SET CANTIDAD = 0  WHERE ID_PRODUCTO = :id_prod AND NUM_ALMACEN = :id_alm;");
                                $stmt5->bindParam(':id_prod', $id_prod);
                                $stmt5->bindParam(':id_alm', $ArrMax[0]['NUM_ALMACEN']);
                                $stmt5->execute();
                                $unidades=0;
                            }else{
                                $unidades=$unidades-$maxVALOR;
                                $stmt7 = $conn->prepare("UPDATE almacena SET CANTIDAD = 0  WHERE ID_PRODUCTO = :id_prod AND NUM_ALMACEN = :id_alm;");
                                $stmt7->bindParam(':id_prod', $id_prod);
                                $stmt7->bindParam(':id_alm', $ArrMax[0]['NUM_ALMACEN']);
                                $stmt7->execute();
                            }
                        }
                    }
                }
            }catch(PDOException $e){
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