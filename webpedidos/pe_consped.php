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
        $arrayCliente = consultarCliente($conn);
        imprimir_Cliente($arrayCliente);
    ?>
    <label for="order" id="LaberOrder" style="display: none;">Elige un pedido </label>
    <select name="order" id="order" style="display: none;"></select><br><br>

    <table id="tablapedido"></table>

    <script src="clientespedidos.js"></script>
</body>
</html>