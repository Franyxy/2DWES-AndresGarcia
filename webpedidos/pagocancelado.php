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
    <title>Compra</title>
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
    echo "<br><br>  Has iniciado Sesion: ".$_SESSION['nombre'];
    $conn = conection();
    ?>
    <h1>Compra Cancelada - Denegada</h1>
    <p>Su compra ha sido denegada</p>
    <p>Vuelva a intentralo o contacte con su banco</p>
</body>
</html>