<?php
    session_start();
    if(!isset($_SESSION['nombre'])){
        header('location: cierresesion.php');
    }
    include('funciones.php');
    $conn = conection();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de Inicio</title>
    <link rel="stylesheet" type="text/css" href="./css/inicio.css">
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
    <fieldset>
        <legend>Compra Producto</legend>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="fecha1">Fecha de Inicio:</label>
            <input type="date" id="fecha1" name="fechaInicio" required><br><br>

            <label for="fecha2">Fecha de Fin:</label>
            <input type="date" id="fecha2" name="fechaFin" required><br><br>

            <input type="submit" value="Consulta">
        </form>
    </fieldset>
    <?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        try{
            $fecha1=test_input($_POST['fechaInicio']);
            $fecha2=test_input($_POST['fechaFin']);
            $ArrayProd = prod_vendidos($conn, $fecha1, $fecha2);
            echo '<br><p>Productos Vendidos entre las fechas: '.$fecha1.' || '.$fecha2.'</p>';
            imprimir_prodVendidos($ArrayProd);
        }
        catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
    ?>
</body>
</html>