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
            $stmt2 = $conn->prepare("SELECT NUM_ALMACEN,LOCALIDAD from almacen;");
            $stmt2->execute();
            $arrayAlm=$stmt2->FetchAll(PDO::FETCH_ASSOC);
            
            echo '<label for="alm">Elige un almacén </label>';
            echo '<select name="alm" id="alm">';
            foreach ($arrayAlm as $almacen) {
                $nombre = $almacen['LOCALIDAD'];
                $cod = $almacen['NUM_ALMACEN'];
                echo '<option value='.$cod.'>'.$nombre.'</option>';
            }
            echo '</select><br><br>';
            
        ?>
        <label for="nif">NIF</label>    
        <input type="text" name="nif" id="nif" required><br><br>    

        <input type="submit">
        <input type="reset">
    </form>
    </fieldset>
    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){

            try {
                $id_alm=test_input($_POST['alm']);
                $id_prod=test_input($_POST['prod']);
                $nif=test_input($_POST['nif']);

                $stmtnif = $conn->prepare("SELECT NOMBRE from cliente where NIF=:nif;");
                $stmtnif->bindParam(':nif', $nif);
                $stmtnif->execute();
                $NIFCheck=$stmtnif->fetchColumn();

                if(empty($NIFCheck)){
                    throw new Exception ('El NIF introducido no figura como cliente');
                }else{
                    $stmt3 = $conn->prepare("SELECT CANTIDAD from almacena Where ID_PRODUCTO=:id_prod AND NUM_ALMACEN=:id_alm;");
                    $stmt3->bindParam(':id_alm', $id_alm);
                    $stmt3->bindParam(':id_prod', $id_prod);
                    $stmt3->execute();
                    $Prod=$stmt3->fetchColumn();
                    if($Prod<1){
                        throw new Exception ('No hay stock suficiente del producto seleccionado en el almacen deseado');
                    }else{
                        $stmt4 = $conn->prepare("INSERT INTO compra(FECHA_COMPRA, ID_PRODUCTO, NIF, UNIDADES) VALUES (NOW(), :id_prod, :nif, 1);");
                        $stmt4->bindParam(':id_prod', $id_prod);
                        $stmt4->bindParam(':nif', $nif);
                        $stmt4->execute();
                        if($Prod==1){
                            $stmt5 = $conn->prepare("DELETE from almacena Where ID_PRODUCTO=:id_prod AND NUM_ALMACEN=:id_alm;");
                            $stmt5->bindParam(':id_prod', $id_prod);
                            $stmt5->bindParam(':nif', $nif);
                            $stmt5->execute();
                        }else{
                            $stmt6 = $conn->prepare("UPDATE almacena SET CANTIDAD = CANTIDAD - 1 WHERE ID_PRODUCTO = :id_prod AND NUM_ALMACEN = :id_alm;");
                            $stmt6->bindParam(':id_prod', $id_prod);
                            $stmt6->bindParam(':id_alm', $id_alm);
                            $stmt6->execute();
                        }
                    }
                }
                echo "Se han introducido los datos correctamente";
                }
            catch(PDOException $e)
                {
                echo "Error: " . $e->getMessage();
                }catch(Exception $e){
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