<?php
    require_once("../models/global.php");
	test_inicio();
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bienvenido a MovilMAD</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>
    <h1>Servicio de ALQUILER DE E-CARS</h1> 

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Usuario - ALQUILAR VEHÍCULOS</div>
		<div class="card-body">

    <?php
        mostrarDatos(); 
    ?>

    <h1>Compra Cancelada - Denegada</h1>
    <p>Su compra ha sido denegada</p>
    <p>Vuelva a intentralo o contacte con su banco</p>
    <a href="../views/movwelcome.php" class="btn btn-warning">Menu</a>
</body>
</html>