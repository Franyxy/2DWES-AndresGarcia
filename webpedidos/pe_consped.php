<?php
    session_start();
    include('funciones.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra Producto </title>
    <link rel="stylesheet" type="text/css" href="css/inicio.css">
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
        </ul>
    </nav>
</div>
<?php
    if(isset($_SESSION['nombre'])){
        echo "<br><br>  Has iniciado Sesion: ".$_SESSION['nombre'];
    }
    $conn = conection();
    ?>
    <h1>Consulta Pedidos</h1>
    <?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        try{
            if (isset($_POST['productos_seleccionados'])) {
                $productos_seleccionados = $_POST['productos_seleccionados'];
                $orderNumber = obtener_orderNumber($conn);
                $cont = 0;
                $amount = 0;
                foreach ($productos_seleccionados as $prod_id => $unidadesProd) {
                    $cont += 1;
                    $unidad = $unidadesProd["cantidad"];
                    comprar_productos($conn,$prod_id,$unidad);
                    unset($_SESSION['carrito'][$prod_id]);
                    añadir_order($conn,$orderNumber);
                    $precioEach = obtenerPrecio($conn,$prod_id);
                    $amount += $precioEach*$unidad;
                    añadir_orderDetails($conn,$orderNumber,$cont,$prod_id,$unidad,$precioEach);
                }
                añadir_payments($conn, $amount);
            }
            header('location: carrito.php');
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