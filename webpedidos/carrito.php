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
    ?>
    <h1>Carrito de compra </h1>
    <?php
        if(isset($_SESSION['carrito']) && ($_SESSION['carrito'])){
            echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
            echo "<table>";
            echo "<tr><td></td><td>Producto</td><td>Unidades</td><td>Precio Unitario</td><td>Precio Total</td></tr>";
            foreach($_SESSION['carrito'] as $prod => $nombre){
                $nombre_prod = obtener_nombre($conn,$prod);
                $precio = obtenerPrecio($conn,$prod);
                $preciototal = $precio*$nombre['cantidad'];
                echo '<tr>';
                echo '<td><input type="checkbox" id="'.$nombre_prod.'" name="productos_seleccionados['.$prod.'][cantidad]" value="'.$nombre['cantidad'].'"></td>';
                echo '<td><label for="'.$nombre_prod.'">'.$nombre_prod.'</label></td>';
                echo '<td>'.$nombre['cantidad'].'</td>';
                echo '<td>'.$precio.'</td>';
                echo '<td>'.$preciototal.'</td>';
                echo '</tr>';
            }
            echo "</table>";
            echo '<br><input type="submit" value="Comprar">';
            echo "</form>";
        }else{
            echo "<h3>El Carrito esta Vacio</h3>";
            echo "<a href='./pe_altaped.php'>Volver a comprar</a><br>";
        }
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        try{
            if (isset($_POST['productos_seleccionados'])) {
                $productos_seleccionados = $_POST['productos_seleccionados'];
                $orderNumber = obtener_orderNumber($conn);
                $amount = 0;
                foreach ($productos_seleccionados as $prod_id => $unidadesProd) {
                    $unidad = $unidadesProd["cantidad"];
                    $precioEach = obtenerPrecio($conn,$prod_id);
                    $amount += $precioEach*$unidad;
                }
                $_SESSION['productos_comprados'] = $productos_seleccionados;
                $_SESSION['id_pedido'] = $orderNumber;
                pasarela($orderNumber, $amount);
            }
            
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