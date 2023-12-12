<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aprovisionar Productos</title>
    <link rel="stylesheet" type="text/css" href="index.css">

</head>
<body>
    <!--
        Aprovisionar Productos
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
    <legend>Aprovisionar Productos</legend>
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
        <label for="cantidad">Cantidad</label>    
        <input type="text" name="cantidad" id="cantidad" required><br><br> 
        <input type="submit">
        <input type="reset">
    </form>
    </fieldset>
    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){

            try {

                $cantidad=test_input($_POST['cantidad']);
                $prod=test_input($_POST['prod']);
                $alm=test_input($_POST['alm']);


                $stmt3 = $conn->prepare("INSERT INTO almacena (NUM_ALMACEN,ID_PRODUCTO,CANTIDAD) VALUES (:alm,:prod,:cantidad)");
                $stmt3->bindParam(':alm', $alm);
                $stmt3->bindParam(':prod', $prod);
                $stmt3->bindParam(':cantidad', $cantidad);
                $stmt3->execute();

                echo "Se han introducido los datos correctamente";
                }
            catch(PDOException $e)
                {
                echo "Error: " . $e->getMessage();
                }
            $conn = null;
        }

    ?>
</body>
</body>
</html>