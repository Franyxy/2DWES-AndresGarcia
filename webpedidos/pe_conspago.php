<?php
    session_start();
    if(!isset($_SESSION['nombre'])){
        header('location: cierresesion.php');
    }
    include('funciones.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra Producto </title>
    <link rel="stylesheet" type="text/css" href="css/inicio.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
<div class="container">
    <nav>
        <ul class="nav">
        <li><a href="pe_altaped.php">Compra Productos</a></li>
        <li class="active"><a href=" pe_consped.php">Consulta Pedidos</a></li>
        <li><a href="pe_consprodstock.php">Consulta Stock</a></li>
        <li><a href="pe_constock.php">Consulta Stock | Linea Producto</a></li>
        <li><a href="pe_topprod.php">Productos Vendidos</a></li>
        <li><a href="pe_conspago.php">Pagos Realizados</a></li>
        <li><a href="carrito.php"><img src="img/carrito.png"></a></li>
        <li id="cierresesion"><a href="cierresesion.php">Cerrar Sesion</a></li>

        </ul>
    </nav>
</div>
    <?php
        if(isset($_SESSION['nombre'])){
            echo "<br><br>  Has iniciado Sesion: ".$_SESSION['nombre'];
        }
        $conn = conection();
        echo "<h1>Consulta Pedidos</h1>";
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <?php
            $arrayCliente = consultarCliente($conn);
            imprimir_Cliente($arrayCliente);
        ?>
        <label for="fecha1">Fecha de Inicio:</label>
        <input type="date" id="fecha1" name="fechaInicio"><br><br>

        <label for="fecha2">Fecha de Fin:</label>
        <input type="date" id="fecha2" name="fechaFin"><br><br>

        <input type="submit" value="Consulta">
    </form>
    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            try {
                $id_cliente=test_input($_POST['cliente']);
                $fecha1=test_input($_POST['fechaInicio']);
                $fecha2=test_input($_POST['fechaFin']);
                if(!empty($fecha1) && !empty($fecha2)){
                    $arrayPayments = paymentsFechas($conn, $fecha1, $fecha2, $id_cliente);
                    if(empty($arrayPayments)){
                        echo "<br>No hay compras entre las fechas seleccionadas<br>";
                    }else{
                        echo "<br>Compras entre ".$fecha1." || ".$fecha2."<br>"; 
                        imprimirPayments($arrayPayments);
                    }
                }elseif (empty($fecha1) && empty($fecha2)){
                    $arrayPayments = paymentsNOFechas($conn, $id_cliente);
                    if(empty($arrayPayments)){
                        echo "<br>No hay compras entre las fechas seleccionadas<br>";
                    }else{
                        echo "<br>Compras histórico<br>"; 
                        imprimirPayments($arrayPayments);
                    }
                }elseif($fecha1 > $fecha2){
                    throw new Exception('Las fechas intoducidas no son correctas');
                }else{
                    throw new Exception('Las dos fechas deben de estar rellenas o vacias');
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
</html>