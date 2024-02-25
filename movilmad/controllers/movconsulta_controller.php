<?php
    require_once("../models/global.php");
	test_inicio();
    require_once("../models/movconsulta_models.php");
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
		<div class="card-header">Menú Usuario - CONSULTA ALQUILERES </div>
		<div class="card-body">

	<!-- INICIO DEL FORMULARIO -->
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
				
    <?php
        mostrarDatos(); 
    ?>
			Fecha Desde: <input type='date' name='fecha1' value='' size=10 placeholder="fechadesde" class="form-control">
			Fecha Hasta: <input type='date' name='fecha2' value='' size=10 placeholder="fechahasta" class="form-control"><br><br>
				
		<div>
			<input type="submit" value="Consultar" name="Consultar" class="btn btn-warning disabled">
		
			<a href="../views/movwelcome.php" class="btn btn-warning ">Menu</a>
		
		</div>		
	</form>
	<!-- FIN DEL FORMULARIO -->
    <a href = "./cerrarsesion.php">Cerrar Sesion</a>
</body>
</html>
<?php
    if(isset($_POST['Consultar'])) {
        $fecha1 = test_input($_POST['fecha1']);
        $fecha2 = test_input($_POST['fecha2']);
        $arrayAlquileres = obtenerAlquileres($fecha1, $fecha2);
        require_once('../views/movconsulta_view.php');
    }
?>
