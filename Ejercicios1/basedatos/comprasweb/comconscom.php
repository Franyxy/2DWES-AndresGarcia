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
                $fecha1=date('Y-m-d', strtotime($_POST['fecha_1']));
                $fecha2=date('Y-m-d', strtotime($_POST['fecha_2']));


                
                if($fecha1>$fecha2){
                    throw new Exception ('Las fechas introducidas no son válidas');
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
    ?>
</body>
</body>
</html>